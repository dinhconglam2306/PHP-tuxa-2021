<?php
class UserController extends Controller
{

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('login.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}

	public function loginAction()
	{
		$params = $this->_arrParam;
		$user  = $this->_model->checkLogin($params);
		$this->_view->setTitle('News | ZendVn');




		if ($_SESSION['flagPermission'] == true) {
			if ($_SESSION['timeout'] + 3600 > time()) {
				URL::redirect(URL::createLink('admin', 'rss', 'index'));
			} else {
				session_unset();
				URL::redirect(URL::createLink('default', 'index', 'index'));
			}
		} else {
			if (!empty($_POST)) {
				$mess = '';
				if (!empty($user)) {
					$_SESSION['flagPermission'] = true;
					$_SESSION['timeout']         = time();
					URL::redirect(URL::createLink('admin', 'rss', 'index'));
				} else {
					$this->_view->error = $mess = '<div class="alert alert-danger" role="alert">Tài khoản hoặc mật khẩu không đúng.</div>';
				}
			}
		}
		$this->_view->render('user/login');
	}
}
