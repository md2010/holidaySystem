<?php

namespace App\Interfaces;

interface TeamRepositoryInterface 
{

    public function getAll();

    public function getByID(int $id);

    public function getTeamIDByTeamLeader(int $teamLeader_id);

    public function getTeamIDByProjectManager(int $projectManager_id);

    public function getTeamLeaderID(int $teamID);

    public function getProjectManagerID(int $teamID);

    public function delete(int $id);

    public function update(array $data);

    public function store(array $data);

}