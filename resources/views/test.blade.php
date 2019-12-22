<link rel="stylesheet" href="/css/index.css">
    @extends('layouts.app')
   @section('content')
   <main>
       {!! $paginate !!}
     <ul id='list' >
      @foreach($keyed as $v)
        <li>
         <div class='list_con'>
            <div class='title'>
                <h2>
                    <a href='posts/{{$v->id}}' onclick='handleViews(this)' viewsId='{{$v->id}} '>标题:{{$v->title}}
                    </a>
                </h2>
            </div>
            <div class='summary'>
                 {{$v->content}}
            </div>
            <div class='userbar'>
                <div>
                    <a href='/homePage/{{$v->user->id}}'>
                        <img src='{{$v->user->avatar}}'>
                    </a>
                </div>
                <div class='name'>{{$v->user->username}}</div>
                <div class='interactive'>
                   <div class='like' onclick='doLike(this)' postId='{{$v->id}}'>  点赞:{{$v->like_num}}</div>
                 <div class='view_num'>
                    <span>浏览:{{$v->view_num}}</span>
               </div>
               <div class='reply_num'>
                    <span >回复数:{{$v->reply_num}}</span>
               </div>
            </div>
          </div>
         </div>
       </li>
      @endforeach
    </ul>
   </main>
   @endsection

<script type="text/javascript">
    window.onload=function () {
        var jump=document.getElementsByClassName('jump')[0];
        jump.onclick=function(){
            var page=document.getElementsByClassName('page_inpt')[0].value;
            window.location.href="http://www.jiaoxue.com/posts?page="+page;
        }
    };
        function postData(url,data){
            return fetch(url,{
                body: data,
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].content,
                    'user-agent': 'Mozilla/4.0 MDN Example',
                    'content-type': 'application/x-www-form-urlencoded'
                    // 'content-type': 'application/json'
                },
                method: 'POST',
                mode: 'cors',
                redirect: 'follow',
                referrer: 'no-referrer',
            })
                .then(
                    function(response) {
                        return response.json();
                    }
                )
        }

        function doLike (t) {
            data = "id=" + t.getAttribute('postId');
            postData('/doLike/post', data).then(function (res) {
                if (res.code === "SUCCESS") {
                    //console.log(JSON.stringify(res));
                    t.innerHTML = " 点赞：" + res.data.like_num;

                }
            });
        };
        function handleViews(t){
            data = "id=" + t.getAttribute('viewsId');
            postData('/views/post', data).then(function (res) {
                if (res.code === "SUCCESS") {
                    t.innerHTML = " 浏览：" + res.data.view_num;
                }
            });
        }
</script>

