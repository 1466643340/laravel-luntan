<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use lluminate\Support\Collection;
use App\Models\Post;
use App\Models\User;
use App\Models\Reply;

class PostController extends Controller
{
    public function index()
    {
        $all=Post::orderBy('id','asc')->get();
        $user=session('user');

        !isset($_GET['page']) ? ($page=1) :  $page=(int) $_GET['page'];
        $limit=4;

         if($page<1){

           $page=1;

         }else if($page>ceil(count($all)/$limit)){

           $page=(int)ceil(count($all)/$limit);

         }
         $offset=($page-1)*$limit;

         $paginate=handlePagination(count($all),$page,$limit);

         $keyed=Post::with('user')
                      ->orderBy('id','asc')
                      ->offset($offset)
                      ->limit(4)
                      ->get();
         return view('test',['user'=>$user,'keyed'=>$keyed,'paginate'=>$paginate]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count=Post::count();
        $limit=4;
        $page=(int)ceil($count/$limit);
        return view('form',['page'=>$page]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message=[
            'title.required'=>'标题不能为空',
            'title.max'=>'标题不能超过25个字',
            'content.required'=>'内容不能为空',
            'content.max'=>'内容不能超过256'
        ];
        $validator = Validator::make($request->all(), [
            "title" => ['required','max:25'],
            "content" => ['required','max:255']
        ],$message);

        if ($validator->fails()) {
            return redirect('/posts/id/message')
                ->withErrors($validator)
                ->withInput();
        }else{
            $title=$request->input('title');
            $content=$request->input('content');
            $date=date('Y-m-d H:i:s');
            $user=session('user');
            $userId=$user->id;

            $count=DB::table('posts')->count();
            $limit=4;
            $page=(int)ceil($count/$limit);
            if(is_int($count/$limit)){
                $page=$page+1;
            }

            $insertPostId=[
                'user_id'=>$userId,
                'title'=>"{$title}",
                'content'=>"{$content}",
                'view_num'=>0,
                'like_num'=>0,
                'reply_num'=>0,
                'date'=>"{$date}",
            ];
            $id=Post::insertGetId($insertPostId);
            if($id){
                return redirect("/posts?page={$page}");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function details($id)
    {
//        $all=DB::select('select * from posts where id=?',[$id]);
//        $arrDetail=[];
//        foreach($all as $k => $v){
//            $arrDetail[$k]=$v->user_id;
//        }
//        $collection=DB::table('users')->whereIn('id',$arrDetail)->get();
//        $keyedDetail=$collection->keyBy('id')->all();
        $keyedDetail=Post::with('user')->where('id',$id)->get();

        $keyedReply=Reply::with('user')->where('posts_id',$id)->get();

        $page=(int)ceil($id/4);
        return view('details',['id'=>$id,'page'=>$page,'keyedReply'=>$keyedReply,'keyedDetail'=>$keyedDetail]);
    }
    public function handleDetails(Request $request,$id)
    {
        $user=session('user');
        //dd($user);
            $message=[
               'comment.required'=>'评论不能为空',
               'comment.max'=>'字数不能超过100个'
            ];
            $validator = Validator::make($request->all(),[
                'comment'=>['required','max:100']
            ],$message);

            if ($validator->fails()){
                return redirect("/posts/{$id}")
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $comment=$request->input('comment');
                $insertReplyId=[
                    'user_id'=>$user->id,
                    'posts_id'=>$id,
                    'comment'=>$comment,
                    'like_num'=>0
                ];
                $replyId=Reply::insertGetId($insertReplyId);
                $count=Reply::where('posts_id',$id)->count();

                $all1=Post::where('id',$id)->update(['reply_num'=>$count]);

                if($replyId){
                    return redirect("/posts/{$id}");
                }
            }
    }
    public function doLike()
    {
        $id =(int)$_POST['id'];
        $date=date('Y-m-d H:i:s');
        $all=DB::select('select * from posts where id=?',[$id]);
        $user=session('user');
        if(!isset($user)){
            $response = [
                'code' => 'FAIL',
            ];
            echo json_encode($response);
            return;
        }
        $user_id=$all[0]->user_id;

        $all1=DB::select('select * from mylike where user_id=? and posts_id=? and type=0',[$user_id,$id]);
        if(!empty($all1)){
            $response=[
                 'code' => 'FALE',
               ];
               echo json_encode($response);
               return;
          }else{
              $all2=DB::insert('insert into mylike values(?,?,?,?)',[$user_id,$id,0,"{$date}"]);
          }
          $all3=DB::update('update posts set like_num=like_num+1 where id=?',[$id]);
          $response = [
            'code' => 'SUCCESS',
            'data' => [
                'like_num' => $all[0]->like_num+1
            ],
        ];
        echo json_encode($response);
    }
    public function views()
    {
        $user=session('user');
        if(!isset($user)){
            $response = [
                'code' => 'FAIL',
            ];
            echo json_encode($response);
            return;
        }
//获取帖子id和发帖人的用户id
        $id =(int)$_POST['id'];
        $date=date('Y-m-d H:i:s');
        $all=DB::select('select * from posts where id=?',[$id]);
        $user_id=$all[0]->user_id;
//将获取的信息存储到浏览列表里
        $all1=DB::insert('insert into views values(?,?,?)',[$user_id,$id,"{$date}"]);
//修改帖子表里的浏览量
        $all2=DB::update('update posts set view_num=view_num+1 where id=?',[$id]);
        $response = [
            'code' => 'SUCCESS',
            'data' => [
                'view_num' => $all[0]->view_num+1
            ],
        ];
        echo json_encode($response);
    }
}
