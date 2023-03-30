<?php
class settingsController extends controller{
	public function __construct(){
		
		$u = new Users();
		if($u->isLogged() == false){
			header("Location: ".BASE_URL."login");
			exit;
		}
	}

	public function index(){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPermission('settings')){
			
			
			$this->loadTemplate('settings', $data);
		} else {
			header("Location: ".BASE_URL);
		}
	}

	public function users(){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPermission('settings')){
			
			
			$this->loadTemplate('settings_users', $data);
		} else {
			header("Location: ".BASE_URL);
		}
	}

	public function company(){
		$data = array();
		$u = new Users();
		$u->setLoggedUser();
		$company = new Companies($u->getCompany());
		$data['company_name'] = $company->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPermission('settings')){
			
			
			$this->loadTemplate('settings_company', $data);
		} else {
			header("Location: ".BASE_URL);
		}
	}
	
}