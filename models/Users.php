<?php
class Users extends model
{

	private $userInfo;
	private $permissions;

	public function isLogged()
	{

		if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
			return true;
		} else {
			return false;
		}
	}

	public function doLogin($cpf, $birth_date)
	{

		$sql = $this->db->prepare("SELECT * FROM pilots WHERE cpf = :cpf AND birth_date = :birth_date");
		$sql->bindValue(':cpf', $cpf);
		$sql->bindValue(':birth_date', $birth_date);

		$sql->execute();


		if ($sql->rowCount() > 0) {
			$row = $sql->fetch();

			$_SESSION['ccUser'] = $row['id'];

			return true;
		} else {
			return false;
		}
	}

	public function setLoggedUser()
	{
		if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
			$id = $_SESSION['ccUser'];

			$sql = $this->db->prepare("SELECT * FROM pilots WHERE id = :id");
			$sql->bindValue(':id', $id);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$this->userInfo = $sql->fetch();
			}
		}
	}

	public function logout()
	{
		unset($_SESSION['ccUser']);
	}

	public function hasPermission($name)
	{
		return $this->permissions->hasPermission($name);
	}

	public function getCompany()
	{
		if (isset($this->userInfo['id_company'])) {
			return $this->userInfo['id_company'];
		} else {
			return 0;
		}
	}
	public function getName()
	{
		if (isset($this->userInfo['fullname_pilot'])) {
			return $this->userInfo['fullname_pilot'];
		} else {
			return '';
		}
	}

	public function getId()
	{
		if (isset($this->userInfo['id'])) {
			return $this->userInfo['id'];
		} else {
			return '';
		}
	}

	public function getInfo($id, $id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}


	public function findUsersInGroup($id)
	{

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE id_group = :group");
		$sql->bindValue(":group", $id);
		$sql->execute();
		$row = $sql->fetch();
		if ($row['c'] == '0') {
			return false;
		} else {
			return true;
		}
	}

	public function getList($id_company)
	{
		$array = array();

		$sql = $this->db->prepare("
			SELECT
				users.id,
				users.email,
				users.name_user,
				permission_groups.name
			FROM 
				users
			LEFT JOIN 
				permission_groups ON permission_groups.id = users.id_group
			WHERE 
				users.id_company = :id_company");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
	public function getListAll($id_company)
	{
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM users WHERE id_company = :id_company");
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function add($name_user, $email, $pass, $group, $id_company)
	{
		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE email = :email");
		$sql->bindValue(":email", $email);
		$sql->execute();
		$row = $sql->fetch();

		if ($row['c'] == '0') {
			$sql = $this->db->prepare("INSERT INTO users SET name_user = :name_user,  email = :email, password = :password, id_group = :id_group, id_company = :id_company");
			$sql->bindValue(":name_user", $name_user);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":password", md5($pass));
			$sql->bindValue(":id_group", $group);
			$sql->bindValue(":id_company", $id_company);
			$sql->execute();

			return '1';
		} else {
			return '0';
		}
	}

	public function edit($name_user, $pass, $group, $id, $id_company)
	{
		$sql = $this->db->prepare("UPDATE users SET name_user = :name_user, id_group = :id_group WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":name_user", $name_user);
		$sql->bindValue(":id_group", $group);
		$sql->bindValue("id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if (!empty($pass)) {
			$sql = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id AND id_company = :id_company");
			$sql->bindValue(":password", md5($pass));
			$sql->bindValue(":id", $id);
			$sql->bindValue("id_company", $id_company);
			$sql->execute();
		}
	}

	public function delete($id, $id_company)
	{
		$sql = $this->db->prepare("DELETE FROM users WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();
	}
}
