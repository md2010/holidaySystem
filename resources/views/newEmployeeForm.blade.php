<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Add new employee</title>

</head>
<body>

<form method="post" action="{{ route('addNewEmployee') }}">
        @csrf 
        <label> First Name: </label> <br>
        <input type="text" id="2" name="firstName"></input> <br><br>
        <label> Last Name: </label> <br>
        <input type="text" id="3" name="lastName"></input> <br><br>
        <label> Email: </label> <br>
        <input type="text" id="4" name="email"></input> <br><br>
        <label> Position: </label> <br>
        <input type="text" id="4" name="position"></input> <br><br>
        <label> Password: </label> <br>
        <input type="text" id="5" name="password"></input> <br><br>
        <label> Team ID: </label> <br>
        <input type="text" id="6" name="team_id"></input> <br><br>

        @if($errors->any())
            <p style="color:red;"> {{ $errors->first() }} </p>
        @endif

        <input type="submit" value="Add" name="button"> <br><br>
        
    </form>
    <br><br><br><br>
