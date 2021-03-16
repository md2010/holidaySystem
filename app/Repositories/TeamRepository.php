<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Interfaces\TeamRepositoryInterface;
use App\Models\Team;

class TeamRepository implements TeamRepositoryInterface 
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
        $projectManagerID = (Team::where('id', $teamID))->projectManagerID();
        return $projectManagerID;
    }

    public function delete(int $id)
    {
        $team = Team::findOrFail($id);
        $team->delete();
    }

    public function store(array $data)
    {
        $team = new Team();
        foreach($data as $key => $value) {
            $team->$key = $value;
        }
        $team->save();      
    }

    public function update(array $data)
    {    
        $team = $this->getByID($data['id']);
        foreach($data as $key => $value) {
            $team->$key = $value;          
        }  
        $team->save();       
    }


}