<?php
namespace App\Controllers;
use App\Controllers\User;
use App\Models\M_vot_user;

class Login extends Vot_controller {
    public function __construct() {
        session_start();
    }
    // public function __construct() {
    //     session_start();
	// 	require_once APPPATH. "libraries/vendor/autoload.php";

	// 	$this->google_client = new \Google_Client();
    //     // Google Client ID, Secret
	// 	$this->google_client->setClientId("475984984652-nu3047ihal17eviia0b0kt6c80eg1riv.apps.googleusercontent.com");
	// 	$this->google_client->setClientSecret("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");

    //     // Redirect page
	// 	$this->google_client->setRedirectUri(base_url() . "/Login/google_auth");
    //     // Access gmail
	// 	$this->google_client->addScope("email");
    //     // Access profile
	// 	$this->google_client->addScope("profile");
    // }
    public function index() {
        // $data['google_button'] = '<a class="btn btn-outline-secondary" href="'.$this->google_client->createAuthUrl().'" ><img src="https://freesvg.org/img/1534129544.png" alt="Login With Google" style="width: 30px"><b class="ms-1 mt-2">Google</b></a>';
        // echo view('v_login.php', $data);
        echo view('v_login.php');
    }
    public function login(){
        $usr_name = $this->request->getPost('usr_name');
        $usr_password = $this->request->getPost('usr_password');
        
        $m_user = new M_vot_user();
        $obj_user = $m_user->get_by_usr_name($usr_name);

        echo '<pre>';
        print_r($this->request->getPost());
        echo '</pre>';

        if(md5($usr_password) == $obj_user->usr_password) {
            echo '<pre>';
            print_r($obj_user);
            echo '</pre>';
            $_SESSION["logged_in"] = true;
            $_SESSION["usr_id"] =  $obj_user->usr_id;
            $_SESSION["usr_name"] = $obj_user->usr_name;
            $_SESSION["usr_full_name"] = $obj_user->usr_full_name;
            $_SESSION["usr_role"] = $obj_user->usr_role;
            $_SESSION["rol_name"] = $obj_user->rol_name;
            $_SESSION["cst_number"] = $obj_user->cst_number;
            
            echo $_SESSION["usr_role"];
            if ($_SESSION["usr_role"] == '5') {
                return $this->response->redirect(base_url('/report'));
            }
            return $this->response->redirect(base_url('/vote'));
        }
        // else {
        //     $_SESSION["logged_in"] = false;
        //     $_SESSION["usr_name"] = $usr_name;
        //     $_SESSION["usr_password"] = $usr_password;
        //     return $this->response->redirect(base_url('/login'));
        // }
    }
    // public function google_auth() {
	// 	$token = $this->google_client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
	// 	if(!isset($token['error'])){
	// 		$this->google_client->setAccessToken($token['access_token']);
    //         $_SESSION["access_token"] = $token['access_token'];

	// 		$google_service = new \Google_Service_Oauth2($this->google_client);

	// 		// Get user data from google
	// 		$data = $google_service->userinfo->get();

    //         $_SESSION["logged_in"] = true;
    //         // $_SESSION["usr_id"] = $data['id'];
    //         $_SESSION["usr_full_name"] = $data['givenName']. " ".$data['familyName'];
    //         $_SESSION["usr_name"] = $data['email']; 
    //         $_SESSION["usr_role"] = 1;
    //         $_SESSION["usr_image"] = $data['picture'];
    //         $_SESSION["login_by_google"] = true;

    //         $obj_user = new User(
    //             NULL,
    //             $_SESSION["usr_name"],
    //             NULL,
    //             $_SESSION["usr_full_name"],
    //             NULL,
    //             1,
    //             500,
    //             $_SESSION["usr_image"]
    //         );
    //         if (!$obj_user->check_valid_usr_name()) {
    //             return $this->response->redirect(base_url('/login'));
    //         }
    //         if (!$obj_user->check_user_exist()) {   
    //             $obj_user->insert_user();
    //         }
    //         return $this->response->redirect(base_url('/vote'));
	// 	}
	// }
    public function logout() {
        session_unset();
        session_destroy();
        return $this->response->redirect(base_url('/login'));
    }
}