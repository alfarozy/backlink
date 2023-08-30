<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\MailActivationRegisterEmail;
use App\Models\Member;
use App\Models\PasswordResset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AuthMemberController extends Controller
{
    protected $redirectTo = '/member';

    public function __construct()
    {
        $this->middleware('guest:member');
    }
    public function registerView()
    {
        return view('auth.member.register');
    }

    public function register(Request $request)
    {
        $attr = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
            'password' => ['required', 'string'],
            'phone' => ['required', Rule::unique('members', 'phone')],
        ], [
            '*.required' => 'Bidang ini wajib diisi'
        ]);

        try {
            DB::beginTransaction();
            Member::create([
                'name' => $attr['name'],
                'email' => $attr['email'],
                'phone' => $attr['phone'],
                'password' => Hash::make($attr['password']),
            ]);

            $token = Str::random(60);
            $storeToken = PasswordResset::create(['email' => $attr['email'], 'token' => $token]);
            if (isset($storeToken)) {
                Mail::to($request->email)->send(new MailActivationRegisterEmail($token));
            }
            DB::commit();
            return redirect()->route('login')->with('msg', 'Akun anda berhasil terdaftar silahkan periksa email diabagian menu spam untuk aktivasi akun');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', 'Registrasi gagal : ' . $th->getMessage());
        }
    }

    public function loginView()
    {
        return view('auth.member.login');
    }

    public function login(Request $request)
    {

        if ($request->email && $request->password) {

            $member = Member::whereEmail($request->email)->first();
            if ($member && Hash::check($request->password, $member->password)) {
                if ($member->status == Member::STATUS_ACTIVE) {
                    Auth::guard('member')->login($member);

                    return redirect()->route('dashboard.member.index');
                } else {
                    if ($member->email_ == null) {
                        $token = Str::random(60);
                        $data = [
                            'token' => $token,
                            'email' => $member->email
                        ];

                        $reset = PasswordResset::updateOrInsert(['email' => $member->email], ['token' => $token]);

                        if (isset($reset) && !empty($reset)) {
                            Mail::to($member->email)->send(new MailActivationRegisterEmail($token));
                            return redirect()->back()->with('msg', 'Link Reset Email sudah dikirim');
                        }
                    }
                    return redirect()->route('login')->with('error', '<b>Login gagal</b>,Pengguna belum aktif atau sementara dinonaktifkan oleh admin');
                }
            } else {
                return redirect()->route('login')->with('error', '<b>Login gagal</b>,email atau password salah');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email dan password wajib');
        }
    }

    public function logoutPegawai()
    {

        Auth('member')->logout();
        request()->session()->invalidate();
        request()->session()->flush();;
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
