<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AuthorizationRequest;
use App\Interfaces\UserRepositoryInterface;

class LogInController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showLogInForm()
    {
        return view('login');
    }

    public function validateLogIn(AuthorizationRequest $request)  
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {

            $user = $this->userRepository->getByEmail($request->email); 
            return redirect()->route($user->position); 

        } else {
            
            return Redirect::back()->withErrors(['Email or password incorrect!']);
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
