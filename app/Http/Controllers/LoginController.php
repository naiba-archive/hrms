<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 用户注册
     */
    public function register(Request $request)
    {
        $validatedData = $this->validate($request, [
            'username' => 'required|max:12|min:2',
            'phone' => 'required|unique:users|size:11',
            'password' => 'required|min:6',
        ]);

        $user = new \App\User;
        $user->username = $validatedData['username'];
        $user->phone = $validatedData['phone'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        return $user;
    }
}
