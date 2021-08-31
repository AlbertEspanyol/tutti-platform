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
    <img class="header-pre-background" src="storage/assets/images/backgrounds/HeaderPreBackground.svg" alt="pre_background">
    <main-header logged="{{false}}" current-page="Entrepreneurs"></main-header>
    <div class="app-body">
        <search-page search-type="entrepreneur"></search-page>
    </div>
    <tutti-footer></tutti-footer>
</div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
