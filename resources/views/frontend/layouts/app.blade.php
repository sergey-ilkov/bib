<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' | '. config('app.name') : config('app.name')}}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon-32x32.png') }}">



    <link rel="stylesheet" href="{{ asset('css/app/app.css') . '?v=' . rand(10, 1000)  }}">




    <script src="{{ asset('js/app/app.js') . '?v=' . rand(10, 1000)  }}" defer></script>

</head>

<body>


    <div class="wrapper page-{{$page}}">

        @include('frontend.includes.header')


        @yield('content')


    </div>

    <div id="modal-loader" class="modal-loader">
        <div class="loader"></div>
    </div>


    <div id="alert" class="alert">
        <div class="alert-message-wrap">
            <button class="alert-btn-close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="alert-message"></div>
        </div>
    </div>


</body>

</html>