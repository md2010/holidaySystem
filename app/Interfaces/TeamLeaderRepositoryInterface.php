<?php

namespace App\Interfaces;

interface TeamLeaderRepositoryInterface extends UserRepositoryInterface
{

    public function getAll();

}