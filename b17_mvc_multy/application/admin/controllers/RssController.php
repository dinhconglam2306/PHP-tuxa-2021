<?php
class RssController extends Controller
{
	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}

	public function indexAction()
	{
		$this->_view->items = $this->_model->listItems($this->_arrParam);
		$this->_view->setTitle('List | ZendVn');
		$this->_view->render('rss/index');
	}

	public function changestatusAction()
	{
		$this->_model->changeStatus($this->_arrParam);
		URL::redirect(URL::createLink('admin', 'rss', 'index'));
	}

	public function formAction()
	{
		//Lấy thông tin
		$this->_view->title = 'ADD RSS';
		$linkDirect = URL::createLink('admin', 'rss', 'form');
		$this->_view->setTitle('Add Rss | ZendVn');



		if (isset($this->_arrParam['id'])) {
			$this->_view->setTitle('Edit Rss | ZendVn');
			$this->_view->title = 'EDIT RSS';
			$linkDirect .= "&id={$this->_arrParam['id']}";
			$this->_view->item = $this->_model->getItem($this->_arrParam['id']);
		}



		if (!empty($_POST)) {
			if (Session::get('token') == $this->_arrParam['token']) {
				Session::del($this->_arrParam['token']);
				URL::redirect($linkDirect);
			} else {
				Session::set('token', $this->_arrParam['token']);
			}
			Session::del($this->_arrParam['token']);
			$validate = new Validate($_POST);
			$validate->addRule('link', 'url')
				->addRule('ordering', 'int', ["min" => 1, "max" => 10])
				->addRule('status', 'status');
			$validate->run();
			if (!$validate->isValid()) {
				$this->_view->error      = $validate->showErrors();
			} else {
				$params = $validate->getResult();
				Session::set('form', 'Thêm');
				if (isset($_GET['id'])) {
					Session::set('form', 'Sửa');
					$params['id'] = $this->_arrParam['id'];
					$this->_model->updateItem($params);
				} else {
					$this->_model->insertItem($params);
				}
				URL::redirect(URL::createLink('admin', 'rss', 'index'));
			}
		}

		$this->_view->render('rss/form');
	}
	public function deleteAction()
	{
		if (isset($this->_arrParam['id'])) $this->_model->deleteItem($this->_arrParam['id']);
		URL::redirect(URL::createLink('admin', 'rss', 'index'));
	}
	public function logoutAction()
	{
		session_unset();
		URL::redirect(URL::createLink('default', 'index', 'index'));
	}
}
