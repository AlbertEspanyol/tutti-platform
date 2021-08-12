<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tutti</title>

    <link rel="stylesheet" href="css/app.css">
</head>
<body>

<h1>Login</h1>

<button type="button" value="Register" onclick="window.location='{{ url("register") }}'">Register</button>

<form>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="password1">Password:</label>
    <input type="password" id="password1" name="password1"><br><br>
    <input type="checkbox" value="rememberMe">
    <label for="checkbox">Remember me?</label><br><br>
    <input type="submit" value="Login">
</form>

<p>Not a member yet? Register</p>

</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
