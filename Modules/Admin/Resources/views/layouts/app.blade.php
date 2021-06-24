<html lang="en">    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Administrator</title>
        @include('admin::layouts.css')
        @stack('styles')
    </head>
    <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show" {{-- oncontextmenu="return false;" --}}>
        @include('admin::layouts.header')
        <div class="app-body">
            @if(!Auth::guest())
            @include('admin::layouts.sidebar')
            @endif
            @if(!Auth::guest())
            <main class="main">
            @else
            <main class="main" style="width:100%; margin:0;">
            @endif
                @yield('content')
            </main>
        </div>
        @include('admin::layouts.footer')
        @include('admin::layouts.js')
        @stack('scripts')
    </body>
    
</html>
