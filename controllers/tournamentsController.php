<?php
class tournamentsController extends controller
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

		if ($u->hasPermission('tournaments')) {
			$tourney = new Tournaments();
			$offset = 0;

			$data['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$data['p'] = intval($_GET['p']);
				if ($data['p'] == 0) {
					$data['p'] = 1;
				}
			}

			$offset = (10 * ($data['p'] - 1));

			$data['tourney_list'] = $tourney->getList($offset, $u->getCompany());
			$data['tourney_count'] = $tourney->getCount($u->getCompany());
			$data['p_count'] = ceil($data['tourney_count'] / 10);


			$this->loadTemplate('tournaments', $data);
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

		if ($u->hasPermission('tournaments')) {
			$tourney = new Tournaments();

			if (isset($_POST['name_tourney']) && !empty($_POST['name_tourney'])) {

				$name_tourney = addslashes($_POST['name_tourney']);
				$local_tourney = addslashes($_POST['local_tourney']);


				$tourney->add($name_tourney, $local_tourney, $u->getCompany());

				header("Location: " . BASE_URL . "tournaments");
			}
			$this->loadTemplate('tournaments_add', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function edit($id) {
	    $data = array();
	    $u = new Users();
	    $u->setLoggedUser();
	    $company = new Companies($u->getCompany());
	    $data['company_name'] = $company->getName();
	    $data['user_email'] = $u->getEmail();

	    if($u->hasPermission('tournaments')) {
	        $tourney = new Tournaments();

	        if(isset($_POST['name_tourney']) && !empty($_POST['name_tourney'])) {

	            $name_tourney = addslashes($_POST['name_tourney']);
				$local_tourney = addslashes($_POST['local_tourney']);
				$status  = addslashes($_POST['status']);

	            $tourney->edit($id, $name_tourney, $local_tourney, $status, $u->getCompany());

	            header("Location: ".BASE_URL."tournaments");
			}
			$data['tourney_info'] = $tourney->getInfo($id, $u->getCompany());

	        $this->loadTemplate('tournaments_edit', $data);
	    } else{
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}

	public function delete($id){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPermission('tournaments')){
			$tourney = new Tournaments();

			$tourney->delete($id, $u->getCompany());
			header("Location: ".BASE_URL."tournaments");


			$this->loadTemplate('tournaments', $data);
		} else {
			header("Location: " . BASE_URL . "home/unauthorized");
		}

	}

	public function view($id) {
	    $data = array();
	    $u = new Users();
	    $u->setLoggedUser();
	    $company = new Companies($u->getCompany());
	    $data['company_name'] = $company->getName();
	    $data['user_email'] = $u->getEmail();

	    if($u->hasPermission('tournaments')) {
	        $tourney = new Tournaments();
			$pilots = new Pilots();

	        
			$data['registration_info'] = $tourney->getInfo($id, $u->getCompany());
			$data['pilots_list'] = $pilots->getListPilotsRegistrations($id, $u->getCompany());

	        $this->loadTemplate('tournaments_registrations', $data);
	    } else{
			header("Location: " . BASE_URL . "home/unauthorized");
		}
	}
}
