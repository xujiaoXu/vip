<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    //
    public function curl_post($url , $data=array()){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output,true);
    }


    public function getcurl(){
        $url = "http://api.avatardata.cn/ActNews/Query?key=d242ff861d364de08c14ba7d835ae8a6&keyword=奥巴马";
        $info = $this->curl_post($url);
//        dd($info);
        $info = $info['result'];
        foreach ($info as $k =>$v){
//            dd($v);
//            array_unique($v);
            if(empty($v)){
                unset($info[$k]);
            }
            DB::table('test')->insert($v);
        }
//        dd($info);
    }

    public function sendcode(){
        $phone = '17853021510';
        $res = $this->send($phone);
        if($res->ReturnStatus == "Success"){
            echo "成功";
        }
    }

    public function send($phone){
        $host = "https://dxyzm.market.alicloudapi.com";
        $path = "/chuangxin/dxjk";
        $method = "POST";
        $appcode = "1d8e1b03e83d4b4784a9de01ce1659f2";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $code = rand(10000,99999);
        //测试可用默认短信模板,测试模板为专用模板不可修改,如需自定义短信内容或改动任意字符,请联系旺旺或QQ726980650进行申请
        $querys = "content=【".$code."】&mobile=$phone";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        Session::put('code',$code);
        return json_decode(curl_exec($curl));
    }
}
