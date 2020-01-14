<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Wechat;
use App\Model\Xinwen;
use App\Model\Channel;
use App\Model\User;
use App\Model\WechatUser;
use Illuminate\Support\Facades\Redis;
class WechatController extends Controller
{
    public function wechat(){
        //提交按钮 微信服务器GET请求=> echostr
        //原样输出echostr即可

        	// $echostr = $_GET['echostr'];
            // echo $echostr;die;

        //接入完成之后 微信公众号内用户任何操作  微信服务器=> POST形式XMl格式  发送到配置的usr上

        $xml = file_get_contents("php://input");//接受原始的xml或json数据流
        //var_dump($xml);
        //写到文件里
        file_put_contents("log.txt","\n".$xml."\n",FILE_APPEND);

        //方便处理 xml=> 对象
        $xmlObj = simplexml_load_string($xml);
        //回复文本消息
        //输出一个xml数据

        $student=['陈亚涛','马子正','滕乙嘉'];


        //如果是关注
        if($xmlObj->MsgType == 'event' && $xmlObj->Event == 'subscribe'){
            //关注时  获取用户基本信息
            $userData=Wechat::getUserIndoByOpenId($xmlObj->FromUserName);
            dd($userData);
            //根据渠道标识  关注人数递增
            $ticket_cations = $userData['qr_scene_str'];
            dd($ticket_cations);
            //根据渠道标识  关注人数递增
            Channel::where(['ticket'=>$ticket_cations])->increment('channel_num');


            $data=[
                'openid'    => $userData['openid'],  
                'subscribe_time' => $userData['subscribe_time'], //用户关注自己的时间
                'headimgurl'  => $userData['headimgurl'],  //头像
                'c_status'    => $userData['c_status'],  //渠道标识
                'sex' => $userData['sex'],              //性别
                'nickname' => $userData['nickname'], //用户名
            ];

            $userInfo = WechatUser::create($data);

            $sex = $userData['sex'];
            $nickname = $userData['nickname'];//受到用户名称
  
            if($sex == 1){
                $msg = "欢迎".$nickname."男士关注";
            }elseif($sex == 2){
                $msg = "欢迎".$nickname."女士关注";
            }else{
                $msg = "欢迎".$nickname."未知关注";
            }   
            Wechat::reponseText($xmlObj,$msg);
        }
        //如果取消关注
        //  if($xml_obj->MsgType == 'event' && $xml_obj->Event == 'unsubscribe'){   
        //     //用户基本信息表  修改状态
        //     $where = [
        //             ['openid','=',$xml_obj->FromUserName]
        //         ];
        //         CuserModel::where($where)->update(['is_del'=>2]);  
        //     //得到渠道标识
        //     $res1 = CuserModel::where($where)->first()->toArray(); 
        //     //查询用户信息表 通过openid $xmlObj->FromUserName

        //     //渠道表统计人数-1
        //     $channelWhere = [
        //         ['sign','=',$res1['sign']]
        //     ];
        //     ChannelModel::Where($channelWhere)->decrement('number');        //关注人数自减
        // }
        
        //如果是用户发送文本消息
        if($xmlObj->MsgType == 'text'){
            $content = trim($xmlObj->Content);
            if($content =='1'){
                //回复本班全部学生姓名
                $msg = implode(",",$student);
                //回复文本消息
                Wechat::reponseText($xmlObj,$msg);
            }elseif($content == '2'){
                //随机回复一个
                shuffle($student);
                $msg = $student[0];
                //回复文本消息
                Wechat::reponseText($xmlObj,$msg);
            }elseif($content == '最新新闻'){
                //查询数据库最后添加的一条数据
                $newText = Xinwen::orderBy('x_id','desc')->first();
                $msg = "新闻标题: ".$newText['x_bt']."\n新闻作者".$newText['x_zz']."\n新闻内容: ".$newText['x_nr'];
                //回复文本消息
                wechat::reponseText($xmlObj,$msg);
            
            }elseif(mb_strpos($content,"新闻+")!==false){
                $news = mb_substr($content,3);
                //dd($news);
                $sql = Xinwen::where('x_bt','like',"%$news%")->get()->toArray();
                if($sql){
                    $msg = "";
                    foreach($sql as $k=>$v){
                        Xinwen::where('x_id','=',$v['x_id'])->increment('x_fwl');
                        $msg = "新闻标题:" .$sql[0]['x_bt'] . "\n新闻内容:" .$sql[0]['x_nr'];
                    }
                    wechat::reponseText($xmlObj,$msg);
                }else{
                    $msg = "暂无相关新闻";
                    wechat::reponseText($xmlObj,$msg);
                }
            }elseif(mb_strpos($content,"天气") !== false){
                //回复天气
                $city = rtrim($content,"天气");
                if(empty($city)){
                    $city = "北京";
                }
                //调用天气接口  获取数据
                $url ="http://api.k780.com/?app=weather.future&weaid=".$city."&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json ";
                //参数传递好
                //调用接口(GET POST)
                //发送请求 打开文件 接受xml数据
                $data = file_get_contents($url);

                $data = json_decode($data,true);
                // var_dump($data);die;
                $msg = "";
                foreach($data['result'] as $key => $value){
                    $msg .= $value['days']." ".$value['week']." ".$value['citynm']." ".$value['temperature']."\n";
                }
                Wechat::reponseText($xmlObj,$msg);
            }
        }
    }
   





    protected $access_token;

    public function __construct()
    {
        //$this->access_token = WeiXinModel::getAccessToken();
    }

    public function check()
    {
////        $signature = $_GET["signature"];
////        $timestamp = $_GET["timestamp"];
////        $nonce = $_GET["nonce"];
//
//        $token = '2259b56f5898cd6192c50';
//        $tmpArr = array($token, $timestamp, $nonce);
//        sort($tmpArr, SORT_STRING);
//        $tmpStr = implode( $tmpArr );
//        $tmpStr = sha1( $tmpStr );
//
//        if( $tmpStr == $signature ){
//            //echo $_GET['echostr'];
//        }else{
//            return false;
//        }


        //接收 微信推送的数据
        //$data = json_encode($_POST);
        $data = file_get_contents("php://input");
        $log_str = date("Y-m-d H:i:s") . $data . "\n\n";
        file_put_contents('wx.log', $log_str, FILE_APPEND);

        $xml_obj = simplexml_load_string($data);


        $openid = $xml_obj->FromUserName;       // 取openid
        $msg_type = $xml_obj->MsgType;          // 消息类型
        $media_id = $xml_obj->MediaId;           // MediaId


        if ($msg_type == 'image')          //  图片
        {
            // 下载图片
            $this->downloadImg($media_id);

        } elseif ($msg_type == 'video')        // 视频
        {
            //下载视频
            $this->downloadVideo($media_id);
        }
    }


    /**
     * 下载图片素材
     */
    protected function downloadImg($media_id)
    {

        $access_token = WeiXinModel::getAccessToken();
        //var_dump($access_token);
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token=' . $access_token . '&media_id=' . $media_id;

        //请求获取素材接口
        $img = file_get_contents($url);
        //var_dump($img);

        //保存图片
        file_put_contents("bbb.jpg", $img);

    }

    protected function downloadVideo($media_id)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token=' . $this->access_token . '&media_id=' . $media_id;

        //请求获取素材接口
        $img = file_get_contents($url);

        //保存视频
        $file_name = date("YmdHis") . rand(1111, 9999) . '.mp4';
        $res = file_put_contents($file_name, $img);
        var_dump($res);

    }


    /**
     * 根据Openid群发
     */
    public function sendAllByOpenId()
    {
        $users = WeiXinModel::select('openid')->get()->toArray();
        //echo '<pre>';print_r($users);echo '</pre>';die;
        $openid_list = array_column($users,'openid');
        echo '<pre>';print_r($openid_list);echo '</pre>';
        // openid 列表  可以从数据库表获取


        $msg = date("Y-m-d H:i:s")  . " 再发两条 ： 马上放寒假了，不要忘记做作业!!";

        echo "消息： ".$msg;echo '</br>';
        $json_data = [
            "touser"    => $openid_list,
            "msgtype"   => "text",
            "text"      => [
                "content"   => $msg
            ]
        ];

        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$this->access_token;

        $response = WeiXinModel::curlPost($url,$json_data);
        // 检查错误
        if($response['errcode'] > 0){
            echo '错误信息： ' . $response['errmsg'];
        }else{
            echo "发送成功";
        }

    }

    public function test()
    {
        $redis_key = 'checkin:'.date('Y-m-d');
        echo $redis_key;die;
        $appid = env('WX_APPID');
        $redirect_uri = urlencode(env('WX_AUTH_REDIRECT_URI'));
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        echo $url;
    }

    /**
     * 接收网页授权code
     */
    public function auth()
    {
        // 接收 code
        $code = $_GET['code'];
        //换取access_token
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WX_APPID').'&secret='.env('WX_APPSEC').'&code='.$code.'&grant_type=authorization_code';
        $json_data = file_get_contents($url);
        $arr = json_decode($json_data,true);
        echo '<pre>';print_r($arr);echo '</pre>';


        // 获取用户信息
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$arr['access_token'].'&openid='.$arr['openid'].'&lang=zh_CN';
        $json_user_info = file_get_contents($url);
        $user_info_arr = json_decode($json_user_info,true);

        //将用户信息保存至 Redis HASH中
        $key = 'h:user_info:'.$user_info_arr['openid'];
        Redis::hMset($key,$user_info_arr);


        echo '<pre>';print_r($user_info_arr);echo '</pre>';


        //实现签到功能 记录用户签到
        $redis_key = 'checkin:'.date('Y-m-d');
        Redis::Zadd($redis_key,time(),$user_info_arr['openid']);  //将openid加入有序集合
        echo $user_info_arr['nickname'] . "签到成功" . "签到时间： ".date("Y-m-d H:i:s");
echo '<hr>';
        $user_list = Redis::zrange($redis_key,0,-1);
        //echo '<hr>';
        //echo '<pre>';print_r($user_list);echo '</pre>';

        foreach ($user_list as $k=>$v)
        {
            $key = 'h:user_info:'.$v;
            $u = Redis::hGetAll($key);
            if(empty($u)){
                continue;
            }
            //echo '<pre>';print_r($u);echo '</pre>';
            echo " <img src='".$u['headimgurl']."'> ";
        }


    }



}
