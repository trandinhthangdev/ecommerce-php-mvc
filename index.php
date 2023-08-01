<?php  

require_once 'controllers/ClientController.php';
require_once 'controllers/ErrorController.php';


$clientController = new ClientController();
$errorController = new ErrorController();

if(isset($_GET['action']))
{
	$action = $_GET['action'];
	if(method_exists($clientController, $action))
	{
		call_user_func(array($clientController, $action));
	}
	else 
	{
		call_user_func(array($errorController, 'not_found_client'));
	}
}
?>
