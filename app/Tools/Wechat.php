<?php

namespace App\Tools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
class Wechat extends Model
{
    
    const appID = "wx622798c5aeda6e33";
    const appsecret = "5ecbfcb35df83b054700426cca9a2dda";
    
    public static function reponseText($xmlObj,$msg){
        echo "<xml>
        <ToUserName><![CDATA[".$xmlObj->FromUserName."]]></ToUserName>
        <FromUserName><![CDATA[".$xmlObj->ToUserName."]]></FromUserName>
        <CreateTime>".time()."</CreateTime>
        <MsgType><![CDATA[text]]></MsgType>
        <Content><![CDATA[".$msg."]]></Content>
        </xml>";die;
    }
    //调用access_tokne
    public static function getAccessToken(){
        //先判断缓存是否有数据
        $access_token = Cache::get('access_token');
        //有数据之间返回
        if(empty($access_token)){
            //获取access_toke(微信接口调用凭证)
            $url ="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".Self::appID."&secret=".Self::appsecret;
            $data = file_get_contents($url);
            $data = json_decode($data,true);
            $access_token = $data['access_token']; //token如何存储2小时 

            Cache::put('access_token',$access_token,7200);
        }
        //没有数据再进去掉微信接口获取 => 存入缓存
        return $access_token;
    }
    //获取用户信息
    public static function getUserInfoByOpenId($openid){
        $access_token = Self::getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $data = file_get_contents($url);
        $data = json_decode($data,true);
        return $data;
    }

}
