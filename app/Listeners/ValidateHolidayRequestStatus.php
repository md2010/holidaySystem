<?php

namespace App\Listeners;

use App\Events\HolidayRequestStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\HolidayRequest;

class ValidateHolidayRequestStatus
{
    public function __construct()
    {
        //
    }

    public function handle(HolidayRequestStatus $event)
    {
        $holidayRequest = $event->holidayRequest;

        if($holidayRequest->teamLeaderApproval == 'APPROVED' && $holidayRequest->projectManagerApproval == 'APPROVED') {
            $holidayRequest->update(['status' => 'APPROVED']); 

        } else if($holidayRequest->teamLeaderApproval == 'REJECTED' || $holidayRequest->projectManagerApproval == 'REJECTED') {        
            $holidayRequest->update(['status' => 'REJECTED']); 
        }
    }
}
