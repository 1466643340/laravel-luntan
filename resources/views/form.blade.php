@extends('layouts.app')
    <style media="screen">
      main{
        width:660px;
        margin:47px auto 0 auto;
      }
      form{
        width:660px;

      }
      #title{
        width:660px;
        height:45px;
        border:0px;
        border-bottom:1px solid #ebebeb;
        font-size:32px;
        font-weight:600;
        line-height:1.4;
        outline:none;
        
      }
      #content{
        width:660px;
        height:300px;
        border:0;
        outline:none;
        font-size:16px;
        background:none;
       
      }
      #submit{
        color:#0084ff;
        outline:none;
        width:63px;
        padding:0 8.4px;
        border-color:#0084ff;
        border-radius:4px;
        height:32px;
        line-height:30px;
        background:none;
      }
       a{
        text-decoration:none;
        color:#0084ff;
        width:63px;
        height:32px;
        line-height:30px;
        padding:0 8.4px;
        font-size:16px;
      }  
    </style>

  @section('content')
    <main>
    <form method="POST" action="/posts/id/message">
    @csrf
      <input id="title" type="text" name="title" autocomplete="off" placeholder="请输入标题（最多 25 个字）" value="{{ session("_old_input")['title'] }}" >
      @error('title')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <br><br><br>
      <textarea id="content" placeholder="请输入正文" class="comment" type="text" name="content" value="{{ session("_old_input")['content'] }}" ></textarea>
      @error('content')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
	  <br><br>
      <input id="submit" type="submit" value="发布">
      <a href='/posts?page={{$page}}'>返回</a>
    </form>
    </main>
  @endsection
