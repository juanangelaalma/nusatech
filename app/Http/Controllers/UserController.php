<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('dashboard');
    }

    public function editPassword(User $user) {
        return view('users.edit', compact('user'));
    }

    public function updatePassword(Request $request, User $user) {
        $request->validate([
            'new_password' => 'required',
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('dashboard');
    }

    public function active(User $user) {
        $user->active = true;
        $user->save();
        return redirect()->route('dashboard');
    }

    public function deactive(User $user) {
        $user->active = false;
        $user->save();
        return redirect()->route('dashboard');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('dashboard');
    }
}
