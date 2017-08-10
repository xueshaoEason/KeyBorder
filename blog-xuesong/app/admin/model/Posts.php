<?php
namespace admin\model;
use king\framework\Model;
class Posts extends Model
{
	public function getBInfo()
	{
		return $this->where('tid=0')->select();
	}
	public function getCInfo()
	{
		return $this->where('tid!=0')->select();
	}
	public function getPinfo($id,$arr)
	{
		return $this->where("pid='$id'")->Update($arr);
	}
	public function getPostsDel($where)
	{
		return $this->where($where)->delete();
	}
	public function getRcountInfo($www)//通过tid=0查询博文回复数量
	{
		return $this->field('count(*) as count')->where("tid='$www'")->select(MYSQLI_ASSOC);
	}
	public function getTimeInfo()//最近博文
	{
		return $this->where(['tid=0'])->limit('3')->order('createtime desc')->select(MYSQLI_ASSOC);
	}
}