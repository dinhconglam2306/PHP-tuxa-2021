<?php
class Rss extends Controller
{

	public function __construct()
	{
		parent::__construct();
		// Auth::checkLogin();
		$this->view->title = 'ADD RSS';
	}

	public function index()
	{

		$params = $_GET;
		$this->view->items = $this->db->listItems($params);
		$this->view->render('rss/index');
	}

	public function changeStatus()
	{
		$params = $_GET;
		$this->db->changeStatus($params);
		URL::redirect(URL::createLink('rss', 'index'));
	}

	public function form()
	{
		//Lấy thông tin
		$linkDirect = URL::createLink('rss', 'form');
		if (isset($_GET['id'])) {
			$this->view->html = 'oke';
			$this->view->title = 'EDIT RSS';
			$linkDirect .= "&id={$_GET['id']}";
			$this->view->item = $this->db->listItem($_GET['id']);
		}
		if (!empty($_POST)) {
			if ($_SESSION['token'] == $_POST['token']) {
				unset($_SESSION['token']);
				URL::redirect($linkDirect);
			} else {
				$_SESSION['token'] = $_POST['token'];
			}
			unset($_POST['token']);
			$validate = new Validate($_POST);
			$validate->addRule('link', 'url')
				->addRule('ordering', 'int', ["min" => 1, "max" => 10])
				->addRule('status', 'status');
			$validate->run();
			if (!$validate->isValid()) {
				$this->view->error      = $validate->showErrors();
			} else {
				$params= $validate->getResult();
				Session::set('form','Thêm');
				if (isset($_GET['id'])) {
					Session::set('form','Sửa');
					$params['id'] = $_GET['id'];
					$this->db->updateItem($params);
				} else {
					$this->db->insertItem($params);
				}
				URL::redirect(URL::createLink('rss', 'index'));
			}
		}
		$this->view->render('rss/form');
	}

	public function delete()
	{
		if (isset($_GET['id'])) $this->db->deleteItem($_GET['id']);
		URL::redirect(URL::createLink('rss', 'index'));
	}
}
