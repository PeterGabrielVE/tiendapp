<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tiendapp</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
            <div id="app" class="content">
                <example-component></example-component><!--Añadimos nuestro componente vuejs-->
            </div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
