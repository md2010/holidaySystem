<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Interfaces\TeamRepositoryInterface;
use App\Models\Team;
use App\Models\User;

class TeamRepository extends UserRepository implements TeamRepositoryInterface
{
    public function getAll()
    {
        $teams = Team::all()->get();
        return $teams;
    }

    public function getByID($id)
    {
        $team = Team::findOrfail($id);
        return $team;
    }

    public function getTeamIDByTeamLeader($teamLeader_id)
    {
        $leader = Team::where('teamLeaderID', $teamLeader_id)->first();
        $teamID = $leader->id;
        return $teamID;
    }

    public function getTeamLeaderID($teamID)
    {
        $teamLeaderID = (Team::where('id', $teamID))->teamLeaderID();
        return $teamLeaderID;
    }

    public function getTeamMembers()
    {
        $team_id = $this->getTeamIDByTeamLeader(Auth::id());
        $members = User::where('team_id', $team_id)->get();
        return $members;
    }

    public function getTeamMembersIDs()
    {
        $team_id = $this->getTeamIDByTeamLeader(Auth::id());
        $IDs = (User::where('team_id', $team_id))->pluck('id');
        return $IDs;
    }
    
}