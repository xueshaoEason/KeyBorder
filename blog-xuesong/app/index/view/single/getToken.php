<?php
include "4_curl.php";
define("APPID",'wx6c96f7a4909964e9');
define('APPSECRET','126e2ad3288bbc15f8250949a7b6edbc');
define("TOKENFILE","token.txt");
function getToken()
{
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
	//1 检测是否有本地缓存文件
	if (file_exists(TOKENFILE)) {
		// 判断是否过期
		if (filemtime(TOKENFILE)+7200>time()) {
			$content = file_get_contents(TOKENFILE);
			$obj = json_decode($content);
			return $obj->access_token;
		} else {
			//重新发起请求
			return requireToken($url);
		}
	} else {
		//2 如果没有，直接发起请求，获取access_token，写缓存文件
		return requireToken($url);
	}
}

function requireToken($url)
{
	$content = MyCurl::get($url);
	file_put_contents(TOKENFILE, $content);
	$obj = json_decode($content);
	return $obj->access_token;
}