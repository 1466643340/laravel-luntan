<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($this->all());
        if(session('loginNum')<3){
            return [
                'username' => ['required','exists:users,username','regex:/^1[345789][0-9]{9}$/'],
                'password' => ['required','regex:/^[\w_]{6,16}$/'],
            ];
        }else{
            return [
                'username' => ['required','exists:users,username','regex:/^1[345789][0-9]{9}$/'],
                'password' => ['required','regex:/^[\w_]{6,16}$/'],
                'captcha' =>['required','captcha']
            ];
        }      
    }
    
    public function messages()
    { 
        return  [
                'username.required'=>'请输入手机号',
                'username.exists'=>'用户不存在',
                'username.regex'=>'手机号格式不正确',
                'password.required'=>'密码不能为空',
                'password.regex'=>'密码长度为6-16位,且只能为字母,数字和下划线',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha' => '验证码错误'
            ];       
    }

    
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->failed()){
                if(!$this->session()->has('loginNum')){
                    $this->session()->put('loginNum',1);
                }else{
                    $this->session()->put('loginNum',session('loginNum')+1);
                }
            }
        });
        
    }
    
}
