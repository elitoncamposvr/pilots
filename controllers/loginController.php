<?php
class loginController extends controller
{

	public function index()
	{
		$data = array();

		if (isset($_POST['cpf']) && !empty($_POST['cpf'])) {
			$cpf = addslashes($_POST['cpf']);
			$birth_date = addslashes($_POST['birth_date']);

			$clear_cpf = array(".", "-");
			$cpf = str_replace($clear_cpf, "", $cpf);

			$u = new Users();

			if ($u->doLogin($cpf, $birth_date)) {
				header("Location: " . BASE_URL);
				exit;
			} else {
				$data['error'] = "CPF e/ou data de nascimento estão incorreto(s).";
			}
		}

		$this->loadView('login', $data);
	}

	public function logout()
	{
		$u = new Users();
		$u->logout();
		header("Location: " . BASE_URL);
	}
}
