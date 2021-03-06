<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="antialiased bg-blue-900">
<div class="relative flex items-top justify-center min-h-screen dark:bg-gray-900 sm:items-center sm:pt-0 flex flex-col">
    <div class="font-semibold text-2xl text-red-400">Welcome to our registration!</div>

    <form action="/facebookregistration" method="post">

        @csrf

        <input type="text" name="email">
        <button>Enter Now</button>
    </form>

</div>

<div>

</div>

</body>
</html>
