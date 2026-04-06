<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' | '. config('app.name') : config('app.name')}}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon-32x32.png') }}">



    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') . '?v=' . rand(10, 1000)  }}">




    <script src="{{ asset('js/auth/auth.js') . '?v=' . rand(10, 1000)  }}" defer></script>

</head>

<body>


    <div class="wrapper">

        @yield('content')

    </div>

    <div id="modal-loader" class="modal-loader">
        <div class="loader"></div>
    </div>

</body>

</html>