<?php  
require_once '../models/Category.php';
require_once '../function/function.php';

/**
 * CategoryController
 */
class CategoryController
{
    private $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function index()
    {
    	$category = array();
    	$category = $this->category->all();

    	require_once '../views/admin/header.php';
 		require_once '../views/admin/category/list.php';
 		require_once '../views/admin/footer.php';
    }

    public function create()
 	{
		require_once '../views/admin/header.php';
		require_once '../views/admin/category/add.php';
		require_once '../views/admin/footer.php';
 	}

 	public function store()
 	{
 		if(isset($_POST['save']))
 		{
 			$name = $_POST['name'];
 			$slug = utf8tourl($_POST['name']);

 			$data = [
 				'name' => $name,
 				'slug' => $slug
  			];

 			$this->category->create($data);

 			header('location: index'); 			
 		}
 	}

 	public function edit()
 	{
 		if(isset($_GET['id']))
 		{
 			$id = $_GET['id'];
 			$category = $this->category->find($id);

	 		require_once '../views/admin/header.php';
	 		require_once '../views/admin/category/edit.php';
	 		require_once '../views/admin/footer.php';
 		}
 	}

 	public function update()
 	{
 		if($_POST['save'])
 		{
 			$id = $_POST['id'];
 			$name = $_POST['name'];
 			$slug = utf8tourl($_POST['name']);
 			$data = [
 				'name' => $name,
 				'slug' => $slug
 			];

 			$this->category->update($id, $data);

 			header('location: index');	
 		}
 	}

 	public function delete()
 	{
 		if(isset($_GET['id']))
 		{
 			$id = $_GET['id'];
 			if($this->category->destroy($id))
 			{
 				echo 'Deleted Successfully !';
 			}
 			else
 			{
 				echo 'Delete Failed !';
 			}
 		}
 	}

 	public function search()
 	{
 		if(isset($_POST['keyword']))
 		{
 			$keyword = $_POST['keyword'];
 			$data = $this->category->where("name LIKE '%" . $keyword . "%' OR slug LIKE '%" . $keyword . "%'");
 			echo json_encode($data) ;
 		}
 	}


 	public function sort()
 	{
 		if(isset($_POST['sort_column']) && isset($_POST['sort_type']))
 		{
 			$sort_column = $_POST['sort_column'];
 			$sort_type = $_POST['sort_type'];
 			$data = $this->category->sort($sort_column, $sort_type);
 		}
  		echo json_encode($data);		
 	}
}
?>

