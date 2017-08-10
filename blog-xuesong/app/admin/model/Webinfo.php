<?php
namespace admin\model;
use king\framework\Model;
class Webinfo extends Model
{
	public function getWebInfo()
	{
		return $this->where('id=1')->select(MYSQL_ASSOC);
	}
	public function getUpInfo($aaa)
	{
		return $this->where('id=1')->Update($aaa);
	}
}