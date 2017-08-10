<?php
define('TOKEN','xueshao');
$wx = new WeiChat();
// $wx->valid();//第一次握手,执行一次
$wx->reponseMsg();
class WeiChat
{

    //消息自动回复
    public function reponseMsg()
    {
        if (phpversion()<7) {
            //获取来自微信服务器的消息
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        } else {//>=7.0
            $postStr = file_get_contents('php://input');
        }

        $obj = simplexml_load_string($postStr);
        $to = (string)$obj->FromUserName;//发给
        $from =(string) $obj->ToUserName;
        $time = time().'';
        $content = (string)$obj->Content;
        if (mb_stristr($content, '我爱你') !== false) {
            $reply = "你是这世界 写给我的情书❤";
        } else if(mb_stristr($content, '电影') !== false) {
            $reply = "大话西游，永远的经典";
        }
        $msg = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <MsgId>6442143111226037724</MsgId>
            </xml>";

        $msg = sprintf($msg,$to,$from,$time,$reply);
        echo $msg;
        
    }

    public function valid()
    {
        $echoStr = $_GET['echostr'];

        if ($this->checkSignature()) {
            echo $echoStr;
        }
    }

    protected  function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];//签名串
        $timestamp = $_GET["timestamp"];//时间戳
        $nonce = $_GET["nonce"];//随机数
                
        $token = TOKEN;//微信公众号中定义的
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);//排序
        $tmpStr = implode( $tmpArr );//生成字符串
        $tmpStr = sha1( $tmpStr );//从新生成签名串
        
        //两次签名比较
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}