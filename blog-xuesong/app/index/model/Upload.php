<?php
namespace index\model;
use king\framework\Upload;
class Upload extends Upload
{
	public function uploadImg()
	{
		return $this->uploadFile('img');
	}
	public function getinfo()
	{
		return $this->pathName;
	}
}