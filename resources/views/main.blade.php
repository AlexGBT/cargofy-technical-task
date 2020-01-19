<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>Instadogs</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

<div id="app">
    <div class="container">
        <div class="row mt-5">
            <h2>Біржа вантажів</h2>
        </div>
        <div class="row mt-5">
            <button type="button" class="btn btn-secondary px-4 py-0 text-dark" data-toggle="modal" data-target="#addLoadModal">Додати</button>
        </div>
        <div class="row mt-5">
            <table-dynamic :loads="loads"></table-dynamic>
        </div>
    </div>

    <div>
        @include('additional.modal')
    </div>


</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJjfC_sjWNKRtya3f6FNOwCE9qbL59lD8"
        async defer></script>

 </body>
</html>


