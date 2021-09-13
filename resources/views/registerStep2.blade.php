<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tutti</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="reg2">
<div id="app">
    <div class="app-body">
        <logo-only></logo-only>
        <register-step2 reg-user="{{$user}}"></register-step2>
    </div>
</div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
