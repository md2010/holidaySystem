<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Interfaces\HolidayRequestRepositoryInterface;
use App\Models\HolidayRequest;

class HolidayRequestRepository implements HolidayRequestRepositoryInterface
{
    public function store(DateTime $fromDate, DateTime $toDate)
    {
        $holidayRequest = HolidayRequest::create([
            'user_id' => Auth::id(),
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);

        $holidayRequest->save();
    }

    public function getByID(int $id)
    {
        $request = HolidayRequest::findOrFail($id);
        return $request;
    }

    public function getAll()
    {
        $requests = HolidayRequest::all();
        return $requests;
    }

    public function getByUserID($ID)
    {
        $requests = HolidayRequest::whereIn('user_id', $ID)->get();
        return $requests;
    }

    public function update($data) 
    {
        $request = $this->getByID($data['id']);

        foreach($data as $key => $value) {
           $request->$key = $value;
           $request->save();
        }
    }

    public function concludeHolidayRequest(int $requestID, string $position, string $decision) 
    {
        $request = $this->getByID($requestID);

        if($position == 'teamLeader') {
               $request->update(['id' => $requestID, 'teamLeaderApproval' => $decision]);

        } else if($position == 'projectManager') {
                $request->update(['id' => $requestID, 'projectManagerApproval' => $decision]);

        } else if($position == 'admin') {
                $request->update([
                        'teamLeaderApproval' => $decision, 
                        'projectManagerApproval' => $decision
            ]);
        } 
        $this->validateStatus($request);
    }

    public function validateStatus(HolidayRequest $request) 
    {
        if($request->teamLeaderApproval == 'APPROVED' && $request->projectManagerApproval == 'APPROVED') {
            $request->update(['status' => 'APPROVED']); 

        } else if($request->teamLeaderApproval == 'REJECTED' || $request->projectManagerApproval == 'REJECTED') {        
            $request->update(['status' => 'REJECTED']); 
        }
    }

    
}