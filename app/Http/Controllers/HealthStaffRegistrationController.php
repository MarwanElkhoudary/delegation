<?php

namespace App\Http\Controllers;

use App\Models\HumanType;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HealthStaffRegistrationController extends Controller
{
    /**
     * عرض صفحة التسجيل
     */
    public function showRegistrationForm()
    {
        $humanTypes = HumanType::all();
        $languages = Language::all();

        return view('health-staff.register', compact('humanTypes', 'languages'));
    }

    /**
     * معالجة طلب التسجيل - إضافة في users table
     */
    public function register(Request $request)
    {
        // التحقق من البيانات - بس الحقول المطلوبة
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|min:3|max:50|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'human_type' => 'required|exists:human_types,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // إنشاء الحساب في users table
            $user = User::create([
                'name' => $request->username,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 6, // Health Staff role
                'human_type_id' => $request->human_type, // ✅ جديد
                'hospital_id' => null,
            ]);

            // حفظ human_type في الـ session عشان نستخدمه لما يقدم على مهمة
            Session::put('health_staff_data', [
                'human_type_id' => $request->human_type,
                'email' => $request->email,
            ]);

            // تسجيل الدخول تلقائياً
            Auth::login($user);

            // التوجيه لصفحة home
            return redirect('/home')
                ->with('success', 'Registration successful! Welcome');

        } catch (\Exception $e) {
            \Log::error('Health Staff Registration Error: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'An error occurred during registration. Please try again.');
        }
    }

    /**
     * جلب التخصصات حسب نوع الكادر
     */
    public function getSpecializations(Request $request)
    {
        $specializations = Specialization::where('human_type_id', $request->human_type_id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $specializations
        ]);
    }
}

