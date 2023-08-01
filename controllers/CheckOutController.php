<?php  
require_once '../models/CheckOut.php';
require_once '../function/function.php';

/**
 * CategoryController
 */
class CheckOutController
{
    private $checkout;

    public function __construct()
    {
        $this->checkout = new CheckOut();
    }

    public function index()
    {
    	$checkout = array();
    	$checkout = $this->checkout->all();

    	require_once '../views/admin/header.php';
 		require_once '../views/admin/checkout/list.php';
 		require_once '../views/admin/footer.php';
    }

 	// public function search()
 	// {
 	// 	if(isset($_POST['keyword']))
 	// 	{
 	// 		$keyword = $_POST['keyword'];
 	// 		$data = $this->category->where("name LIKE '%" . $keyword . "%' OR slug LIKE '%" . $keyword . "%'");
 	// 		echo json_encode($data) ;
 	// 	}
 	// }


 	// public function sort()
 	// {
 	// 	if(isset($_POST['sort_column']) && isset($_POST['sort_type']))
 	// 	{
 	// 		$sort_column = $_POST['sort_column'];
 	// 		$sort_type = $_POST['sort_type'];
 	// 		$data = $this->category->sort($sort_column, $sort_type);
 	// 	}
  // 		echo json_encode($data);		
 	// }
}
?>

