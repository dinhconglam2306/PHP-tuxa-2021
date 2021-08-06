<?php
class UserModel extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->setTable('user');
	}

	public function checkLogin($arrParam, $option = null)
	{
		$username     = $arrParam['username'];
		$password     = md5($arrParam['password']);
		$query = "SELECT `id`, `username`, `password` FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
        $userInfo = $this->singleRecord($query);
		return $userInfo;
	}
}
