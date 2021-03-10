<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Models\HolidayRequest;

interface HolidayRequestRepositoryInterface
{
    public function store($fromDate, $toDate);

    public function getEmployeeHolidayRequests();

    public function update(Request $request, $position);
}