<?php
namespace index\model;
use king\framework\Model;
use king\framework\Page;
class Posts extends Model
{
	public function article()
	{
		$page = new Page($this->articlecount(),4);
		$limit = $page->limit();
		return $this->limit("$limit")->where("tid=0")->order('createtime desc')->select();
	}
	public function articlecount()
	{
		//var_dump(count($this->field('pid,title,content,createtime')->where("tid = 0")->select()));
		// die;
		return count($this->field('pid')->where("tid = 0")->select());
	}
	public function postsList()
	{
		// return $this->field('pid,title,createtime,photo,zid')->select();
		return $this->where('tid=0')->order('createtime desc')->select(MYSQLI_ASSOC);
	}
	public function getShowInfo($page)//按评论数目把博文展示在首页
	{
		return $this->where('tid=0')->order('createtime desc')->limit($page)->select(MYSQLI_ASSOC);
	}
	public function getSInfo($id)//博文展示
	{
		return $this->where("pid='$id'")->select(MYSQLI_ASSOC);
	}
	public function getVisitInfo()//得到查看数目最多的5条博文作为精选
	{
		return $this->where('tid=0')->limit('5')->order('visittotal desc')->select(MYSQLI_ASSOC);
	}
	public function getTimeInfo()//最近博文
	{
		return $this->where(['tid=0'])->limit('3')->order('createtime desc')->select(MYSQLI_ASSOC);
	}
	public function getPcountInfo()//通过tid=1查询博文数量
	{
		return $this->where('tid=0')->count();
	}
	public function getReplyInfo($asd)//tid=0查询博文回复
	{
		return $this->where("tid='$asd'")->select(MYSQLI_ASSOC);
	}
	public function getRcountInfo($www)//通过tid=0查询博文回复数量
	{
		return $this->field('count(*) as count')->where("tid='$www'")->select(MYSQLI_ASSOC);
	}
	public function getPostsInfo($arr)//发博文
	{
		return $this->insert($arr);
	}
}