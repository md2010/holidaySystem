<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;

class ManagerLeaderController extends Controller
{
    protected $userInterface;
    protected $teamInterface;

    public function __construct(
        UserRepositoryInterface $userInterface,
        TeamRepositoryInterface $teamInterface
    ) {
        $this->userInterface = $userInterface;
        $this->teamInterface = $teamInterface;
    }

    public function index()
    {
        $user = $this->userInterface->getByID(Auth::id());  
        return view('Manager&Leader')->with('value', $user);
    }

    public function showTeamMembers($team_id)
    {          
        $members = $this->teamInterface->getTeamMembers($team_id);      
        return view('showTeamMembers')->with('member', $members);
    }

    public function showTeamInfo($team_id)
    {
        $teamInfo = $this->teamInterface->getByID($team_id);
        return view('teamInfo')->with('team', array($teamInfo));
    }

}
