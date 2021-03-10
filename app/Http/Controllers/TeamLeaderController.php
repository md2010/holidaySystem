<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\TeamLeaderRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;

class TeamLeaderController extends Controller
{
    protected $teamLeaderInterface;
    protected $teamInterface;

    public function __construct(
        TeamLeaderRepositoryInterface $teamLeaderInterface,
        TeamRepositoryInterface $teamInterface
        )
    {
        $this->teamLeaderInterface = $teamLeaderInterface;
        $this->teamInterface = $teamInterface;
    }

    public function index()
    {
        $teamLeader = $this->teamLeaderInterface->getByID(Auth::id());  
        return view('teamLeader')->with('value', $teamLeader);
    }

    public function showTeamMembers()
    {
        $members = $this->teamInterface->getTeamMembers();      
        return view('showTeamMembers')->with('member', $members);
    }

    public function showTeamsHolidayRequests()
    {

    }
}
