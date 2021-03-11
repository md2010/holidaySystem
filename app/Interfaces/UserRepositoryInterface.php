<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function getByID(int $id);

    public function delete(int $id);

    public function update(mixed $data);

    public function updateAttribute($attribute, mixed $value);

    public function getAvailableDays();

    public function updateAvailableDays($value);

    public function getTeamLeaders();

    public function getLeaderManagerIDs();

    public function getProjectManagers();

}