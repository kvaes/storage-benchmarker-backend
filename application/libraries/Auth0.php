<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth0
{
    public function __construct()
    {
        require __DIR__ . '/auth0/vendor/autoload.php';
		require __DIR__ . '/auth0/dotenv-loader.php';
	}
	public function UserInfo()
	{
		$auth0 = new \Auth0\SDK\Auth0(array(
			'domain'        => getenv('AUTH0_DOMAIN'),
			'client_id'     => getenv('AUTH0_CLIENT_ID'),
			'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
			'redirect_uri'  => getenv('AUTH0_CALLBACK_URL')
		));
		return $auth0->getUserInfo();
    }
	public function Load()
	{
		$auth0 = new \Auth0\SDK\Auth0(array(
			'domain'        => getenv('AUTH0_DOMAIN'),
			'client_id'     => getenv('AUTH0_CLIENT_ID'),
			'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
			'redirect_uri'  => getenv('AUTH0_CALLBACK_URL')
		));
		return $auth0;
	}
}