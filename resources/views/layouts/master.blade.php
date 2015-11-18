<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - Laravel-версия &quot;АБС-авто&quot;</title>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:700&subset=latin,cyrillic' rel='stylesheet' type='text/css'></link>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/font-awesome.css">
        <link rel="stylesheet" href="/css/site.css">
    </head>
    <body>
        <div class="container page-wrap padding-null">
            @include('layouts.partials.header')
            @include('layouts.partials.navbar')
            @yield('pagemaster')
            @include('layouts.partials.footer')
        </div>
        <!-- js core -->
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!-- js app -->
        @stack('scripts')
    </body>
</html>