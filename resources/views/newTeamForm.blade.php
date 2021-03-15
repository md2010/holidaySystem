<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Add new team</title>

</head>
<body>

<form method="post" action="{{ route('addNewTeam') }}">
        @csrf 
        <label> Name: </label> <br>
        <input type="text" id="2" name="name"></input> <br><br>
        <label> Team Leader ID: </label> <br>
        <input type="text" id="3" name="teamLeaderID"></input> <br><br>
        <label> Project Manager ID: </label> <br>
        <input type="text" id="4" name="projectManagerID"></input> <br><br>

        @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;"> {{ $error }} </li>
            @endforeach
        </ul>
        @endif
        <br>

        <input type="submit" value="Add" name="button"> <br><br>
        
    </form>
    <br><br><br><br>
