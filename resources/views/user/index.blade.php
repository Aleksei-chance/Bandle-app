<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bandle</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bandle_functions.js') }}"></script>
</head>
<body class="body_main">
    <div class="content">
        @if ($type == "bandle_list")
            @include('user.bandle.main')
        @elseif ($type == "bandle")
            @include('user.bandle.item')
        @endif
    </div>
    <div class="hover" id="hover"></div>
    <div class="modal" id="modal"></div>
    <div class="hover" id="hover_g" style="z-index: 3"></div>
    <div class="modal" id="modal_g" style="z-index: 4"></div>
</body>
</html>