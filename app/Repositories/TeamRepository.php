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

    public function getByID($id)
    {
        $team = Team::findOrFail($id);
        return $team;
    }

    public function getTeamIDByTeamLeader($teamLeader_id)
    {
        $leader = Team::where('teamLeaderID', $teamLeader_id)->first();
        $teamID = $leader->id;
        return $teamID;
    }

    public function getTeamIDByProjectManager($projectManagerID_id)
    {
        $manager = Team::where('projectManagerID', $projectManager_id)->first();
        $teamID = $manager->id;
        return $teamID;
    }

    public function getTeamLeaderID($teamID)
    {
        $teamLeaderID = (Team::where('id', $teamID))->teamLeaderID();
        return $teamLeaderID;
    }

    public function getProjectManagerID($teamID)
    {
        $projectManagerID = (Team::where('id', $teamID))-projectManagerID();
        return $projectManagerID;
    }

    public function getTeamMembers($team_id)
    {
        $members = User::where('team_id', $team_id)->get();
        return $members;
    }

    public function getTeamMembersIDs($team_id)
    {
        $IDs = (User::where('team_id', $team_id))->pluck('id');
        return $IDs;
    }

    public function delete($id)
    {
        $employee = Team::findOrFail($id);
        $employee->delete();
    }

    public function update($data)
    {
        if($this->validateValues($data)) {
            Team::where('id', $data['id'])
                        ->update([
                            'name' => $data['name'], 
                            'projectManagerID' => $data['projectManagerID'],
                            'teamLeaderID' => $data['teamLeaderID'],
            ]);
            return true;
        } 
        return false;
    }

    public function validateValues($data)
    {
        if(
            $this->resolveUser($data['projectManagerID']) == 'projectManager'
            && $this->resolveUser($data['teamLeaderID']) == 'teamLeader'
        ) {
            return true;
        } 
        return false;
    }
    
}