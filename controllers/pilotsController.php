<?php
class pilotsController extends controller
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
	}

	public function edit($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();

		$pilots = new Pilots();

		if (isset($_POST['fullname_pilot']) && !empty($_POST['fullname_pilot'])) {
			$fullname_pilot = addslashes($_POST['fullname_pilot']);
			$cellphone = addslashes($_POST['cellphone']);
			$nickname_pilot = addslashes($_POST['nickname_pilot']);
			$cpf = addslashes($_POST['cpf']);
			$birth_date = addslashes($_POST['birth_date']);

			$clear_cellphone = array("(", ")", "-");
			$cellphone = str_replace($clear_cellphone, "", $cellphone);

			$clear_cpf = array(".", "-");
			$cpf = str_replace($clear_cpf, "", $cpf);

			$birth_date = implode("-", array_reverse(explode("/", $birth_date)));

			$pilots->edit($id, $u->getCompany(), $fullname_pilot, $cellphone, $nickname_pilot, $cpf, $birth_date);
			header("Location: " . BASE_URL . "home");
		}

		$data['pilots_info'] = $pilots->getInfo($id, $u->getCompany());

		$this->loadTemplate('pilots_edit', $data);
	}


	public function tourney($id)
	{
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();

		$pilots = new Pilots();
		$tourney = new Tournaments();

		if (isset($_POST['tourneys']) && !empty($_POST['tourneys'])) {
			$plist = $_POST['tourneys'];

			$pilots->tourneyRegistration($id, $plist, $u->getCompany());
			header("Location: " . BASE_URL . "home");
		}

		$data['pilots_info'] = $pilots->getInfo($id, $u->getCompany());
		$data['tourney_list'] = $tourney->getListAll($u->getCompany());

		$this->loadTemplate('pilots_tourney', $data);
	}
}
