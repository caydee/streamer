<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <title>@yield('title')</title>

        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    </head>

    <body>
    <main class="main h-100 w-100">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    </body>

</html>
