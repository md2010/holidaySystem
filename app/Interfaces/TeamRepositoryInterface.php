<?php

namespace App\Interfaces;

interface TeamRepositoryInterface 
{

    public function getAll();

    public function getByID($id);

    public function getTeamIDByTeamLeader($teamLeader_id);

    public function getTeamMembers($team_id);

    public function getTeamIDByProjectManager($projectManagerID_id);

    public function getTeamLeaderID($teamID);

    public function getProjectManagerID($teamID);

    public function getTeamMembersIDs($team_id);

    public function delete($id);

    public function update($data);

    public function validateValues($data);

}