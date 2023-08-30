<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\Member;
use App\Models\PasswordResset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot_password');
    }

    public function sendEmail(Request $request)
    {
        try {
            $checkEmail = Member::where('email', $request->email)->first();
            if (empty($checkEmail)) {
                return redirect()->back()->with('error', 'Email Tidak Terdaftar');
            } elseif ($checkEmail->enabled != 1) {
                return redirect()->back()->with('error', 'Akun anda tidak aktif, pengajuan di reject / akun di blokir');
            } else {
                //> insert token to db
                $token = Str::random(60);
                $data = [
                    'token' => $token,
                    'email' => $checkEmail->email
                ];

                $reset = PasswordResset::create($data);

                if (isset($reset) && !empty($reset)) {
                    Mail::to($request->email)->send(new ForgotPassword($reset));
                    return back()->with('success', 'Link Reset Email sudah dikirim');
                }
            }
        } catch (\Exception $exc) {
            return $exc->getMessage();
        }
    }
    public function editPassword($token)
    {
        $user = PasswordResset::where('token', $token)->firstOrFail();
        return view('auth.reset_password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|min:3',
                'confirm_password' => 'required|same:password',
            ]);
            $checkToken = PasswordResset::where('token', $request->token)->first();

            if (empty($checkToken)) {
                return redirect()->back()->with('error', 'Invalid token!');
            }

            $update = Member::where('email', $checkToken->email)->update(['password' => bcrypt($request->password)]);
            if (isset($update)) {
                PasswordResset::where('email', $checkToken->email)->delete();
            }

            return redirect()->route('login')->with('success', 'Password anda berhasil diubah!');
        } catch (\Exception $exc) {
            return abort(404);
        }
    }

    public function activatedMember($token)
    {
        $checkToken = PasswordResset::where('token', $token)->first();
        if (empty($checkToken)) return redirect()->back()->with("error", "Token tidak ditemukan !");

        $verified = Member::where('email', $checkToken->email)->update(['email_verified_at' => Carbon::now(), 'status' => Member::STATUS_ACTIVE]);
        if (empty($verified)) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan hubungi administrator');
        }

        if (isset($verified)) {
            PasswordResset::where('email', $checkToken->email)->delete();
        }
        return redirect()->route('login')->with('msg', 'Akun berhasil diaktivasi, silahkan login untuk melanjutkan');
    }
}
