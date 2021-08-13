<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tutti</title>

    <link rel="stylesheet" href="css/app.css">
</head>
<body class="login">
<div id="app">
    <logo-only></logo-only>
    <acess-card></acess-card>
</div>
<footer></footer>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
