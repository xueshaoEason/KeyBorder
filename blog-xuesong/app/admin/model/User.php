<?php
namespace admin\model;
use king\framework\Model;
class User extends Model
{
	public function checkLogin($username)
	{
		// $password = md5($password);
		return $this->where("username='$username'")
					 ->limit('1')
					 ->field('uid,username,usertype,password')
					 ->select();
	}
	public function getUinfo()
	{
		return $this->where()->select(MYSQL_ASSOC);
	}
	public function getUpinfo($id)
	{
		return $this->where("uid='$id'")->select();
	}
	public function getUpdinfo($id,$aaa)
	{
		return $this->where("uid='$id'")->Update($aaa);
	}
	public function getUpass()
	{
		return $this->where(['usertype=1'])->select();
	}
	public function getAdminfo($aaa)
	{
		return $this->where('usertype=1')->Update($aaa);
	}
	public function getUserDel($where)
	{
		return $this->where($where)->delete();
	}
}