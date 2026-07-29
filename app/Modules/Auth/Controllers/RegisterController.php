<?php

namespace Modules\Auth\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\Role;
use Modules\Auth\Models\User;

class RegisterController extends Controller
{
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Attach default role 'karyawan' if exists
        $role = Role::where('slug', 'karyawan')->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }

        auth()->login($user);

        return redirect('/dashboard');
    }
}
