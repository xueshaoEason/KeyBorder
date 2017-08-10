<?php
namespace index\model;
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

	public function usernameRepeat($username)
	{
		$data =  $this->where("name='$username'")->select();
		//1如果用户存在返回true，否则返回fale
		return !empty($data[0]);
	}
	public function getVisitInfo()
	{
		return $this->limit('7')->order('regtime desc')->select();
	}
	public function getVisitInfoNewest()
	{
		return $this->limit('1')->order('regtime desc')->select();
	}
	public function grtUserInfo($username)
	{
		return $this->field('uid,username,password,usertype')->where("username='$username'")->select();
	}
}