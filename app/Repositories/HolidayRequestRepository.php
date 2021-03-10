<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Interfaces\HolidayRequestRepositoryInterface;
use App\Models\HolidayRequest;

class HolidayRequestRepository implements HolidayRequestRepositoryInterface
{
    public function store($fromDate, $toDate)
    {
        $holidayRequest = HolidayRequest::create([
            'employee_id' => Auth::id(),
            'fromDate' => $fromDate,
            'toDate' => $toDate
        ]);

        $holidayRequest->save();
    }

    public function getEmployeeHolidayRequests()
    {
        $requests = HolidayRequest::where('employee_id', Auth::id())->get();
        return $requests;
    }

    public function update(Request $request, $position)
    {
        if($position == 'employee') {
            $fromDate = new Datetime($request->only('fromDate')["fromDate"]);
            $toDate = new DateTime($request->only('toDate')["toDate"]);
            HolidayRequest::where('id', $request->only('id'))
                        ->update(['fromDate' => $fromDate, 'toDate' => $toDate]);

        } else if($position == 'teamLeader' || $position == 'projectManager') {
            //

        } else if($position == 'admin') {
            //
        }
    }

    
}