<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Http\Resources\UserResource;

class EmployeeController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $employee = new UserResource($this->userRepository->getByID(Auth::id()));  
        return view('employee')->with('value', $employee->toArray($request));
    }

    
}
