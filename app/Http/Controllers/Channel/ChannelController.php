<?php

namespace App\Http\Controllers\Channel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Wechat;
use App\Tools\Curl;
use App\Model\Channel;
class ChannelController extends Controller
{
    public function add(){
        return view('channel.add');
    }
    public function add_do(Request $request){
        //接值
        // $channel_name = $request->input('channel_name');
        // $channel_status = $request->input("channel_status");
        $data = $request->input();
        //调用 微信生成带参数的二维码接口
        $access_token = Wechat::getAccessToken();
        //地址
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
        // echo $url;die;
        //参数
        $postData = '{"expire_seconds": 259200, "action_name": "QR_STR_SCENE", "action_info": {"scene": {"scene_str": "'.$data['channel_status'].'"}}}';
        // dd($postData);
        //发送请求
        // $res = Curl::post($url,$postData);
        $res = json_decode($res,true);
        $data['ticket'] = $res['ticket'];
        // dd($data);


        //发送请求
        $postData=json_encode($postData,JSON_UNESCAPED_UNICODE);
        $res = Curl::post($url,$postData);
        $res = json_decode($res,true);
        $ticket = $res['ticket'];

        //入库
        $post = Channel::create($data);
        if($post){
            echo "<script>alert('添加成功');location='/channel/list'</script>";
        }else{
            echo "<script>alert('添加失败');location='/channel/add'</script>";
        }

    }
    //列表展示
    public function list(){
        $data = Channel::get();
        return view('channel.list',['data'=>$data]);
    }






}
