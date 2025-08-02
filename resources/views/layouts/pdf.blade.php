<!DOCTYPE html>
<html @auth  lang="ar" dir="rtl" @else lang="en" dir="ltr"  @endauth>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>


        
        <style>
            .application{
                background-color:blue;
            }
        </style>




    </head>
    <body>
        <div class="">
            {{ $slot }}</div>
        
        
    </body>

</html>
