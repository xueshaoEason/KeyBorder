<?php
namespace admin\controller;
use admin\controller\BaseController;
use admin\model\User;
class IndexController extends BaseController
{
	public function _init()
	{

	}
	public function index()
	{
		$this->assign('title','终于看见你了');
		$this->display();
	}
	public function info()
	{
		$web = include 'config/zhandian.php';
		if (!empty($_POST)) {
			$web['WEB_URL'] = $_POST['webname'];
			$web['Owner'] = $_POST['Owner'];
			$web['Signature'] = $_POST['Signature'];
			$web['School'] = $_POST['School'];
			$web['Job'] = $_POST['Job'];
			$web['Hobby'] = $_POST['Hobby'];
			$web['Nickname'] = $_POST['Nickname'];
			$web['Tel'] = $_POST['Tel'];
			$web['Email'] = $_POST['Email'];
			$web['Postcode'] = $_POST['Postcode'];
			$web['Address'] = $_POST['Address'];
			$content = "<?php \n return " . var_export($web,true) . ";";
			$file = file_put_contents("config/zhandian.php", $content);
		}
		// $this->notice('修改成功', '');
		$this->assign('web',$web);
		$this->display();
	}
	public function login()
	{
		$this->display();
	}
	public function book()
	{
		$this->display();
	}
	public function out()
	{
		$_SESSION = [];
		session_destroy();
		$this->notice('退出成功！','index.php',2);
	}
}