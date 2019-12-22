<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/login.css">
    <script src="/js/register.js"></script>
  </head>
  <body>
    <div class="loheader">
      <div class="htop">
        <div class="hlogo">
            <img src="/img/github.jpeg" alt="">
        </div>
      </div>
    </div>
    <div id="main">
      <div class="bglo">
        <div class="thed">
          <h2>登录</h2>
          <span><a href="/register">去注册 ></a></span>
        </div>
        <div class="logibox">
          <form method="POST" action="/login" class="form">
             @csrf
            <div class="itm ">
              <div class="ipt">
                <input id="username" type="text" name="username" class="wwinct r5" placeholder="请输入手机号" value="{{ session('_old_input')['username'] }}" />
                @error('username')
        				<span class="alert alert-danger">{{ $message }}</span>
        				@enderror
              </div>
            </div>
            <div class="itm ">
              <div class="ipt">
                <input type="password" name="password" class="wwinct r5" placeholder="请输入密码" />
             
                @error('password')
        				<span class="alert alert-danger">{{ $message }}</span>
                @enderror
                
                @if(session()->has('pwdError'))
                <span class="alert alert-danger">{{ session()->get('pwdError') }}</span>
                @endif
              </div>
            </div>
            <!-- <?php var_dump(session('loginNum')) ?> -->
            @if(session('loginNum')>=3)
						<div class="itm ">
              <div class="ipt">
              <div id="captcha" class="wwinct r5">{!! captcha_img() !!}</div>
              </div>
            </div>
						<div class="itm ">
							<div class="ipt">
							
							<input  type="text" name="captcha" class="wwinct r5" placeholder="请输入验证码" autocomplete="off" />
							@error('captcha')
        					<span class="alert alert-danger">{{ $message }}</span>
							@enderror
							</div>
						</div>
						@endif
            <div class="iloo">
              <input type="submit" value="登录" class="iptrdz" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>