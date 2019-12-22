<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title></title>
    <style>
        .form{
            display: none;
        }
        a{
            text-decoration: none;
        }
        img{
            width:30px;
            height:30px;
        }
    </style>
</head>
<body>
    <ul>
        @foreach($keyedDetail as $v)
            <li>
                <img src={{$v->user->avatar}}>&nbsp &nbsp
                <span>ID:{{$v->user->username}} </span><br/>
                <span>  标题:{{$v->title}}</span><br/>
                <span>  内容:{{$v->content}}</span><br/>
                <span> 时间: {{$v->date}}</span>
            </li>
        @endforeach
    </ul>

    <div>
        <ul>
        @foreach($keyedReply as $v)
            <li>
          <img src={{$v->user->avatar}}>
           用户:<span>{{$v->user->username}}</span>&nbsp &nbsp
           <span class='content'>回复: {{$v->comment}}</span>&nbsp&nbsp
           <span onclick='doLike(this)' replyId={{$v->id}}>点赞:{{$v->like_num}}</span>
           </li>
         @endforeach
        </ul>
    </div>

     <div class="form">
    <form method="POST" action="">
    @csrf
    @error('comment')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <textarea class="comment" type="text" name="comment" value="{{ session("_old_input")['comment'] }}"></textarea>
      <input class="submit" type="submit" value="提交">
    </form>
  </div>
    <input class="btn" type="button" name="" value="回复">
    <a href="/posts?page={{$page}}">返回</a>
</body>
</html>
<script type="text/javascript">

  var btn=document.getElementsByClassName('btn')[0];
  var form=document.getElementsByClassName('form')[0];
  btn.onclick=function(){
    if(form.style.display=="none"){
        form.style.display="block";
    }else{
      form.style.display="none";
    }
  }

  function postData(url,data){
    return fetch(url,{
      body: data,
      cache: 'no-cache',
      credentials: 'same-origin',
      headers: {
        'X-CSRF-TOKEN':document.getElementsByName('csrf-token')[0].content,
        'user-agent': 'Mozilla/4.0 MDN Example',
        'content-type': 'application/x-www-form-urlencoded'
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
			data = "id=" + t.getAttribute('replyId');
			postData('/reply/post', data).then(function (res) {
				if (res.code === "SUCCESS") {
					t.innerHTML = " 点赞：" + res.data.like_num;
				}
			});
		};

</script>
