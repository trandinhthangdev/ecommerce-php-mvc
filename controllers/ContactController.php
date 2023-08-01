<?php  

require_once '../function/function.php';
require_once '../models/Contact.php';
require_once '../models/Customer.php';
/**
 * ContactController
 */
class ContactController
{
	private $contact;
	private $customer;

	public function __construct()
	{
		$this->contact = new Contact();
		$this->customer = new Customer();
	}

	public function index()
    {
		$contact = array();
    	$contact = $this->contact->all();
    	$customer = $this->customer->all();

    	require_once '../views/admin/header.php';
 		require_once '../views/admin/contact/list.php';
 		require_once '../views/admin/footer.php';    	
    }
}
?>
