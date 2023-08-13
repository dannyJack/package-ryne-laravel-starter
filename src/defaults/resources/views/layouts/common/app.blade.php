<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(View::hasSection('title'))@yield('title'){{ ' - ' }}@endif{{ config('app.name', '') }}</title>
    @vite(['resources/css/compile.css', 'resources/js/compile.js'])
    @stack('cssAsset')
    <link href="{{ _vers('css/app.css') }}" rel="stylesheet" />
    @stack('css')
</head>
<body class="@yield('bodyClass')" data-page="{{ \Request::route()->getName() }}">
    @yield('content')
    @stack('modals')
    @stack('jsAsset')
    <script src="{{ _vers('js/app.js') }}" defer></script>
    @stack('js')
    @include('assets/js/common/asset-js-toastr-message')
</body>
</html>