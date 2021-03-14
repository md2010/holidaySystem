<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getByID(int $id)
    {
        $employee = User::findOrFail($id);
        return $employee;
    }

    public function getByEmail(string $email) 
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    public function delete(int $id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();
    }

    public function getTeamLeaders() 
    {
        $leaders = User::where('position', 'teamLeader')->get();
        return $leaders;
    }

    public function getProjectManagers() 
    {
        $managers = User::where('position', 'projectManager')->get();
        return $managers;
    }

    public function getLeaderManagerIDs()
    {
        $IDs = User::where('position', 'teamLeader')
            ->orWhere('position', 'projectManager')
            ->pluck('id');
        return $IDs;
    }

    public function update(mixed $data) 
    {
        $user = $this->getByID($data['id']);

        foreach($data as $key => $value) {
            if($key == 'password') {
                $user->$key = Hash::make($data['password']);
            }
           $user->$key = $value;
           $user->save();
        }
    }

    public function store(mixed $data)
    {
        $user = new User();
        foreach($data as $key => $value) {
            if($key == 'password') {
                $user->$key = Hash::make($data['password']);
            }
            $user->$key = $value;
        }

        $user->availableDays = 20;
        $user->save();
    }

    
}