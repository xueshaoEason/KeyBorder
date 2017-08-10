<?php
namespace index\controller;
use index\model\User as UserModel;
use index\model\Posts as PostsModel;
use king\framework\Upload;
class PostsController extends BaseController
{
	protected $user;
	protected $Posts;
	protected $photo;
	protected $img;
	public function _init()
	{
		$this->posts = new PostsModel();
		$this->user = new UserModel();
	}
	public function Posts()
	{
		$web = include "config/zhandian.php";
		$this->assign('web',$web);
		$re = $this->posts->getTimeInfo();
		$this->assign('title','发帖');
		$this->assign('re',$re);
		$this->display();
	}
	// public function Upload()
	// {
	// 	$re = $this->upload->uploadImg();
	// 	$this->assign('re',$re);
	// 	$this->display();
	// }
	public function WritePosts()
	{
		if (empty($_SESSION['username']) {
			$this->notice('请先登录，谢谢合作','index.php?m=index&c=user&a=login',2);
			exit;
		}
		$arr['zid'] = $_SESSION['uid']; //博文作者
		$array = $_POST;
			// var_dump($array);die;
		if (!empty($array)) {
			foreach ($array as $key => $value) {
				if (empty($value)) {
					$this->notice('输入内容不能为空','',2);
					exit;
				}
			}
			$this->img = new Upload(['uploadDir' => 'public/upload']);
			$path = $this->img->upload('img');
			if (empty($path)) {
				$this->notice('为了用户体验请在发表博文时上传图片','',2);
				exit;
			} else {
				//博文类型
				$arr['tid'] = 0;
				$arr['title'] = $array['title'];
				$arr['photo'] = $path;
				$arr['content'] = $array['message'];
				$arr['createtime'] = time();
				$arr['replytotal'] = 0;
				$arr['visittotal'] = 0;
				$arr['istop'] = 0;
				$arr['iselite'] = 0;
				$arr['isdelete'] = 0;
				$this->WPosts($arr);
			}
		}
	}
	public function WPosts($arr)
	{
		$result = new PostsModel();
		$result->getPostsInfo($arr);
		// var_dump($result);die;
		if ($result) {
			$this->notice('发表成功','index.php',2);
			$_SESSION['pid'] = $arr['pid'];
		} else {
			$this->notice('发表失败，为了用户体验请在发表博文时上传图片','',2);
		}
	}
}