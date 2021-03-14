<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Twig</title>
</head>
<body>

<h2> Team's holiday requests </h2>

@foreach ($requests as $e)
    <form method="post" action="{{ route('processHolidayRequestDecision', $e->id) }}">
    @csrf 
        <label> Request ID: </label> <br>
        <input type="text" id="1" name="id" value={{ $e->id }} readonly></input> <br><br>
        <label> Employee ID: </label> <br>
        <input type="text" id="1" value={{ $e->user_id }} readonly></input> <br><br>
        <label> From Date: </label> <br>
        <input type="date" id="4" name="fromDate" value={{ $e->fromDate }}  readonly></input> <br><br>
        <label> To Date: </label> <br>
        <input type="date" id="5" name="toDate" value={{ $e->toDate }}  readonly></input> <br><br>
        <label> Status: </label> <br>
        <input type="text" id="5" value={{ $e->status }} readonly></input> <br><br>
        <label> Project Manager Approval: </label> <br>
        <input type="text" id="5" value={{ $e->projectManagerApproval }} readonly></input> <br><br>
        <label> Team Leader Approval: </label> <br>
        <input type="text" id="5" value={{ $e->teamLeaderApproval }} readonly></input> <br><br>

        @if ($e->status == 'sent') 
                <input type="submit" value="Approve" name="button">
                <br><br>
                <input type="submit" value="Reject" name="button">
        @endif
        <br><br><br><br>
    </form>
@endforeach

</body>
</html>