<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{

    public function replyDoLike()
    {

//判断有无登录
        $user=session('user');
        if(!isset($user)){
            $response = [
                'code' => 'FAIL',
            ];
            echo json_encode($response);
            return;
        }
        $id=(int)$_POST['id'];

        $date=date('Y-m-d H:i:s');
        $all=DB::select('select * from reply where id=?',[$id]);

        $user_id=$all[0]->user_id;
        $post_id=$all[0]->posts_id;

        $all1=DB::select('select * from mylike where user_id=? and posts_id=? and type=1',[$user_id,$id]);
        if(!empty($all1)){
            $response=[
                'code' => 'FALE',
              ];
              echo json_encode($response);
              return;
        }else{
            $all2=DB::insert('insert into mylike values(?,?,?,?)',[$user_id,$id,1,"{$date}"]);
        }

        $all3=DB::update('update reply set like_num=like_num+1 where id=?',[$id]);
        $response = [
            'code' => 'SUCCESS',
            'data' => [
                'like_num' => $all[0]->like_num+1
            ],
        ];
        echo json_encode($response);
    }
}
