<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class EmployeeController extends Controller
{
    protected $userInterface;

    public function __construct(UserRepositoryInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index()
    {
        $employee = $this->userInterface->getByID(Auth::id());  
        return view('employee')->with('value', $employee);
    }

    
}
