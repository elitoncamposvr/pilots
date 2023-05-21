<?php
class homeController extends controller
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
        $pilots = new Pilots();
        $tourney = new Tournaments();
		$u->setLoggedUser();
        $pilots->isTourneyRegistered($u->getId());
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['pilot_name'] = $u->getName();
        $data['pilot_info'] = $pilots->getInfo($u->getId(), $u->getCompany());
        $data['tourney_list'] = $tourney->getListAll($u->getCompany());

        $this->loadTemplate('home', $data);
    }

    public function unauthorized()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();

        $this->loadTemplate('unauthorized', $data);
    }
}
