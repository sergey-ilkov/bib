<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Page</title>

    <style>
        body {
            font-family: system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Oxygen,
                Ubuntu,
                Cantarell,
                "Open Sans",
                "Helvetica Neue",
                sans-serif;
            ;
        }
    </style>

    <script src="{{ asset('js/test/test.js') . '?v=' . rand(10, 1000)  }}" defer></script>
</head>

<body>
    <h3>Test page</h3>

</body>

</html>