<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Twig</title>
</head>
<body>

<h2> Team Info </h2>

@foreach ($team as $team)
    <form method="post" action="{{ route('processButtonActionTeam', $team->id) }}">
    @csrf 
    <label> ID: </label> <br>
            <input type="text" id="1" name="id" value ={{ $team->id }} ></input> <br><br>
            <label> Name: </label> <br>
            <input type="text" id="2" name="name" value={{ $team->name }} ></input> <br><br>
            <label> Project Manager ID: </label> <br>
            <input type="text" id="3" name="projectManagerID" value={{ $team->projectManagerID }} ></input> <br><br>
            <label> Team Leader ID: </label> <br>
            <input type="text" id="4" name="teamLeaderID" value={{ $team->teamLeaderID }} ></input> <br><br>

            @if (Request::url() === 'http://holidaysystem.local/admin/teams') 
                <input type="submit" value="Edit" name="button"> <br><br>
                <input type="submit" value="Delete" name="button"> <br><br>
            @endif
    </form>

    <form method="get" action="{{ route('showTeamMembersAdmin', $team->id) }}">
        <input type="submit" value="View team members">
    </form> <br>
    
    @if($errors->any())
        <p style="color:red;"> {{ $errors->first() }} </p>
    @endif

    <br><br><br><br>
@endforeach

</body>
</html>