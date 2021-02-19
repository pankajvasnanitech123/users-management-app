<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View, Auth, Validator;

class LoginController extends Controller
{
    /**
     * Function to show login form
     */
    public function showLoginForm(Request $request) {
        return View::make('login');
    }

    /**
     * Function to validate login details
     */
    public function validateLoginForm(Request $request) {
        $validator = Validator::make(
            $request->all(), 
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors([
                'message' => 'Enter all the input values.',
            ]);
        } else {

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard');
            }

            return back()->withErrors([
                'message' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    /**
     * Function to logout the user
     */
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
