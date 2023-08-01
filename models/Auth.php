<?php    
session_start();
/*
* 	Brand Class
*/

require_once 'User.php';

class Auth
{
	private $user;


    public function __construct()
    {
        $this->user = new User();
    }

    public function user()
    {
    	if(isset($_SESSION['email']) && isset($_SESSION['password']))
    	{
    		$email = $_SESSION['email'];
    		$password = $_SESSION['password'];
    		$user = $this->user->where("email = '" . $email . "' AND password = '" . $password ."'");
    		if(count($user) != 0)
    		{
    			return $user[0];
    		}
    		else
    		{
    			return 0;
    		}
    	} 
    	else if(isset($_COOKIE['remember']) && isset($_COOKIE['email']) && isset($_COOKIE['password']))
    	{
			$email = $_COOKIE['email'];
			$password = $_COOKIE['password'];
			$user = $this->user->where("email = '" . $email . "' AND password = '" . $password ."'");
			if(count($user) != 0)
			{
				return $user[0];
			}
			else
			{
				return 0;
			}
    	}
    	else 
    	{
    		return 0;	
    	}
    }

    public function create($email, $password)
    {
    	$data_user = [
    		'email' => $email,
    		'password' => $password
    	];
		$_SESSION['email'] = $email;
    	$_SESSION['password'] = $password;

    	return $this->user->create($data_user);
    	
    }

    public function logout()
    {
    	session_destroy();
    	setcookie('remember', '', 1);
    	setcookie('email', '', 1);
    	setcookie('password', '', 1);
    }

    public function login($email, $password, $remember = 0)
    {
    	if($remember == 1)
    	{
    		setcookie('remember', $remember, time()+86400*365);
    		setcookie('email', $email, time()+86400*365);
			setcookie('password', $password, time()+86400*365);
    	}
    	else
    	{
    		$_SESSION['email'] = $email;
    		$_SESSION['password'] = $password;
    	}
    }

}


?>
