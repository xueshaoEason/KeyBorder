<?php
namespace index\controller;
use index\controller\BaseController;
use index\model\User as UserModel;
use index\model\Posts as PostModel;
use king\framework\Page;


class IndexController extends BaseController
{
	protected $user;
	protected $posts;
	protected $page;
	public function _init()
	{
		$this->posts = new PostModel();
		$this->user = new UserModel();
	}
	public function index()
	{
		$web = include "config/zhandian.php";
		$result = $this->posts->article();
		$result1 = $this->posts->articlecount();
		$setpage = new Page($result1,4);
		$result2 = $setpage->allPage();
		// var_dump($setpage->allPage());
		// var_dump($result2);
		$resu = $this->posts->getVisitInfo();
		$re = $this->posts->getTimeInfo();
		$visit = $this->user->getVisitInfoNewest();
		foreach ($result as $key => $value) {
			$uid = $result[$key]['zid'];
			$name = $this->user->field('username')->where("uid='$uid'")->select();
			foreach ($name as $keys => $values) {
				$username = $name[$keys]['username'];
				$this->assign('result',$result);
			}
		}

		$this->assign('web',$web);
		$this->assign('title', '首页');
		$this->assign('visit',$visit);
		$this->assign('re',$re);
		$this->assign('resu',$resu);
		$this->assign('result',$result);
		$this->assign('result1',$result1);
		$this->assign('result2',$result2);
		$this->display();
	}
}