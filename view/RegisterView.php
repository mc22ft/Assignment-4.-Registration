<?php
    
namespace view;

class RegisterView{
    
    /**
	 * These names are used in $_POST
	 * @var string
	 */
	private static $message = "RegisterView::Message";
	private static $username = "RegisterView::UserName";
	private static $password = "RegisterView::Password";
	private static $passwordRepeat = "RegisterView::PasswordRepeat";
    private static $doRegistration = "RegisterView::DoRegistration";
    
    //Needs a register model
    public function __construct(){
        
    }

    //Request from LoginView
    public function doRegisterForm(){
        //Error message
        $message = "";

        if($this->userWantsToRegister()){
            $message = $this->buildErrorMessage($message);
        }

        //var_dump($_POST);
        
        
        return $this->generateRegisterFormHTML($message);
    }

    private function generateRegisterFormHTML($message) {
		return "<form action='?register' method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id='".self::$message."'>$message</p>
                    <label for='".self::$username."'>Username :</label>
					<input type='text' id='".self::$username."' name='".self::$username."' value=''/>
                    <br>
                    <label for='".self::$password."'>Password :</label>
					<input type='password' id='".self::$password."' name='".self::$password."' value=''/>
                    <br>
					<label for='".self::$passwordRepeat."'>Password :</label>
					<input type='password' id='".self::$passwordRepeat."' name='".self::$passwordRepeat."' value=''/>
                    <br>
					<input type='submit' id='submit' name='".self::$doRegistration."' value='Register'/>
                    <br>
				</fieldset>
			</form>
		";
    }

    public function userWantsToRegister() {
		return isset($_POST[self::$doRegistration]);
	}

    private function buildErrorMessage($message){
       
        if(mb_strlen($this->getUserName()) < 3){
            $message = "Username has too few characters, at least 3 characters.";
        }

        if(mb_strlen($this->getPassword()) < 6){
             if(!empty($message)){
                 $message .= "<br/>";
             }
            $message .= "Password has too few characters, at least 6 characters.";
        }

        return $message;
    }

    private function getUserName() {
		if (isset($_POST[self::$username])){
		    return trim($_POST[self::$username]);
		}
		return "";
	}

	private function getPassword() {
		if (isset($_POST[self::$password]))
			return trim($_POST[self::$password]);
		return "";
	}




}


?>
