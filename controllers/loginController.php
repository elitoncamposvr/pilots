<?php
class loginController extends controller
{

	public function index()
	{
		$data = array();
		$u = new Users();

		if (isset($_POST['cpf']) && !empty($_POST['cpf'])) {
			$cpf = addslashes($_POST['cpf']);
			$birth_date = addslashes($_POST['birth_date']);

			$clear_cpf = array(".", "-");
			$cpf = str_replace($clear_cpf, "", $cpf);

			$birth_date = implode("-", array_reverse(explode("/", $birth_date)));

			if ($u->doLogin($cpf, $birth_date)) {
				header("Location: " . BASE_URL);
				exit;
			} else {
				$data['error'] = "CPF e/ou data de nascimento estão incorreto(s).";
			}
		}

		$this->loadView('login', $data);
	}


	public function register()
	{
		$data = array();
		$u = new Users();
		$pilots = new Pilots();

		if (
			isset($_POST['cpf']) && !empty($_POST['cpf']) &&
			isset($_POST['birth_date']) && !empty($_POST['birth_date']) &&
			isset($_POST['fullname_pilot']) && !empty($_POST['fullname_pilot']) &&
			isset($_POST['nickname_pilot']) && !empty($_POST['nickname_pilot']) &&
			isset($_POST['cellphone']) && !empty($_POST['cellphone'])
		) {
			$cpf = addslashes($_POST['cpf']);
			$birth_date = addslashes($_POST['birth_date']);
			$fullname_pilot = addslashes($_POST['fullname_pilot']);
			$nickname_pilot = addslashes($_POST['nickname_pilot']);
			$cellphone = addslashes($_POST['cellphone']);

			$clear_cpf = array(".", "-");
			$cpf = str_replace($clear_cpf, "", $cpf);

			$clear_cellphone = array("(", ")", "-");
			$cellphone = str_replace($clear_cellphone, "", $cellphone);

			$birth_date = implode("-", array_reverse(explode("/", $birth_date)));

			if ($pilots->isRegistered($fullname_pilot, $cellphone, $nickname_pilot, $cpf, $birth_date)) {
				$data['error'] = "CPF já está cadastrado no sistema.";
			} else {
				$data['success'] = "Dados cadastrados com sucesso!";
			}
		}

		$this->loadView('register', $data);
	}

	public function logout()
	{
		$u = new Users();
		$u->logout();
		header("Location: " . BASE_URL);
	}
}
