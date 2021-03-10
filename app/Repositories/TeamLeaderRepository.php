<?php

namespace App\Repositories;

use App\Interfaces\TeamLEaderRepositoryInterface;
use App\Models\User;

class TeamLeaderRepository extends UserRepository implements TeamLeaderRepositoryInterface
{
    public function getAll()
    {
        $teamLeaders = User::where('position', 'teamLeader')->get();
        return $teamLeaders;
    }

}