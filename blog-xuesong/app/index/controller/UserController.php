<?php
namespace index\controller;
use index\model\User as UserModel;
use index\model\Posts as PostModel;
use king\framework\VerifyCode;
use vendor\alidayu\TopClient;
use vendor\alidayu\AlibabaAliqinFcSmsNumSendRequest;
class UserController extends BaseController
{
	protected $user;
	protected $posts;
	public function _init()
	{
		$this->posts = new PostModel();
		$this->user = new UserModel();
	}
	public function login()
	{
		$web = include "config/zhandian.php";
		$this->assign('web',$web);
		$re = $this->posts->getTimeInfo();
		$this->assign('title','首页');
		$this->assign('re',$re);
		$this->display();
	}
	public function yzm()
	{
		$vc = new VerifyCode();
		$aa=$vc->outputImage();
		$_SESSION['code'] = $vc->getCode();
	}
	//登陆验证信息
	public function checkLogin()
	{
		if (!empty(trim($_POST['name'])) || !empty(trim($_POST['pwd']))) {
			$username = $_POST['name'];
			$password = $_POST['pwd'];
			// $result = $this->user->field('uid,username,password,usertype')->where("username='$user'")->select();
			$result = $this->user->checkLogin($username);
			// var_dump($result);die;
			// var_dump($result[0]['username']);die;
			if ($result) {
				if ($username == $result[0]['username'] && $password == $result[0]['password']) {
					$_SESSION['uid'] = $result[0]['uid'];
					$_SESSION['username'] = $result[0]['username'];
					$_SESSION['password'] = $result[0]['password'];
					// var_dump($_SESSION['password']);die;
					$_SESSION['usertype'] = $result[0]['usertype'];
					$this->notice('登陆成功！','index.php',3);
				} else {
					$this->notice('账号密码不匹配','index.php?m=index&c=user&a=login',2);
				}
			} else {
				$this->notice('sorry,用户名不存在','index.php?m=index&c=user&a=login',2);
			}
		} else {
			$this->notice('账号密码不能为空','index.php?m=index&c=user&a=login',2);
		}
	}
	//退出登陆
	public function out()
	{
		$_SESSION = [];
		session_destroy();
		$this->notice('退出成功！','index.php',2);
	}
	public function register()
	{
		$web = include "config/zhandian.php";
		$re = $this->posts->getTimeInfo();
		// var_dump($re);die;
		$this->assign('web',$web);
		$this->assign('title','注册');
		$this->assign('re',$re);
		$this->display();
	}
	//处理注册
	public function checkRegister()
	{
		$array = $_POST;
		// var_dump($array);die;
		// var_dump($_SESSION['code']);die;
		foreach ($array as $key => $value) {
			if (empty(trim($value))) {
				$this->notice('输入不能为空','index.php?m=index&c=user&a=register');
				exit;
			} else {
				//查询输入的用户名库中是否已存在
				$username = $array['name'];
				// var_dump($username);die;
				$arr['username'] = $array['name'];
				// $result = $this->user->where("username='$user'")->select();
				$result = $this->user->checkLogin($username);
				if ($result) {
					$this->notice('用户名已经存在，请重新输入','index.php?m=index&c=user&a=register');
					exit;
				} else {
					//限制用户名长度
					if (strlen($array['name']) < 3 || strlen($array['name']) > 10) {
						$this->notice('用户名长度为4到9个字符，请重新输入','index.php?m=index&c=user&a=register');
						exit;
					}
					//正则匹配用户名
					$zzuser = '/^\w+$/i';
					if (!preg_match($zzuser,$username)) {
						$this->notice('用户名不能包含除数字字母下划线以外的字符','index.php?m=index&c=user&a=register');
						exit;
					}
					//限制密码长度
					if (strlen($array['pwd']) < 3 || strlen($array['pwd']) > 12) {
						$this->notice('密码长度为4-11个字符','index.php?m=index&c=user&a=register');
						exit;
					}
					//正则匹配密码
					$zzpwd = '/^\w+$/i';
					if (!preg_match($zzpwd,$array['pwd'])) {
						$this->notice('密码中不能包含除数字、字母、_以外的字符','index.php?m=index&c=user&a=register');
						exit;
					}
					//密码加密
					$arr['password'] = $array['pwd'];
					//判断邮箱格式
					$zzemail = '/\w+@\w+\.(com|cn|net)$/';
					if (!preg_match($zzemail,$array['email'])) {
						$this->notice('请输入正确的邮箱','index.php?m=index&c=user&a=register');
						exit;
					}
					$arr['email'] = $array['email'];
					//检测验证码是否输入正确
					if ($array['ver'] != $_SESSION['code']) {
						$this->notice('验证码输入错误','index.php?m=index&c=user&a=register');
						exit;
					}


					//检测SMS验证码是否输入正确
					$code = $_POST['code'];
					$yzm = $_SESSION['smscode'];
					if (empty($yzm)) {
						$this->notice('SMS验证码 cannot be empty','index.php?m=index&c=user&a=register',300);
					}
					if ($code != $yzm) {
						$this->notice('SMS验证码输入错误','index.php?m=index&c=user&a=register');
						exit;
					}


					//注册时间
					$arr['regtime'] = time();
					//注册ip
					if ($_SERVER['REMOTE_ADDR'] == '::1') {
						$arr['regip'] = ip2long('127.0.0.1');
					} else {
						$arr['regip'] = ip2long($_SERVER['REMOTE_ADDR']);
					}
					//用户类型
					$arr['usertype'] = 0;
					$arr['phone'] = $array['phone'];
				}
			}
		}
		//写入数据库
		$result = $this->user->insert($arr);
		// var_dump($result);die;
		echo $this->user->getLastSql();
		if ($result) {
			$_SESSION['uid'] = $result;
			$_SESSION['username'] = $arr['username'];
			$this->notice('注册成功，即将跳转到首页...','index.php',2);
		} else {
			$this->notice('注册失败，请重新注册...','index.php?m=index&c=user&a=register',3);
		}
	}

	//短信验证
	public function sendSMS()
	{
		$tel = $_POST['mobile'];//手机号

		$c = new TopClient;//大于客户端
		$c->format = 'json';//设置返回值得类型

		$c->appkey = "24480167";//阿里大于注册应用的key

	    $c->secretKey = "0f45e370c86dab12e475fb6e92cb280f";//注册的secretkey

	    //请求对象，需要配置请求的参数
		$req = new AlibabaAliqinFcSmsNumSendRequest;
		$req->setExtend("123456");//公共回传参数，可以不传
		$req->setSmsType("normal");//短信类型，传入值请填写normal

		//签名，阿里大于-控制中心-验证码--配置签名 中配置的签名，必须填
		$req->setSmsFreeSignName("薛少");

		//你在短信中显示的验证码，这个要保存下来用于验证
		$num = rand(100000,999999);
		$_SESSION['smscode'] = $num;

		//短信模板变量，传参规则{"key":"value"}，key的名字须和申请模板中的变量名一致，传参时需传入{"code":"1234","product":"alidayu"}
		$req->setSmsParam("{\"number\":\"$num\"}");//模板参数

		//短信接收号码。
	     $req->setRecNum($tel);

		//短信模板。阿里大于-控制中心-验证码--配置短信模板 必须填
		$req->setSmsTemplateCode("SMS_71535107");
		$resp = $c->execute($req);//发送请求
		return $resp;

	}

}