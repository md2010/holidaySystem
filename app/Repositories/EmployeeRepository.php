<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\User;

class EmployeeRepository extends UserRepository implements EmployeeRepositoryInterface
{
    public function getAll()
    {
        $employers = User::where('position', 'employee')->get();
        return $employers;
    }

    

    
}