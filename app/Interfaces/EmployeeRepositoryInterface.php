<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface extends UserRepositoryInterface 
{
    public function getAll();

    
}