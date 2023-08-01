<?php  

require_once '../function/function.php';

/**
 * HomeAdminController
 */
class HomeAdminController
{
	public function index()
    {
    	require_once '../views/admin/header.php';
 		require_once '../views/admin/home/home.php';
 		require_once '../views/admin/footer.php';
    }
}
?>
