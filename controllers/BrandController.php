<?php  
require_once '../models/Category.php';
require_once '../models/Brand.php';
require_once '../function/function.php';

/**
 * CategoryController
 */
class BrandController
{
    private $category;
    private $brand;

    public function __construct()
    {
        $this->category = new Category();
        $this->brand = new Brand();
    }

    public function index()
    {
    	$category = array();
        $brand = array();
    	$category = $this->category->all();
    	$brand = $this->brand->all();

    	require_once '../views/admin/header.php';
 		require_once '../views/admin/brand/list.php';
 		require_once '../views/admin/footer.php';
    }

    public function create()
 	{
        $category = $this->category->all();
		require_once '../views/admin/header.php';
		require_once '../views/admin/brand/add.php';
		require_once '../views/admin/footer.php';
 	}

 	public function store()
 	{
 		if(isset($_POST['save']))
 		{
 			$name = $_POST['name'];
 			$slug = utf8tourl($_POST['name']);
 			$category_id = $_POST['category_id'];

 			$data = [
 				'name' => $name,
 				'slug' => $slug,
                'category_id' => $category_id
 			];

 			$this->brand->create($data);

 			header('location: index'); 			
 		}
 	}

 	public function edit()
 	{
 		if(isset($_GET['id']))
 		{
 			$id = $_GET['id'];
 			$brand = $this->brand->find($id);
            $category = $this->category->all();

	 		require_once '../views/admin/header.php';
	 		require_once '../views/admin/brand/edit.php';
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
            $category_id = $_POST['category_id'];

 			$data = [
 				'name' => $name,
 				'slug' => $slug,
                'category_id' => $category_id
 			];

 			$this->brand->update($id, $data);

 			header('location: index');	
 		}
 	}

 	public function delete()
 	{
 		if(isset($_GET['id']))
 		{
 			$id = $_GET['id'];
 			if($this->brand->destroy($id))
 			{
 				echo 'Deleted Successfully !';
 			}
 			else
 			{
 				echo 'Delete Failed !';
 			}
 		}
 	}

}
?>
