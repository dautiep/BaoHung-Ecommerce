<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('chatbot/css/main.min.css') }}">
    @include('frontend.scripts.scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}" />


</head>

<body class="homepage">
    <main>
        @include('frontend.layout.bot')
        @include('frontend.layout.modal')
    </main>
    @yield('scripts')

</body>

</html>
