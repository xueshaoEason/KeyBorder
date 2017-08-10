<?php
namespace index\controller;
use index\model\Posts;
use index\model\User;

class SingleController extends BaseController
{
	protected $user;
	protected $posts;
	public function _init()
	{
		$this->posts = new Posts();
		$this->user = new User();
	}
	public function single()
	{
		$web = include "config/zhandian.php";
		$pid = $_GET['pid'];
		$blog_post = $this->posts->getSInfo($pid);
		$comment = $this->posts->getReplyInfo($pid);
		$co = $this->posts->getRcountInfo($pid);
		$count = $co[0]['count'];
		$visit = $this->user->getVisitInfoNewest();
		$resu = $this->posts->getVisitInfo();
		$re = $this->posts->getTimeInfo();
		foreach ($blog_post as $key => $value) {
			$uid = $blog_post[$key]['zid'];
			$name = $this->user->field('username')->where("uid='$uid'")->select();
			foreach ($name as $keys => $values) {
				$username = $name[$keys]['username'];
				$blog_post[$key]['zid'] = $username;
				$this->assign('blog_post', $blog_post);
			}
		}
		if (!empty($comment)) {
			foreach ($comment as $key => $value) {
				$uid = $comment[$key]['zid'];
				$name = $this->user->field('username')->where("uid='$uid'")->select();
				foreach ($name as $keys => $values) {
					$username = $name[$keys]['username'];
					$comment[$key]['zid'] = $username;
					$this->assign('comment',$comment);
				}
			}
		}
		$this->assign('web',$web);
		$this->assign('pid',$pid);
		$this->assign('title','帖子');
		$this->assign('count',$count);
		$this->assign('resu',$resu);
		$this->assign('visit',$visit);
		$this->assign('re',$re);
		$this->display();
	}
	public function Addcomment()
	{
		$pid = $_REQUEST['pid'];
		if (empty($_SESSION['uid'])) {
			$this->notice('请先登录','index.php?m=index&c=user&a=login',2);
			exit;
		} else {
			$arr['zid'] = $_SESSION['uid'];
			if (empty($_POST['message'])) {
				$this->notice('输入信息不能为空','',2);
				exit;
			}
			$arr['tid'] = $pid;
			$arr['title'] = 0;
			$arr['photo'] = 0;
			$arr['content'] = $_POST['message'];
			$arr['createtime'] = time();
			$arr['replytotal'] = 0;
			$arr['visittotal'] = 0;
			$arr['istop'] = 0;
			$arr['iselite'] = 0;
			$arr['isdelete'] = 0;
		}
		$this->Wreply($arr);
	}
	public function Wreply($arr)
	{
		// var_dump($arr);die;
		$result = new Posts();
		$result->getPostsInfo($arr);
		// var_dump($result);die;
		if ($result) {
			$this->notice('发表成功','',2);
			$_SESSION['pid'] = $arr['pid'];
		} else {
			$this->notice('发表失败','',2);
		}
	}
}