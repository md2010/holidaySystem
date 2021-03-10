<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function getByID(int $id);

    public function delete(int $id);

    //public function update(int $id, mixed $data);

    public function updateAttribute($attribute, mixed $value);

    public function getAvailableDays();

    public function updateAvailableDays($value);

    //public function create($data);

    //public function save(mixed $data);
}