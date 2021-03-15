<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Interfaces\TeamRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Team;
use App\Models\User;

class TeamRepository extends UserRepository implements TeamRepositoryInterface 
{
    public function getAll()
    {
        $teams = Team::all();
        return $teams;
    }

    public function getByID(int $id)
    {
        $team = Team::findOrFail($id);
        return $team;
    }

    public function getTeamIDByTeamLeader(int $teamLeader_id)
    {
        $leader = Team::where('teamLeaderID', $teamLeader_id)->first();
        $teamID = $leader->id;
        return $teamID;
    }

    public function getTeamIDByProjectManager(int $projectManager_id)
    {
        $manager = Team::where('projectManagerID', $projectManager_id)->first();
        $teamID = $manager->id;
        return $teamID;
    }

    public function getTeamLeaderID(int $teamID)
    {
        $teamLeaderID = (Team::where('id', $teamID))->teamLeaderID();
        return $teamLeaderID;
    }

    public function getProjectManagerID(int $teamID)
    {
        $projectManagerID = (Team::where('id', $teamID))-projectManagerID();
        return $projectManagerID;
    }

    public function getTeamMembers(int $team_id)
    {
        $members = User::where('team_id', $team_id)->get();
        return $members;
    }

    public function getTeamMembersIDs(int $team_id)
    {
        $IDs = (User::where('team_id', $team_id))->pluck('id');
        return $IDs;
    }

    public function delete(int $id)
    {
        $employee = Team::findOrFail($id);
        $employee->delete();
    }

    public function store(mixed $data)
    {
        $team = new Team();
        foreach($data as $key => $value) {
            $team->$key = $value;
        }
        $team->save();      
    }

    public function update(mixed $data)
    {    
        $team = $this->getByID($data['id']);
        foreach($data as $key => $value) {
            $team->$key = $value;
            $team->save();
        }         
    }


}