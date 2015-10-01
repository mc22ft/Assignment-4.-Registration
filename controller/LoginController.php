<?php
/**
  * Solution for assignment 2
  * @author Daniel Toll
  */
namespace controller;

require_once("model/LoginModel.php");
require_once("view/LoginView.php");
require_once("view/RegisterView.php");

class LoginController {

	private $model;
	private $view;
    private $rView;

	public function __construct(\model\LoginModel $model, \view\LoginView $view, \view\RegisterView $rView) {
		$this->model = $model;
		$this->view =  $view;
        $this->rView = $rView;
	}

	public function doControl() {
		
		$userClient = $this->view->getUserClient();

		if ($this->model->isLoggedIn($userClient)) {
			if ($this->view->userWantsToLogout()) {
				$this->model->doLogout();
				$this->view->setUserLogout();
			}
		} else {
			
			if ($this->view->userWantsToLogin()) {
				$uc = $this->view->getCredentials();
				if ($this->model->doLogin($uc) == true) {
					$this->view->setLoginSucceeded();
				} else {
					$this->view->setLoginFailed();
				}
			}//else if($this->view->userWantsToRegister()){ //BÖRJAR HÄR
			    
			//}
            
		}
		$this->model->renew($userClient);
	}
}