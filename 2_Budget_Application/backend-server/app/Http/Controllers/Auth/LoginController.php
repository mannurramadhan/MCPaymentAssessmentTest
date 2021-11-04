<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
  
        $email = $request->input('email');
        $password = $request->input('password');
  
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'Login failed'], 401);
        }
  
        $isValidPassword = Hash::check($password, $user->password);
        if (!$isValidPassword) {
          return response()->json(['message' => 'Login failed'], 401);
        }
  
        $generateToken = bin2hex(random_bytes(40));
        $user->update([
            'token' => $generateToken
        ]);
  
        return response()->json($user);
        
    }

}