<?php
namespace admin\controller;
use admin\model\User as UserModel;
use admin\model\Posts as PostModel;
class BookController extends BaseController
{
	public $user;
	public function _init()
	{
		$this->user = new UserModel();
		$this->posts = new PostModel();
	}
	public function book()
	{
		$result = $this->user->select(MYSQLI_ASSOC);
		$this->assign('result',$result);
		$this->display();
	}
	public function member()
	{
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
			$result = $this->user->getUserDel("uid='$id'");
			$this->notice('删除成功','',2);
		}
		if (empty($_POST['id'])) {
			$this->notice('请先选择用户再删除','',2);
		}
		foreach ($_POST['id'] as $key => $uid) {
			$result = $this->user->getUserDel("uid='$uid'");
		}
		if ($result) {
			$this->notice('删除成功','',2);
		} else {
			$this->notice('删除失败','',2);
		}
	}
	public function mimachange()
	{
		if (!empty($_POST)) {
			$pwd = $_POST['newpass'];
			$data = [
						'password'  => $pwd
					];
			$result1 = $this->user->getAdminfo($data);
		}

		$result = $this->user->getUpass();
		$this->assign('result',$result);
		$this->display();
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
					$this->notice('登陆成功！','index.php?m=admin&c=index&a=index',3);
				} else {
					$this->notice('账号密码不匹配','index.php?m=admin&c=book&a=login',2);
				}
			} else {
				$this->notice('sorry,用户名不存在','index.php?m=admin&c=book&a=login',2);
			}
		} else {
			$this->notice('账号密码不能为空','index.php?m=admin&c=book&a=login',2);
		}
	}
	//退出登陆
	public function out()
	{
		$_SESSION = [];
		session_destroy();
		$this->notice('退出成功！','index.php',2);
	}
}