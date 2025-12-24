<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = Role::all();
        $hospitals = Hospital::all();
        return view('auth.register', compact(['roles', 'hospitals']));
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if($request->role_id != 1){
            $request->hospital_id = null;
        }

//        dd($request->hospital_id);


        $user = User::create([
            'name' => $request->full_name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id'=> $request->role_id,
            'hospital_id'=> $request->hospital_id,
        ]);
    }
}
