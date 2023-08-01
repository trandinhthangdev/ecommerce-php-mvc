<?php  

require_once '../function/function.php';
require_once '../models/Customer.php';
require_once '../models/User.php';
require_once '../models/Auth.php';

/**
 * UserController
 */
class UserController
{
	private $customer;
	private $user;
	private $auth;

	public function __construct()
    {
    	$this->customer = new Customer();
    	$this->user = new User();
    	$this->auth = new Auth();
    }

    public function index()
    {
    	$customer = array();
    	$customer = $this->customer->all();
    	$user = $this->user->all();

    	require_once '../views/admin/header.php';
 		require_once '../views/admin/user/list.php';
 		require_once '../views/admin/footer.php';  
    }

    public function create_admin()
    {
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user_check = $this->user->where("email = '" .$email ."'");
            if(count($user_check) != 0)
            {
                echo json_encode(['res_type' => 'error', 'response' => 'Email đã tồn tại !']);
            }
            else
            {
                $user_id = $this->auth->create($email, $password);
                $role_update_admin = [
                	'role' => 1
                ];
                $this->user->update($user_id, $role_update_admin);
                echo json_encode(['res_type' => 'success', 'response' => 'Bạn đã tạo tài khoản admin thành công thành công !']);;
            }
        }
    }
}
?>


