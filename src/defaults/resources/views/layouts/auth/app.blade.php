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
<body class="hold-transition sidebar-mini layout-fixed @yield('bodyClass')" data-page="{{ \Request::route()->getName() }}">
    <main>
        <div class="main-container">
            <div class="wrapper">
                @include('layouts.auth.header')
                @include('layouts.auth.aside')
                <div class="content-wrapper">
                    @include('layouts.auth.content-header')
                    <section class="content px-4">
                        @yield('content')
                    </section>
                </div>
                <div id="spinner-overlay" class="text-center align-items-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @stack('modals')
    @stack('jsAsset')
    <script src="{{ _vers('js/app.js') }}" defer></script>
    @stack('js')
    @include('assets/js/common/asset-js-toastr-message')
</body>
</html>