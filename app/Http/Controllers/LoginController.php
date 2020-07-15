<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Company;
use DB;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    //注册
    public function register(){
        return view('register.register');
    }

    public function do_register(Request $request){
        $info = $request->all();
        $info['pwd'] = md5($info['pwd']);
//        $info['create_at'] = time();
        $once = DB::table('Company')->where('name',$info['name'])->first();
        if(empty($once)){
            $res = DB::table('Company')->insert($info);
            if($res){
                echo json_encode(['errno'=>'00000','msg'=>'注册成功!!!']);
            }else{
                echo json_encode(['errno'=>'00001','msg'=>'注册失败!!!']);
                exit;
            }
        }else{
            echo json_encode(['errno'=>'00001','msg'=>'该用户已经存在!!!']);
            exit;
        }
    }
//    public function do_register(Request $request){
//        $post = $request->except('_token');
////        dd($post);
//        $res = Company::create($post);
//        if($res){
//            return redirect('/login/login');
//        }
//    }
    public function login(){
        return view('register/login');
    }

    public function do_login(Request $request){
        $name = $request->name;
        $pwd = $request->pwd;
        $user = DB::table('Company')->where('name',$name)->first();
        if(empty($user)){
            echo json_encode(['errno'=>'00001','msg'=>'用户名或密码错误!']);
            exit;
        }else if(md5($pwd) != $user->pwd){
            echo json_encode(['errno'=>'00001','msg'=>'密码错误!']);
            exit;
        }else{
            Session::put('userinfo',$user);
            echo json_encode(['errno'=>'00000','msg'=>'登录成功!!']);
        }
    }
}
