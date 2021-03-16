<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use DateTime;
use App\Models\HolidayRequest;

interface HolidayRequestRepositoryInterface
{
    public function store(DateTime $fromDate, DateTime $toDate);

    public function getByUserID($IDs);  

    public function update(array $data);

    public function concludeHolidayRequest(HolidayRequest $request, string $position, string $decision);

    //public function validateStatus(HolidayRequest $request);

    public function getByID(int $id);

    public function getAll();

}