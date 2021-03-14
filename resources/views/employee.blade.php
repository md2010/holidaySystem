<!DOCTYPE html>

<html>

<link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">

<head>
    <meta charset="utf-8">
    <title>Twig</title>

    <style>
         table {
            border: 3px solid  #333;
            margin-top: 20px;
            margin-bottom: 40px;
            text-align: center; 
            width: 800px;
            padding:10px;
         }
      </style>

</head>
<body>

<form method="get" action="{{ route('logout') }}">
    <input type="submit" value="Log out">
</form> <br> 

<table>
    <thead>
        <tr>
            <th> ID </th> 
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th style="text-align:center">Position</th>
            <th>Holiday (available)</th>
            <th>Team ID</th>
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->firstName}}</td>
            <td>{{$value->lastName}}</td>
            <td>{{$value->email}}</td>             
            <td>{{$value->passwordVisible}}</td>
            <td>{{$value->position}}</td>  
            <td>{{$value->availableDays}}</td> 
            <td>{{$value->team_id}}</td>            
        </tr>
        
    </tbody>
</table>  
        
<form method="get" action="{{ route('holiday-request-form') }}">
    <input type="submit" value="Make new holiday request">
</form> <br> 

<form method="get" action="{{ route('holiday-requests') }}">
    <input type="submit" value="View my holiday requests">
</form> <br> 

</body>
</html>