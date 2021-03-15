<?php

namespace App\Interfaces;

interface TeamRepositoryInterface 
{

    public function getAll();

    public function getByID(int $id);

    public function getTeamIDByTeamLeader(int $teamLeader_id);

    public function getTeamMembers(int $team_id);

    public function getTeamIDByProjectManager(int $projectManager_id);

    public function getTeamLeaderID(int $teamID);

    public function getProjectManagerID(int $teamID);

    public function getTeamMembersIDs(int $team_id);

    public function delete(int $id);

    public function update(mixed $data);

    public function store(mixed $data);

}