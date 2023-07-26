<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/css/webapp.css')}}">
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
    
    <title>Rese</title>
    
</head>

<body>
    <section class="app">
    <div class="app-title">
        @yield('title')
    </div>
    <br>
    <div class="app_content">
        @yield('content')
    </div>
    </section>
</body>

</html>
