<html>
	<head>
		<meta charset="utf-8"/>
		<title></title>
		<link rel="stylesheet" href="/css/register.css">
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
					<h2>新用户注册</h2>
					<span>已有账号,  <a href="/login">直接登录 ></a></span>
				</div>
				<div class="logibox">
					<form method="POST" action="/register" enctype="multipart/form-data" class="form">
						 @csrf
						<div class="itm ">
							<div class="ipt">
								<input  placeholder="请输入手机号" class="wwinct r5" type="text" name="username" value="{{ session("_old_input")['username'] }}" />
								@error('username')
        						<span class="alert alert-danger">{{ $message }}</span>
        						@enderror
							</div>
						</div>
						<div class="itm ">
							<div class="ipt">
								<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
							上传头像:<input type="file" name="file" value="">
							@error('file')
        					<span class="alert alert-danger">{{ $message }}</span>
							@enderror
							</div>
						</div>
						<div class="itm ">
							<div class="ipt">
							<input id="password" type="password" name="password" class="wwinct r5" placeholder="请输入密码" value="{{ session("_old_input")['password'] }}"  />
							@error('password')
        					<span class="alert alert-danger">{{ $message }}</span>
							@enderror
							<div id="pwdcheck" style="display:none;">密码长度为6-16位 且只能包含字母,数字以及下划线</div>
							</div>
						</div>
						<div class="itm ">
							<div class="ipt">
								<input id="checkPassword" type="password" name="password_confirmation" class="wwinct r5" placeholder="确认密码" value="{{ session("_old_input")['password_confirmation'] }}"  />
								@error('password_confirmation')
        						<span class="alert alert-danger">{{ $message }}</span>
        						@enderror
							</div>
						</div>
						<?php var_dump(session('num')); ?>
						@if(session('num')>=3)

						{!! captcha_img() !!}
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
							<input id="signup" type="submit" value="注册" class="iptrdz" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
