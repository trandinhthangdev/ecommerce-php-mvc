<?php  
require_once '../controllers/HomeAdminController.php';
require_once '../controllers/CategoryController.php';
require_once '../controllers/BrandController.php';
require_once '../controllers/ProductController.php';
require_once '../controllers/NewsController.php';
require_once '../controllers/SliderController.php';
require_once '../controllers/SliderController.php';
require_once '../controllers/CheckOutController.php';

require_once '../controllers/ContactController.php';
require_once '../controllers/CustomerController.php';
require_once '../controllers/NewsCommentController.php';
require_once '../controllers/OrderController.php';
require_once '../controllers/OrderDetailController.php';
require_once '../controllers/ProductCommentController.php';
require_once '../controllers/UserController.php';
require_once '../controllers/LoginAdminController.php';
require_once '../controllers/ErrorController.php';
require_once '../models/Auth.php';


$homeAdminController = new HomeAdminController();
$categoryController = new CategoryController();
$brandController = new BrandController();
$productController = new ProductController();
$newsController = new NewsController();
$sliderController = new SliderController();
$checkOutController = new CheckOutController();
$errorController = new ErrorController();

$contactController = new ContactController();
$customerController = new CustomerController();
$newsCommentController = new NewsCommentController();
$orderController = new OrderController();
$orderDetailController = new OrderDetailController();
$productCommentController = new ProductCommentController();
$userController = new UserController();
$loginAdminController = new LoginAdminController();

$auth = new Auth();

$user = $auth->user();

if(($user != 0) && ($user['role'] == 1))
{
	if(isset($_GET['controller']))
	{
		$controller = $_GET['controller'];
		switch ($controller) {
			case 'category':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					if(method_exists($categoryController, $action))
					{
						call_user_func(array($categoryController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
				}
				break;
			case 'brand':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					if(method_exists($brandController, $action))
					{
						call_user_func(array($brandController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
					
				}
				break;
			case 'product':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					if(method_exists($productController, $action))
					{
						call_user_func(array($productController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
				}
				break;
			case 'slider':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					if(method_exists($sliderController, $action))
					{
						call_user_func(array($sliderController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
				}
				break;
			case 'contact':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					if(method_exists($contactController, $action))
					{
						call_user_func(array($contactController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
				}
				break;
			case 'customer':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					if(method_exists($customerController, $action))
					{
						call_user_func(array($customerController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
				}
				break;
			case 'news-comment':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					if(method_exists($newsCommentController, $action))
					{
						call_user_func(array($newsCommentController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
				}
				break;
			case 'news':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					if(method_exists($newsController, $action))
					{
						call_user_func(array($newsController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
				}
				break;
			case 'product-comment':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					if(method_exists($productCommentController, $action))
					{
						call_user_func(array($productCommentController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
				}
				break;
			case 'user':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					if(method_exists($userController, $action))
					{
						call_user_func(array($userController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
				}
				break;
			case 'checkout':
				if(isset($_GET['action']))
				{
					$action = $_GET['action'];
					call_user_func(array($checkOutController, $action));
					if(method_exists($checkOutController, $action))
					{
						call_user_func(array($checkOutController, $action));
					}
					else 
					{
						call_user_func(array($errorController, 'not_found'));
					}
				}
				break;	
			default:
				break;
		}
	}
	else
	{
		call_user_func(array($homeAdminController, 'index'));
	}
}
else
{
	function Redirect($url, $permanent = false)
	{
	    header('Location: ' . $url, true, $permanent ? 301 : 302);

	    exit();
	}

	Redirect('http://localhost/ecommerce_php/admin/login.html', false);


	// header('Location : http://localhost/ecommerce_php/admin.login',true, false ? 301 : 302);

}


?>