<?php
class Rss_Model extends Model
{

	public function __construct()
	{
		parent::__construct();
		$this->setTable('rss');
	}

	public function listItems($params,$options = null)
	{
		$query 		= "SELECT * FROM `rss`";
		if(isset($params['search']) && trim($params['search']) != '') $query.= "WHERE `link` LIKE '%{$params['search']}%'";
		$result		= $this->listRecord($query);
		return $result;
	}
	public function listItem($id,$options = null)
	{
		$query[] 	= "SELECT `link`, `status`,`ordering`";
		$query[] 	= "FROM `rss`";
		$query[] 	= "WHERE `id`='" . $id . "'";
		$query		= implode(" ", $query);
		$result		= $this->singleRecord($query);
		return $result;
	}

	public function changeStatus($params)
	{
		$id = $params['id'];
		$status = $params['status'] == 'active' ? 'inactive' : 'active';
		$query = "UPDATE `rss` SET `status` = '$status' WHERE `id` = $id";
		$this->query($query);
	}

	public function insertItem($params)
	{
		$this->insert($params);
	}

	public function updateItem($params,$options=null)
	{
		$where = [['id',$params['id']]];
		unset($params['id']);
		$this->update($params,$where);
	}

	public function deleteItem($id, $options = null)
	{
		$this->delete([$id]);
	}
}
