<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tutti</title>

    <link rel="stylesheet" href="css/app.css">
</head>
<body>

<h1>Register</h1>

<button type="button" value="Login" onclick="window.location='{{ url("login") }}'">Login</button>

<form>
    <label for="fname">Full name:</label>
    <input type="text" id="fname" name="fname"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="password1">Password:</label>
    <input type="password" id="password1" name="password1"><br><br>
    <label for="password2">Repeat Password:</label>
    <input type="password" id="password2" name="password2"><br><br>
    <label for="birthday">Birthday:</label>
    <input type="date" id="birthday" name="birthday"><br><br>
    <input type="checkbox" value="termsOfService">
    <label for="checkbox">I agree to all the stetements in Terms Of Service</label><br><br>
    <input type="submit" value="Register">
</form>

<p>Already a member? Log in</p>

</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
