<?php
class RssModel extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->setTable('rss');
	}

	public function listItems($arrParam, $option = null)
	{
		$query 		= "SELECT * FROM `rss`";
		if (isset($arrParam['search']) && trim($arrParam['search']) != '') $query .= "WHERE `link` LIKE '%{$arrParam['search']}%'";
		$query.=" ORDER BY `ordering`";
		$result		= $this->listRecord($query);
		return $result;
	}
	public function getItem($id, $options = null)
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

	public function updateItem($params, $options = null)
	{
		$where = [['id', $params['id']]];
		unset($params['id']);
		$this->update($params, $where);
	}
	public function deleteItem($id, $option = null)
	{
		$this->delete([$id]);
	}
}
