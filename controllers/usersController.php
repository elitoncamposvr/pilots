<?php
class usersController extends controller
{
	public function __construct()
	{
		$u = new Users();
		if ($u->isLogged() == false) {
			header("Location: " . BASE_URL . "login");
			exit;
		}
	}

	public function index()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('users_view')) {
			$data['users_list'] = $u->getList($u->getCompany());

			$this->loadTemplate('users', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function add()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('users_view')) {

			$p = new Permissions();

			if (isset($_POST['email']) && !empty($_POST['email'])) {
				$name_user = addslashes($_POST['name_user']);
				$email = addslashes($_POST['email']);
				$pass = addslashes($_POST['password']);
				$group = addslashes($_POST['group']);

				$a = $u->add($name_user, $email, $pass, $group, $u->getCompany());

				if ($a == '1') {
					header("Location: " . BASE_URL . "users");
				} else {
					$data['error_msg'] = "Usuário já existe!";
				}
			}
			$data['group_list'] = $p->getGroupList($u->getCompany());

			$this->loadTemplate('users_add', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function edit($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('users_view')) {

			$p = new Permissions();

			if (isset($_POST['group']) && !empty($_POST['group'])) {
				$name_user = addslashes($_POST['name_user']);
				$pass = addslashes($_POST['password']);
				$group = addslashes($_POST['group']);

				$u->edit($name_user, $pass, $group, $id, $u->getCompany());
				header("Location: " . BASE_URL . "users");
			}
			$data['user_info'] = $u->getInfo($id, $u->getCompany());
			$data['group_list'] = $p->getGroupList($u->getCompany());


			$this->loadTemplate('users_edit', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function delete($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('users_view')) {
			$p = new Permissions();

			$u->delete($id, $u->getCompany());
			header("Location: " . BASE_URL . "users");

			$this->loadTemplate('users_edit', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}
	
	public function permissions()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('permissions_view')) {

			$permissions = new Permissions();
			$data['permissions_list'] = $permissions->getList($u->getCompany());

			$this->loadTemplate('permissions', $data);
		} else {

			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function permissions_group()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('permissions_view')) {

			$permissions = new Permissions();
			$data['permissions_groups_list'] = $permissions->getGroupList($u->getCompany());

			$this->loadTemplate('permissions_group', $data);
		} else {

			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}


	public function permissions_add()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('permissions_view')) {
			$permissions = new Permissions();

			if (isset($_POST['name']) && !empty($_POST['name'])) {
				$pname = addslashes($_POST['name']);
				$permission_title = addslashes($_POST['permission_title']);
				$permissions->add($pname, $permission_title, $u->getCompany());
				header("Location: " . BASE_URL . "users/permissions");
			}

			$this->loadTemplate('permissions_add', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function permissions_add_group()
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('permissions_view')) {
			$permissions = new Permissions();

			if (isset($_POST['name']) && !empty($_POST['name'])) {
				$pname = addslashes($_POST['name']);
				$plist = $_POST['permissions'];

				$permissions->addGroup($pname, $plist, $u->getCompany());
				header("Location: " . BASE_URL . "users/permissions_group");
			}

			$data['permissions_list'] = $permissions->getList($u->getCompany());

			$this->loadTemplate('permissions_addgroup', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function permissions_delete($id)
	{

		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('permissions_view')) {
			$permissions = new Permissions();
			$permissions->delete($id);
			header("Location: " . BASE_URL . "users/permissions");
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function permissions_delete_group($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('permissions_view')) {
			$permissions = new Permissions();
			$permissions->deleteGroup($id);
			header("Location: " . BASE_URL . "users/permissions_group");
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function permissions_edit_group($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if ($u->hasPermission('permissions_view')) {
			$permissions = new Permissions();

			if (isset($_POST['name']) && !empty($_POST['name'])) {
				$pname = addslashes($_POST['name']);
				$plist = $_POST['permissions'];

				$permissions->editGroup($pname, $plist, $id, $u->getCompany());
				header("Location: " . BASE_URL . "users/permissions_group");
			}

			$data['permissions_list'] = $permissions->getList($u->getCompany());
			$data['group_info'] = $permissions->getGroup($id, $u->getCompany());

			$this->loadTemplate('permissions_editgroup', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}
}
