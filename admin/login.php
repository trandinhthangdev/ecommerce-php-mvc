<?php  
require_once '../controllers/LoginAdminController.php';
require_once '../models/Auth.php';

$loginAdminController = new LoginAdminController();

$auth = new Auth();

$user = $auth->user();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
    call_user_func(array($loginAdminController, $action));
}


?>