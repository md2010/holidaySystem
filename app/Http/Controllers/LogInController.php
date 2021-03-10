<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class LogInController extends Controller
{
    public function showLogInForm()
    {
        return view('login');
    }

    public function validateLogIn(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {

            $user = User::where('email', $request->email)->first();
            return Redirect::to('/'.$user->position); 

        } else {
            
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
                'password' => 'Incorrect password.'
            ]);
        }
    }

    public function logOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
