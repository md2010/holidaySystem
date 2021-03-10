<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\HolidayRequestRepositoryInterface;

class HolidayRequestController extends Controller
{
    protected $employeeInterface;
    protected $holidayRequestInterface;

    public function __construct(
        EmployeeRepositoryInterface $employeeInterface, 
        HolidayRequestRepositoryInterface $holidayRequestInterface
        )
    {
        $this->employeeInterface = $employeeInterface;
        $this->holidayRequestInterface = $holidayRequestInterface;
    }

    public function showHolidayRequestForm()
    {
        return view('holidayRequestForm');
    }

    public function processEmployeeRequest(Request $request) 
    {
        $fromDate = new Datetime($request->only('fromDate')["fromDate"]);
        $toDate = new DateTime($request->only('toDate')["toDate"]);
        $availableDays = $this->employeeInterface->getAvailableDays();       
        $days = ($fromDate->diff($toDate))->d;
        
        if ($days <= $availableDays) {
            $this->employeeInterface->updateAvailableDays($days);
            $this->holidayRequestInterface->store($fromDate, $toDate);
            return Redirect::to('/employee');          
        } else {
            return Redirect::back()->withErrors(['You do not have enough available days left!']);
        }
    }

    public function showHolidayRequests()
    {
        $position = $this->employeeInterface->resolveUser();

        if($position == 'employee') {
            $requests = $this->holidayRequestInterface->getEmployeeHolidayRequests();
            return view('showHolidayRequests-employeeView')->with('requests', $requests);
        }
    }

    public function processHolidayRequestUpdate(Request $request)
    {
        $position = $this->employeeInterface->resolveUser();
        $this->holidayRequestInterface->update($request, $position);
        return Redirect::to('/myHolidayRequests');
    }
    
}
