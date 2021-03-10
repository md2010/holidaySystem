<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getByID($id)
    {
        $employee = User::findOrFail($id);
        return $employee;
    }

    public function getAvailableDays()
    {
        $e = $this->getByID(Auth::id());
        return $e->availableDays;
    }

    public function updateAvailableDays($value)
    {
        $id = Auth::id();
        $e =  $this->getByID($id);
        $e->availableDays -= $value;
        $e->save();
    }

    public function updateAttribute($attribute, $value) 
    {
        $id = Auth::id();
        $employee = $this->getByID($id);
        $employee->$attribute = $value;
        $employee->save();
    }

    public function delete($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();
    }

    public function resolveUser()
    {
        $e = $this->getByID(Auth::id());
        return $e->position;
    }
}