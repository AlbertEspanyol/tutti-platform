<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tutti</title>

        <link rel="stylesheet" href="css/app.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    </head>
    <body>
    <div id="app">
        <main-header logged="{{false}}"></main-header>
        <div class="app-body">
            <home></home>
        </div>
    </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>
</html>
