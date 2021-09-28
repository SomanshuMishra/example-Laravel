<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {   
        $this->validate($request,[
            "email" => "required|exists:admins,email",
            "password" => "required|min:6"
        ]);

        $credentials = $request->only('email','password');

        if (Auth::guard('admin')->attempt($credentials)) {

            return redirect()->route('admin.dashboard')->with("message","Login succssfully");
        } else {
            return redirect()->back()->with("error","Email or password is wrong");
        }


    }
}
