<?php  

require_once '../function/function.php';
require_once '../models/NewsComment.php';
require_once '../models/News.php';
require_once '../models/Customer.php';

/**
 * NewsCommentController
 */
class NewsCommentController
{
	private $news_comment;
	private $news;
	private $customer;

	public function __construct()
	{
		$this->news_comment = new NewsComment();
		$this->news = new News();
		$this->customer = new Customer();
	}

	public function index()
    {
    	$news_comment = array();
    	$news_comment = $this->news_comment->all();
    	$news = $this->news->all();
    	$customer = $this->customer->all();

    	require_once '../views/admin/header.php';
 		require_once '../views/admin/news-comment/list.php';
 		require_once '../views/admin/footer.php';  
    }
}
?>
