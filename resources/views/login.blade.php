<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Log in</title>
</head>
<body>
    <form method="post" action="{{ url('/auth') }}">
    @csrf 
        <label> Email: </label> <br>
        <input type="text" id="1" name="email" class="form-control p_input"></input> <br><br>
        <label> Password: </label> <br>
        <input type="password" id="2" name="password" class="form-control p_input"></input>
        <br> <br>
        <input class="btn btn-success" name="submit" type="submit" value="Log in">
    </form>
</body>
</html>