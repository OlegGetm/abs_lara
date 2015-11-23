<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - Админка</title>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:700&subset=latin,cyrillic' rel='stylesheet' type='text/css'></link>
        <link rel="stylesheet" href="/css/font-awesome.css">
        <link rel="stylesheet" href="/css/admin.css">
    </head>
    <body>
        <div class="container">
            @yield('sidebar')
            @yield('content')
        </div>
        <!-- js core -->
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="/js/admin.js"></script>
        <!-- js app -->
        @stack('scripts')
    </body>
</html>