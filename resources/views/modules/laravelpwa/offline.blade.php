<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Levcorp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    @laravelPWA
    <style>
        body{
            font-family: 'Roboto', sans-serif;
            margin: 0;
            margin-bottom: 40px;
        }
        html{
            html {
                min-height: 100%;
                position: relative;
            }
    </style>
</head>
<body>
    <div id="app">
         <router-view></router-view>
    </div>
</body>
<script src="{{asset('js/mobile.js')}}"></script>
</html>