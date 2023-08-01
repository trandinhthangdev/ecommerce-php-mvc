<?php  
class ErrorController
{
    public function not_found()
    {
        require_once '../views/admin/error/not_found.php';
    }

    public function not_found_client()
    {
        require_once 'views/client/error/not_found_client.php';
    }


}
?>
