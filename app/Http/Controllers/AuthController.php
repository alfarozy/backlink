<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware(['guest', 'throttle:6,5']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        if ($request->email && $request->password) {

            $admin = User::whereEmail($request->email)->first();
            if ($admin && Hash::check($request->password, $admin->password)) {

                if ($admin->status == User::STATUS_ACTIVE) {
                    Auth::guard()->login($admin);

                    return redirect()->route('dashboard.index');
                } else {
                    return redirect()->route('login')->with('msg', '<b>Login gagal</b>,Akun belum aktif atau sementara dinonaktifkan oleh admin');
                }
            } else {
                return redirect()->route('login')->with('msg', '<b>Login gagal</b>,email atau password salah');
            }
        } else {
            return redirect()->route('login')->with('msg', 'Email dan password wajib');
        }
    }
}
