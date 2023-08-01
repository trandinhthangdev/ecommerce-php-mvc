<?php  
require_once '../models/User.php';
require_once '../models/Auth.php';

/**
 * LoginAdminController
 */
class LoginAdminController
{
    private $user;
    private $auth;

    public function __construct()
    {
        $this->user = new User();
        $this->auth = new Auth();
    }

    public function login()
    {
        require_once '../views/admin/login/login.php';
    }

    public function login_post()
    {
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user_check = $this->user->where("email = '" . $email . "' AND password = '" . $password ."'");
            if((count($user_check) != 0) && ($user_check[0]['role'] == 1))
            {
                $this->auth->login($email, $password, 0);
                echo json_encode(['res_type' => 'success', 'response' => 'Đăng nhập thành công !']);
            }
            else
            {
                echo json_encode(['res_type' => 'error', 'response' => 'Đăng nhập thất bại !']);;
            }
        }
    }

    public function logout()
    {
        $this->auth->logout();
        header('Location: login.html');
    }

}
?>

