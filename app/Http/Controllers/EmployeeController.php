<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\User;

class EmployeeController extends Controller
{
    protected $employeeInterface;

    public function __construct(EmployeeRepositoryInterface $employeeInterface)
    {
        $this->employeeInterface = $employeeInterface;
    }

    public function index()
    {
        $employee = $this->employeeInterface->getByID(Auth::id());  
        return view('employee')->with('value', $employee);
    }

    
}
