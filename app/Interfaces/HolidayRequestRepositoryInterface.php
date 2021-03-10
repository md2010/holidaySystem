<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Models\HolidayRequest;

interface HolidayRequestRepositoryInterface
{
    public function store($fromDate, $toDate);

    public function getEmployeeHolidayRequests();

    public function updateDate(Request $request, $position);

    public function approveHolidayRequest();
}