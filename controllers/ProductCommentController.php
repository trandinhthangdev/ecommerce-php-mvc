<?php  

require_once '../function/function.php';
require_once '../models/ProductComment.php';
require_once '../models/Product.php';
require_once '../models/Customer.php';

/**
 * NewsCommentController
 */
class ProductCommentController
{
	private $product_comment;
	private $product;
	private $customer;

	public function __construct()
	{
		$this->product_comment = new ProductComment();
		$this->product = new Product();
		$this->customer = new Customer();
	}

	public function index()
    {
    	$product_comment = array();
    	$product_comment = $this->product_comment->all();
    	$product = $this->product->all();
    	$customer = $this->customer->all();

    	require_once '../views/admin/header.php';
 		require_once '../views/admin/product-comment/list.php';
 		require_once '../views/admin/footer.php';  
    }
}
?>
