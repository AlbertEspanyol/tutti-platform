<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tutti</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
</head>
<body class="access">
<div id="app">
    <div class="app-body">
        <logo-only></logo-only>
        <access-card mode="{{$mode}}" users="{{ $users }}"></access-card>
    </div>
</div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
