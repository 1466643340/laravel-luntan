<html>
<head>
    <title>留言板</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
</head>
<body>
<div class="loheader">
    <div class="htop">
        <div class="hlogo">
            <img src="/img/github.jpeg" alt="">
        </div>
        <div class="loginRe">
            @if(!session()->has('user'))
                <a href="login">登录</a> |
                <a href="register">注册</a>
            @endif
        </div>
      @if(url()->current() !=="http://www.jiaoxue.com/posts/id/message")
        <div class="submit">
            <a href="posts/id/message">发帖</a>
        </div>
      @endif
        <div class="logout">
            @if(session()->has('user'))
                <a href="/logout">退出</a>
            @endif
        </div>
    </div>
</div>
    @yield('content')
</body>
</html>

