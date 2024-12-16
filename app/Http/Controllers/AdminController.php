<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember');

        $user = Admin::where('username', $request['username'])->first();

        if (!$user) {
            return back()->withInput($request->only('username'))
                ->with('error_message', 'The provided username does not exist in our records.');
        }

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()->intended('admin/dashboard');
        }

        return back()->withInput($request->only('username'))
            ->with('error_message', 'The provided <strong>credentials</strong> do not match our records.');
    }
}
