<?php

namespace App\Interfaces;

interface TeamRepositoryInterface extends UserRepositoryInterface
{

    public function getAll();

    public function getByID($id);

    public function getTeamIDByTeamLeader($teamLeader_id);

    public function getTeamMembers();

    public function getTeamMembersIDs();

    //public function getTeamLeaderID();

    //public function getProjectManagerID();

}