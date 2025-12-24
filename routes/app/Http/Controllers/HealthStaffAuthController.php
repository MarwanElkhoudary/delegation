<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HealthStaffAuthController extends Controller
{
    /**
     * عرض صفحة تسجيل الدخول
     */
    public function showLoginForm()
    {
        return view('health-staff.login');
    }

    /**
     * معالجة طلب تسجيل الدخول
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('health_staff')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect('/home')
                ->with('success', 'Welcome back!');
        }

        return back()
            ->withErrors(['username' => 'Invalid credentials'])
            ->withInput();
    }

    /**
     * لوحة التحكم للكادر الطبي
     */
    public function dashboard()
    {
        $healthStaff = Auth::guard('health_staff')->user();
        
        return view('health-staff.dashboard', compact('healthStaff'));
    }

    /**
     * تسجيل الخروج
     */
    public function logout(Request $request)
    {
        Auth::guard('health_staff')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('health-staff.login.form')
            ->with('success', 'Logged out successfully');
    }
}
