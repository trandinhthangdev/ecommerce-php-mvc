<?php  
require_once '../models/Category.php';
require_once '../models/Brand.php';
require_once '../models/Product.php';
require_once '../models/Slider.php';
require_once '../models/News.php';
require_once '../function/function.php';

/**
 * CategoryController
 */
class NewsController
{
    private $category;
    private $brand;
    private $product;
    private $slider;

    public function __construct()
    {
        $this->category = new Category();
        $this->brand = new Brand();
        $this->product = new Product();
        $this->slider = new Slider();
        $this->news = new News();
    }

    public function index()
    {
    	$category = array();
        $brand = array();
        $product = array();
        $slider = array();
        $news = array();

    	$category = $this->category->all();
        $brand = $this->brand->all();
        $product = $this->product->all();
        $slider = $this->slider->all();
        $news = $this->news->all();

    	require_once '../views/admin/header.php';
 		require_once '../views/admin/news/list.php';
 		require_once '../views/admin/footer.php';
    }

    public function create()
 	{
        $product = $this->product->all();
		require_once '../views/admin/header.php';
		require_once '../views/admin/news/add.php';
		require_once '../views/admin/footer.php';
 	}

 	public function store()
 	{
 		if(isset($_POST['save']))
        {
            if(isset($_FILES['image']))
            {
                $file_image = $_FILES['image'];
                $file_name_image = time() . $file_image['name'];
                move_uploaded_file($file_image['tmp_name'], '../assets/uploads/news/'.$file_name_image);
            }
            $image = $file_name_image;

            $title = $_POST['title'];
            $slug = utf8tourl($_POST['title']);
            $content = $_POST['content'];
            $description = $_POST['description'];
            $data_news = [
                'image' => $image,
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'content' => $content
            ];
            $this->news->create($data_news);
            header('location: index'); 
        }
 	}

 	public function edit()
 	{
 		if(isset($_GET['id']))
 		{
 			$id = $_GET['id'];
 			$news = $this->news->find($id);
           
            $product = $this->product->all();

	 		require_once '../views/admin/header.php';
	 		require_once '../views/admin/news/edit.php';
	 		require_once '../views/admin/footer.php';
 		}
 	}

 	public function update()
 	{
 		if(isset($_POST['save']))
 		{
            $id = $_POST['id'];
            $old_image = $_POST['old_image'];
            $title = $_POST['title'];
            $slug = utf8tourl($_POST['title']);
            $content = $_POST['content'];
            $description = $_POST['description'];

            $data_news = [
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'content' => $content
            ];
            if($_FILES['image']['name'] !='')
            {
                $file_image = $_FILES['image'];
                $file_name_image = time() . $file_image['name'];
                move_uploaded_file($file_image['tmp_name'], '../assets/uploads/news/'.$file_name_image);
                unlink('../assets/uploads/news/'.$old_image);
                $image = $file_name_image;
                $data_news['image'] = $image;
            }

            $this->news->update($id, $data_news);
            header('location: index');  
        }
 	}

 	public function delete()
 	{
 		if(isset($_GET['id']))
 		{
            $id = $_GET['id'];
            $news = $this->news->find($id);
            $image = $news['image'];
            unlink('../assets/uploads/news/'.$image);
 			if($this->news->destroy($id))
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
