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
            'user_id' => Auth::id(),
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);

        $holidayRequest->save();
    }

    public function getByID($id)
    {
        $request = HolidayRequest::findOrFail($requestID);
        return $request;
    }

    public function getAll()
    {
        $requests = HolidayRequest::all();
        return $requests;
    }

    public function getUnresolvedForAdmin($IDs)
    {
        $requests = HolidayRequest::whereIn('user_id', $IDs)->get();
        $requests = $requests->where('status', 'sent');
        return $requests;
    }

    public function getHolidayRequests() 
    {
        $requests = HolidayRequest::where('user_id', Auth::id())->get();
        return $requests;
    }

    public function getTeamsHolidayRequests($IDs)
    {
        $requests = HolidayRequest::whereIn('user_id', $IDs)->get();
        return $requests;
    }

    public function updateDate(Request $request)
    {       
        $fromDate = new Datetime($request->only('fromDate')["fromDate"]);
        $toDate = new DateTime($request->only('toDate')["toDate"]);
        HolidayRequest::where('id', $request->only('id'))
                    ->update(['fromDate' => $fromDate, 'toDate' => $toDate]);
    }

    public function concludeHolidayRequest($requestID, $position, $decision) 
    {
        if($position == 'teamLeader') {
            HolidayRequest::where('id', $requestID)
                    ->update(['teamLeaderApproval' => $decision]);

        } else if($position == 'projectManager') {
            HolidayRequest::where('id', $requestID)
                    ->update(['projectManagerApproval' => $decision]);

        } else if($position == 'admin') {
            HolidayRequest::where('id', $requestID)
                    ->update([
                        'teamLeaderApproval' => $decision, 
                        'projectManagerApproval' => $decision
            ]);
        } 
        $this->validateStatus($requestID);
    }

    public function validateStatus($requestID) 
    {
        $request = $this->getByID($requestID);
        if($request->teamLeaderApproval == 'APPROVED' && $request->projectManagerApproval == 'APPROVED') {
            HolidayRequest::where('id', $requestID)->update(['status' => 'APPROVED']); 

        } else if($request->teamLeaderApproval == 'REJECTED' || $request->projectManagerApproval == 'REJECTED') {          
            HolidayRequest::where('id', $requestID)->update(['status' => 'REJECTED']); 
        }
    }

    
}