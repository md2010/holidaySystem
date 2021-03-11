<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function update($data)
    {
        User::where('id', $data['id'])
                    ->update([
                        'firstName' => $data['firstName'], 
                        'lastName' => $data['lastName'],
                        'email' => $data['email'],
                        'position' => $data['position'],
                        'passwordVisible' => $data['passwordVisible'],
                        'password' => Hash::make($data['passwordVisible']),
                        'team_id' => $data['team_id'],
                        'availableDays' => $data['availableDays']
            ]);
    }

    public function getLeaderManagerIDs()
    {
        $IDs = User::where('position', 'teamLeader')
            ->orWhere('position', 'projectManager')
            ->pluck('id');
        return $IDs;
    }
    
}