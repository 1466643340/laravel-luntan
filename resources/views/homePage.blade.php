<html>
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="stylesheet" href="/css/register.css">
    <link rel="stylesheet" href="/css/homePage.css">
</head>
<body>
<div class="loheader">
    <div class="htop">
        <div class="hlogo">
            <img src="/img/github.jpeg" alt="">
        </div>
    </div>
</div>
<div data-v-357a65ed="" class="container view">
    <div data-v-357a65ed="" class="left_box">
        <ul data-v-357a65ed="" class="aside">
            <li data-v-357a65ed="" class="router-link-exact-active router-link-active"><a data-v-357a65ed=""
                                                                                          href=""
                                                                                          class="zl">个人资料</a></li>
            <li data-v-357a65ed="" class=""><a data-v-357a65ed="" href="" class="zl">我的收藏</a></li>
            <li data-v-357a65ed="" class=""><a data-v-357a65ed="" href="" class="zl">我的勋章</a></li>
            <li data-v-357a65ed="" class=""><a data-v-357a65ed="" href="" class="zl">我关注的人</a></li>
            <li data-v-357a65ed="" class=""><a data-v-357a65ed="" href="" class="zl">我的粉丝</a></li>
            <li data-v-357a65ed="" class=""><a data-v-357a65ed="" href="" class="zl">我的标签</a></li>
        </ul>
        <ul data-v-357a65ed="" class="aside">
            <li data-v-357a65ed=""><a data-v-357a65ed="" href="https://mp.csdn.net/" target="_blank"
                                      data-report-click="{&quot;mod&quot;:&quot;popu_790&quot;,&quot;dest&quot;:&quot;https://mp.csdn.net/&quot;,&quot;extend1&quot;:&quot;我的博客&quot;}"
                                      class="zl">我的博客</a></li>
            <li data-v-357a65ed=""><a data-v-357a65ed="" href="https://edu.csdn.net/mycollege" target="_blank"
                                      data-report-click="{&quot;mod&quot;:&quot;popu_790&quot;,&quot;dest&quot;:&quot;https://edu.csdn.net/mycollege&quot;,&quot;extend1&quot;:&quot;我的学院&quot;}"
                                      class="zl">我的学院</a></li>
            <li data-v-357a65ed=""><a data-v-357a65ed="" href="https://download.csdn.net/my/uploads" target="_blank"
                                      data-report-click="{&quot;mod&quot;:&quot;popu_790&quot;,&quot;dest&quot;:&quot;https://download.csdn.net/my/uploads&quot;,&quot;extend1&quot;:&quot;我的下载&quot;}"
                                      class="zl">我的下载</a></li>
            <li data-v-357a65ed=""><a data-v-357a65ed="" href="https://bbs.csdn.net/user/point" target="_blank"
                                      data-report-click="{&quot;mod&quot;:&quot;popu_790&quot;,&quot;dest&quot;:&quot;https://bbs.csdn.net/user/point&quot;,&quot;extend1&quot;:&quot;我的论坛&quot;}"
                                      class="zl">我的论坛</a></li>
            <li data-v-357a65ed=""><a data-v-357a65ed="" href="https://ask.csdn.net/my" target="_blank"
                                      data-report-click="{&quot;mod&quot;:&quot;popu_790&quot;,&quot;dest&quot;:&quot;https://ask.csdn.net/my&quot;,&quot;extend1&quot;:&quot;我的问答&quot;}"
                                      class="zl">我的问答</a></li>
            <li data-v-357a65ed="" class=""><a data-v-357a65ed="" href="#/uc/reward" class="zl">签到赢福利</a></li>
            <li data-v-357a65ed="" class=""><a data-v-357a65ed="" href="#/uc/draw" class="zl">抽奖</a></li>
        </ul>
    </div>

  <div data-v-357a65ed="" class="view-container">
        <div data-v-0d738edb="" data-v-357a65ed="" class="cont view">
            <div data-v-0d738edb="" class="right_cont"><h3 data-v-0d738edb="" class="title">个人资料</h3>
                <div data-v-0d738edb="" class="user_info">
                    <div data-v-0d738edb="" class="header"><img data-v-0d738edb=""
                                                                src="{{ $user[0]->avatar }}"
                                                                alt="" class="head">
                        @if(session()->has('user') && session('user')->id == $id)
                        <form method="POST" action="/homePage/{{$id}}" enctype="multipart/form-data" class="form">
                            @csrf
                            <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
                            <input type="file" name="file" value="">
                            @error('file')
                            <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                            <input type="submit" value="上传" >
                        </form>
                        @endif
                        <p data-v-0d738edb="" class="modify">修改头像</p></div>
                    <div data-v-0d738edb="" class="right_c">
                        <div data-v-0d738edb="" class="right_info">
                            <div data-v-0d738edb="" class="id_card"><span data-v-0d738edb="" class="id_name">ID：{{$user[0]->username}}</span>
                                <a data-v-0d738edb="" href=""
                                                   target="_blank" class="user_home">个人主页</a></div>
                        </div>
                        <div data-v-0d738edb="" class="csdn_info"><span data-v-0d738edb=""
                                                                        style="margin-right: 16px; color: rgb(77, 77, 77); font-size: 14px;">关注 0</span>
                            <span data-v-0d738edb=""
                                  style="margin-right: 16px; color: rgb(77, 77, 77); font-size: 14px;">粉丝 0</span> <span
                                data-v-0d738edb="" class="splits">|</span> <span data-v-0d738edb=""
                                                                                 style="margin-right: 8px; color: rgb(77, 77, 77); font-size: 14px;">C币  0</span>
                            <a data-v-0d738edb="" href="" class="charge">充值</a></div>
                        <div data-v-0d738edb="" class="warn_tip"><!----> <a data-v-0d738edb=""
                                                                            href="https://mall.csdn.net/vip"
                                                                            class="csdn_msg">开通会员</a> <span
                                data-v-0d738edb="" class="tip_words">*温馨提示：会员显示时间更新有延迟，请稍后再查看</span></div>
                        <div data-v-0d738edb="" class="line"></div>
                        <div data-v-0d738edb="" class="nick"><span data-v-0d738edb="">昵称：</span> <span
                                data-v-0d738edb="" class="mod">修改资料</span></div>
                        <ul data-v-0d738edb="" class="self">
                            <li data-v-0d738edb="" class="comon">实名：</li>
                            <li data-v-0d738edb="" class="comon">性别：</li>
                            <li data-v-0d738edb="" class="comon">生日：</li>
                            <li data-v-0d738edb="" class="comon">地区：</li>
                            <li data-v-0d738edb="" class="comon">行业：</li>
                            <li data-v-0d738edb="" class="comon last">职位：</li>
                            <li data-v-0d738edb="" class="intro"><span data-v-0d738edb="" class="noWid">简介：</span>
                                <span data-v-0d738edb="" class="cont"></span></li>
                        </ul>
                    </div>
                </div>
            </div> <!---->

            <!----></div>

    </div>
</div>
</body>
</html>


