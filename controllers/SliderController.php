<?php  
require_once '../models/HomeSlider.php';
/**
 * CategoryController
 */
class SliderController
{
    private $slider;

    public function __construct()
    {
        $this->slider = new HomeSlider();
    }

    public function index()
    {
    	$slider = $this->slider->all();

    	require_once '../views/admin/header.php';
 		require_once '../views/admin/slider/list.php';
 		require_once '../views/admin/footer.php';
    }

    public function create()
 	{
		require_once '../views/admin/header.php';
		require_once '../views/admin/slider/add.php';
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
                move_uploaded_file($file_image['tmp_name'], '../assets/uploads/sliders/'.$file_name_image);
            }
            $image = $file_name_image;
            $link = $_POST['link'];
            $status = $_POST['status'];

 			$data_slider = [
 				'image' => $image,
 				'link' => $link,
 				'status' => $status
 			];

 			$this->slider->create($data_slider);

 			header('location: index'); 			
 		}
 	}

 	public function edit()
 	{
 		if(isset($_GET['id']))
 		{
 			$id = $_GET['id'];
 			$slider = $this->slider->find($id);

	 		require_once '../views/admin/header.php';
	 		require_once '../views/admin/slider/edit.php';
	 		require_once '../views/admin/footer.php';
 		}
 	}

 	public function update()
 	{
 		if($_POST['save'])
 		{
            $id = $_POST['id'];
 			$old_image = $_POST['old_image'];
            $link = $_POST['link'];
            $status = $_POST['status'];

            $data_slider = [
                'link' => $link,
                'status' => $status
            ];
            if($_FILES['image']['name'] !='')
            {
                $file_image = $_FILES['image'];
                $file_name_image = time() . $file_image['name'];
                move_uploaded_file($file_image['tmp_name'], '../assets/uploads/sliders/'.$file_name_image);
                unlink('../assets/uploads/sliders/'.$old_image);
                $image = $file_name_image;
                $data_slider['image'] = $image;
            }

 			$this->slider->update($id, $data_slider);

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
