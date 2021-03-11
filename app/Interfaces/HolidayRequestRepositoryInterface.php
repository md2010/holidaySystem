<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Models\HolidayRequest;

interface HolidayRequestRepositoryInterface
{
    public function store($fromDate, $toDate);

    public function getHolidayRequests();

    public function getTeamsHolidayRequests($IDs);

    public function updateDate(Request $request);

    public function concludeHolidayRequest(Request $request, $position, $decision);

    public function validateStatus($requestID);

    public function getByID($id);

    public function getAll();

    public function getUnresolvedForAdmin($IDs);

}