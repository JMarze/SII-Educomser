<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            width: 100%;
        }
        h1{
            width: 100%;
            text-align: center;
        }
    </style>
    @yield('style')
</head>

<body>
    @yield('content')
</body>
</html>
