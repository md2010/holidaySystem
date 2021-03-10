<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Twig</title>
</head>
<body>

    <form method="post" action="{{ route('processHolidayRequest') }}">
    @csrf 
        <label> From Date: </label> <br>
        <input type="date" id="4" name="fromDate"></input> <br><br>
        <label> To Date: </label> <br>
        <input type="date" id="5" name="toDate"></input> <br><br>

        @if($errors->any())
            <p style="color:red;"> {{ $errors->first() }} </p>
        @endif

        <input type="submit"  value="Send holiday request"> <br><br>
    </form>
</body>
</html>