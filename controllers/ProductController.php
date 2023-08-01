<?php  
require_once '../models/Category.php';
require_once '../models/Brand.php';
require_once '../models/Product.php';
require_once '../models/Slider.php';
require_once '../function/function.php';

/**
 * CategoryController
 */
class ProductController
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
    }

    public function index()
    {
    	$category = array();
        $brand = array();
        $product = array();
        $slider = array();

    	$category = $this->category->all();
        $brand = $this->brand->all();
        $product = $this->product->all();
        $slider = $this->slider->all();

    	require_once '../views/admin/header.php';
 		require_once '../views/admin/product/list.php';
 		require_once '../views/admin/footer.php';
    }

    public function create()
 	{
        $category = $this->category->all();
        $brand = $this->brand->all();
		require_once '../views/admin/header.php';
		require_once '../views/admin/product/add.php';
		require_once '../views/admin/footer.php';
 	}

 	public function store()
 	{
 		if(isset($_POST['save']))
        {
            $category_id = $_POST['category_id'];
            $brand_id = $_POST['brand_id'];
            $name = $_POST['name'];
            $slug = utf8tourl($_POST['name']);
            $description = $_POST['description'];
            $content = $_POST['content'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $discount_status = 0;
            $discount_price = '';
            if(isset($_POST['discount_status']))
            {
                $discount_status = 1;
                $discount_price = $_POST['discount_price'];
            }
            $featured = $_POST['featured'];
            

            if(isset($_FILES['thumbnail']))
            {
                $file_thumbnail = $_FILES['thumbnail'];
                $file_name_thumbnail = time() . $file_thumbnail['name'];
                move_uploaded_file($file_thumbnail['tmp_name'], '../assets/uploads/products/thumbnails/'.$file_name_thumbnail);
            }
            $thumbnail = $file_name_thumbnail;
            $data_product = [
                'category_id' => $category_id,
                'brand_id' => $brand_id,
                'name' => $name,
                'slug' =>$slug,
                'description' => $description,
                'content' => $content,
                'quantity' => $quantity,
                'price' => $price,
                'discount_status' => $discount_status,
                'discount_price' => $discount_price,
                'thumbnail' => $thumbnail,
                'featured' => $featured
            ];

            $product_id = $this->product->create($data_product);

            if (isset($_FILES['slider'])) 
            {
                $slider = $_FILES['slider'];
                if(!empty(array_filter($slider['name']))){
                    $i = 0;
                    foreach ($slider['tmp_name'] as $key => $value) {
                        $file_name_slider = $slider['name'][$key];
                        $time_now = $i . time();
                        $file_name_slider = $time_now . $file_name_slider;
                        move_uploaded_file($slider['tmp_name'][$key], '../assets/uploads/products/sliders/'.$file_name_slider);
                        $data_slider = [
                            'product_id' => $product_id,
                            'image' => $file_name_slider
                        ];
                        $i = $i + 100;
                        $this->slider->create($data_slider);
                    }
                }
            }
            header('location: index');          
        }
 	}

 	public function edit()
 	{
 		if(isset($_GET['id']))
 		{
 			$id = $_GET['id'];
 			$product = $this->product->find($id);
            $slider_by_product = $this->slider->where("product_id = " . $id);
            $category = array();
            $brand = array();
           
            $category = $this->category->all();
            $brand = $this->brand->all();

	 		require_once '../views/admin/header.php';
	 		require_once '../views/admin/product/edit.php';
	 		require_once '../views/admin/footer.php';
 		}
 	}

 	public function update()
 	{
 		if(isset($_POST['save']))
 		{
            $id = $_POST['id'];
            $category_id = $_POST['category_id'];
            $brand_id = $_POST['brand_id'];
            $name = $_POST['name'];
            $slug = utf8tourl($_POST['name']);
            $description = $_POST['description'];
            $content = $_POST['content'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $featured = $_POST['featured'];

            $old_thumbnail = $_POST['old_thumbnail'];

            $data = [
                'category_id' => $category_id,
                'brand_id' => $brand_id,
                'name' => $name,
                'slug' =>$slug,
                'description' => $description,
                'content' => $content,
                'quantity' => $quantity,
                'price' => $price,
                'featured' => $featured
            ];
            if(isset($_POST['discount_status']))
            {
                $discount_status = 1;
                $discount_price = $_POST['discount_price'];
                $data['discount_status'] = $discount_status;
                $data['discount_price'] = $discount_price;
            }

            if($_FILES['thumbnail']['name'] !='')
            {
                $file_thumbnail = $_FILES['thumbnail'];
                $file_name_thumbnail = time() . $file_thumbnail['name'];
                move_uploaded_file($file_thumbnail['tmp_name'], '../assets/uploads/products/thumbnails/'.$file_name_thumbnail);
                unlink('../assets/uploads/products/thumbnails/'.$old_thumbnail);
                $thumbnail = $file_name_thumbnail;
                $data['thumbnail'] = $thumbnail;

                if($_FILES['slider']['name'][0] !='')
                {
                    foreach ($this->slider->where('product_id = '.$id) as $sli) {
                        unlink('../assets/uploads/products/sliders/'.$sli['image']);
                        $this->slider->destroy($sli['id']);
                    }
                    $slider = $_FILES['slider'];
                    if(!empty(array_filter($slider['name']))){
                        $i = 0;
                        foreach ($slider['tmp_name'] as $key => $value) {
                            $file_name_slider = $slider['name'][$key];
                            $time_now = time() + $i;
                            $file_name_slider = $time_now . $file_name_slider;
                            move_uploaded_file($slider['tmp_name'][$key], '../assets/uploads/products/sliders/'.$file_name_slider);
                            $data_slider = [
                                'product_id' => $id,
                                'image' => $file_name_slider
                            ];
                            $i = $i + 100;
                            $this->slider->create($data_slider);
                        }
                    }               
                }
            }
            else
            {
                if($_FILES['slider']['name'][0] !='')
                {
                    foreach ($this->slider->where('product_id = '.$id) as $sli) {
                        unlink('../assets/uploads/products/sliders/'.$sli['image']);
                        $this->slider->destroy($sli['id']);
                    }
                    $slider = $_FILES['slider'];
                    if(!empty(array_filter($slider['name']))){
                        $i = 0;
                        foreach ($slider['tmp_name'] as $key => $value) {
                            $file_name_slider = $slider['name'][$key];
                            $time_now = time() + $i;
                            $file_name_slider = $time_now . $file_name_slider;
                            move_uploaded_file($slider['tmp_name'][$key], '../assets/uploads/products/sliders/'.$file_name_slider);
                            $data_slider = [
                                'product_id' => $id,
                                'image' => $file_name_slider
                            ];
                            $i = $i + 100;
                            $this->slider->create($data_slider);
                        }
                    }               
                }
            }
            $this->product->update($id, $data);
            header('location: index');  
        }
 	}

 	public function delete()
 	{
 		if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $product = $this->product->find($id);
            $thumbnail = $product['thumbnail'];
            unlink('../assets/uploads/products/thumbnails/'.$thumbnail);
            if($this->product->destroy($id))
            {
                foreach ($this->slider->all() as $sli) {
                    if($sli['product_id'] == $id)
                    {
                        $id_slider = $sli['id'];
                        $slider = $this->slider->find($id_slider);
                        $image = $slider['image'];
                        unlink('../assets/uploads/products/sliders/'.$image);
                        $this->slider->destroy($id_slider);
                    }
                }
                echo 'Deleted Successfully !';
            }
            else
            {
                echo 'Delete Failed !';
            }
        }
 	}

    public function getBrandByCategory()
    {
        if(isset($_POST['category_id']))
        {
            $category_id = $_POST['category_id'];
            $brand_by_category = $this->brand->where("category_id = ". $category_id);
            echo json_encode($brand_by_category);
        }
    }
}
?>
