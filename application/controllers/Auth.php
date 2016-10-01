<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function logout()
    {
		$this->load->library('Auth0');
		$Auth0 = new Auth0;
		$auth0 = $Auth0->Load();
		$userInfo = $auth0->getUserInfo();
		
		$header['script'] = '
        <script src="https://cdn.auth0.com/js/lock-7.min.js"></script>
        <script type="text/javascript" src="//use.typekit.net/iws6ohy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script>
          var AUTH0_CLIENT_ID = \''.getenv("AUTH0_CLIENT_ID").'\';
          var AUTH0_DOMAIN = \''.getenv("AUTH0_DOMAIN").'\';
          var AUTH0_CALLBACK_URL = \''.getenv("AUTH0_CALLBACK_URL").'\';
        </script>
        <script src="/assets/auth0/app.js"> </script>
		';
		$data="";
		
		$this->load->view('tpl/tpl_header',$header);
		if($userInfo) {
			$userInfo = $auth0->Logout();
			$this->load->view('auth/auth_logout',$data);
		} else {
			$this->load->view('auth/auth_login',$data);
		}
		$this->load->view('tpl/tpl_footer');
	}
	public function Login()
	{
		$this->load->library('Auth0');
		$Auth0 = new Auth0;
		$auth0 = $Auth0->Load();
		$userInfo = $auth0->getUserInfo();
		
		$header['script'] = '
        <script src="https://cdn.auth0.com/js/lock-7.min.js"></script>
        <script type="text/javascript" src="//use.typekit.net/iws6ohy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script>
          var AUTH0_CLIENT_ID = \''.getenv("AUTH0_CLIENT_ID").'\';
          var AUTH0_DOMAIN = \''.getenv("AUTH0_DOMAIN").'\';
          var AUTH0_CALLBACK_URL = \''.getenv("AUTH0_CALLBACK_URL").'\';
        </script>
        <script src="/assets/auth0/app.js"> </script>
		';
		$data['userInfo']=$userInfo;
		
		$this->load->view('tpl/tpl_header',$header);
		if(!$userInfo) {
			$this->load->view('auth/auth_login',$data);
		} else {
			$this->load->view('auth/auth_profile',$data);
		}
		$this->load->view('tpl/tpl_footer');
	}
	public function index() {
		$this->Login();
	}
	public function Profile() {
		$this->Login();
	}
	public function PrivateSystems() {
		$this->load->library('Auth0');
		$Auth0 = new Auth0;
		$auth0 = $Auth0->Load();
		$userInfo = $auth0->getUserInfo();
		
		$header['script'] = '
        <script src="https://cdn.auth0.com/js/lock-7.min.js"></script>
        <script type="text/javascript" src="//use.typekit.net/iws6ohy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script>
          var AUTH0_CLIENT_ID = \''.getenv("AUTH0_CLIENT_ID").'\';
          var AUTH0_DOMAIN = \''.getenv("AUTH0_DOMAIN").'\';
          var AUTH0_CALLBACK_URL = \''.getenv("AUTH0_CALLBACK_URL").'\';
        </script>
        <script src="/assets/auth0/app.js"> </script>
		';
		$data['userInfo']=$userInfo;
		
		$this->load->view('tpl/tpl_header',$header);
		if(!$userInfo) {
			$this->load->view('auth/auth_login',$data);
		} else {
			$email = $userInfo['email'];
			$this->load->model('Storage_model');
			$data['systems'] = $this->Storage_model->list_private_systems($email);
			$this->load->view('system/system_index',$data);
		}
		$this->load->view('tpl/tpl_footer');
	}
}
