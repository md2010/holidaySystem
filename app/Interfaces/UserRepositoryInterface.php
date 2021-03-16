<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function getByID(int $id);

    public function getByEmail(string $email);

    public function delete(int $id);

    public function update(array $data); //array with keys values, must contain ID

    public function store(array $data);

    public function getTeamLeaders();

    public function getLeaderManagerIDs();

    public function getProjectManagers();

    public function getUsersInTeam(int $team_id);

}