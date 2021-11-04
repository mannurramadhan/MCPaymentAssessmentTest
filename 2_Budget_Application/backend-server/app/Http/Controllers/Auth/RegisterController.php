<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{

    public function register(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|unique:budget_app_tables_users|email',
            'password' => 'required|min:6'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        return response()->json(['message' => 'User registered successfully', 'data' => $user], 201);

    }

}
