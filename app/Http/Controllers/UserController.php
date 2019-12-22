<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreBlogPost;
//use Illuminate\Support\Str;

class UserController extends Controller
    {
        public function register()
        {
            return view('register');
        }
        public function handleRegister(Request $request)
        {
            $message=[
                'username.required'=>'请输入手机号',
                'username.unique'=>'该用户已注册',
                'username.regex'=>'手机号格式不正确',
                'file.required'=>'请上传图片',
                'file.image'=>'请上传格式为jpeg,png和jpg的图片',
                'file.max'=>'请上传小于1M的图片',
                'password.required'=>'请输入密码',
                'password.regex'=>'密码格式不正确',
                'password_confirmation.required'=>'请确认密码',
                'password_confirmation.same'=>'密码不一致',
                'captcha.required'=>'请输入验证码',
                'captcha.captcha'=>'验证码错误'
            ];
            if(session('num')<3){
                $validator = Validator::make($request->all(),[
                    'username' => ['required','unique:users,username','regex:/^1[345789][0-9]{9}$/'],
                    'file' => [
                        'required',
                        'image:jpeg,png,jpg',
                        'max:1024',
                    ],
                    'password' => ['required','regex:/^[\w_]{6,16}$/'],
                    'password_confirmation'=> ['required','same:password'],
                ],$message);
            }else{
                $validator = Validator::make($request->all(),[
                    'username' => ['required','unique:users,username','regex:/^1[345789][0-9]{9}$/'],
                    'file' => [
                        'required',
                        'image:jpeg,png,jpg',
                        'max:1024',
                    ],
                    'password' => ['required','regex:/^[\w_]{6,16}$/'],
                    'password_confirmation'=> ['required','same:password'],
                    'captcha' => ['required','captcha']
                ],$message);
            }

            if ($validator->fails()) {
                if(!$request->session()->has('num')){
                    $request->session()->put('num',1);
                }else{
                    $request->session()->put('num',session('num')+1);
                }
                return redirect('/register')
                    ->withErrors($validator)
                    ->withInput();

            }else{
                $request->session()->forget('num');

                $userName=$request->input('username');
                $passWord=$request->input('password');
                $rePassword=$request->input('re_password');
                $ip=$request->getClientIp();
                $avatar=$request->file('file')->store('');
                $path='/avatar/'.$avatar;
                $insertUserId=[
                    'username' => $userName,
                    'password' => Hash::make($passWord),
                    'ip' => $ip,
                    'avatar' => $path,
                    'regist_date' => date('Y-m-d H:i:s')
                ];
                $id=DB::table('users')->insertGetId($insertUserId);
                return redirect('/login');
            }
        }
        public function login()
        {
            return view('login');
        }
        public function handleLogin(StoreBlogPost $request)
        {

            $userName=$request->input('username');
            $passWord=$request->input('password');
            $user=DB::table('users')->where('username',$userName)->first();
            if(Hash::check($passWord,$user->password)){
                $request->session()->forget('loginNum');

                $request->session()->put('user',$user);
                $url=$request->session()->get('loginBack');
                $route=explode('com',$url);
                $route=$route[0]==''?'/posts':$route[1];
                 return redirect($route);
            }else{
                $request->session()->flash('pwdError','密码错误');
                return redirect('/login')->withInput();
            }

        }
        public function logout(Request $request)
        {
            $request->session()->forget('user');
            return redirect('/posts');
        }
        public function homePage(Request $request,$id)
        {
            $user=DB::table('users')->where('id',$id)->get()->toArray();
//            dd($user);
            return view('homePage',['user'=>$user,'id'=>$id]);
        }
        public function handleHomePage(Request $request,$id)
        {
            $message=[
                'file.required'=>'请上传图片',
                'file.image'=>'请上传格式为jpeg,png和jpg的图片',
                'file.max'=>'请上传小于1M的图片',
            ];
            $validator = Validator::make($request->all(),[
                'file' => ['required', 'image:jpeg,png,jpg', 'max:1024'],
            ],$message);
            if ($validator->fails()) {
                return redirect("/homePage/{$id}")
                    ->withErrors($validator)
                    ->withInput();
            }
            $avatar=$request->file('file')->store('');
            $path='/avatar/'.$avatar;
            $user=DB::table('users')->where('id',$id)->update(['avatar'=>$path]);
            return redirect("/homePage/{$id}");
        }
    }
