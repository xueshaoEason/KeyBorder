<?php
namespace admin\controller;
use admin\controller\BaseController;
use admin\model\User;
use admin\model\Posts;

class ListsController extends BaseController
{
	protected $user;
    protected $posts;
    public function _init()
	{
		$this->user = new User();
		$this->posts = new Posts();
	}
	public function Addcomment()
	{
		if (!empty($_POST['del'])) {
			if (!empty($_POST['id'])) {
				$id = $_POST['id'];
				$id = join(',', $id);
				$this->posts->getPostsDel("pid in ($id)");
				$this->notice('删除博文成功','',2);
			}
		}
		$this->notice('请先选择博文再删除','',2);
	}
	public function lists()
	{
   		$result = $this->posts->getBInfo();
	    foreach ($result as $key => $value){
	        $uid = $result[$key]['zid'];
	        $re = $this->user->field('username')->getUpinfo($uid);
	        // var_dump($re);
	        // zid:博文作者
	        foreach($re as $keys => $values){
		        $username = $re[$keys]['username'];
		        $result[$key]['zid'] = $username;
	        }
	    }
	    $co = $this->posts->getRcountInfo("pid=1");
		$count = $co[0]['count'];
		$this->assign('count',$count);
	    $this->assign('result',$result);
	    $this->display();
	}
	public function listhui()
	{
   		$result = $this->posts->getCInfo();
	    foreach ($result as $key => $value){
	        $uid = $result[$key]['zid'];
	        $re = $this->user->field('username')->getUpinfo($uid);
	        // var_dump($re);
	        // zid:博文作者
	        foreach($re as $keys => $values){
		        $username = $re[$keys]['username'];
		        $result[$key]['zid'] = $username;
	        }
	    }
	    $co = $this->posts->getRcountInfo("pid=1");
		$count = $co[0]['count'];
		$this->assign('count',$count);
	    $this->assign('result',$result);
	    $this->display();
	}
}