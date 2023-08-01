<?php  

require_once 'function/function.php';
require_once 'models/HomeSlider.php';
require_once 'models/Product.php';
require_once 'models/News.php';
require_once 'models/Category.php';
require_once 'models/Brand.php';
require_once 'models/Slider.php';
require_once 'models/Contact.php';
require_once 'models/Customer.php';
require_once 'models/ProductComment.php';
require_once 'models/NewsComment.php';
require_once 'models/User.php';
require_once 'models/Auth.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
require_once 'models/CheckOut.php';
require_once 'models/ReceivedProduct.php';
require_once 'models/Star.php';
/**
 * ClientController
 */
class ClientController
{
    private $home_slider;
    private $product;
    private $news;
    private $category;
    private $brand;
    private $slider;
    private $contact;
    private $customer;
    private $product_comment;
    private $news_comment;
    private $user;
    private $auth;
    private $order;
    private $order_detail;
    private $check_out;
    private $received_product;
    private $star;

    public function __construct()
    {
        $this->home_slider = new HomeSlider();
        $this->product = new Product();
        $this->news = new News();
        $this->category = new Category();
        $this->brand = new Brand();
        $this->slider = new Slider();
        $this->contact = new Contact();
        $this->customer = new Customer();
        $this->product_comment = new ProductComment();
        $this->news_comment = new NewsComment();
        $this->user = new User();
        $this->auth = new Auth();
        $this->order = new Order();
        $this->order_detail = new OrderDetail();
        $this->check_out = new CheckOut();
        $this->received_product = new ReceivedProduct();
        $this->star = new Star();
    }

	public function index()
    {
        $user = $this->auth->user();

        $home_slider = $this->home_slider->where('status = 1');
        $featured_products = $this->product->where('featured = 1 ORDER BY id DESC LIMIT 8');
        $new_products = $this->product->multiple('ORDER BY id DESC LIMIT 8');
        $last_news = $this->news->limit(0,4);

    	require_once 'views/client/header.php';
    	require_once 'views/client/pages/home/home-slider.php';
    	require_once 'views/client/pages/home/featured-products.php';
		require_once 'views/client/pages/home/new-products.php';
		require_once 'views/client/pages/home/last-news.php';
		require_once 'views/client/footer.php';
    }

    public function product()
    {
        $user = $this->auth->user();

        $category = $this->category->all();
        $brand = $this->brand->all();
        require_once 'views/client/header.php';
        if(!isset($_GET['l1']))
        {
            $new_products = $this->product->multiple('ORDER BY id DESC');
            require_once 'views/client/pages/product/new-products.php';
        }
        else
        {
            $category_id = $_GET['l1'];
            $name_category = $this->category->find($category_id)['name'];
            if(isset($_GET['l2']))
            {
            $brand_id = $_GET['l2'];
            $name_brand = $this->brand->find($brand_id)['name'];
            $brand_products = $this->product->where(' brand_id = ' . $brand_id . ' ORDER BY id DESC');
            require_once 'views/client/pages/product/brand-products.php';
            }
            else
            {
            $category_products = $this->product->where('category_id = ' . $category_id . ' ORDER BY id DESC');
            require_once 'views/client/pages/product/category-products.php';
            }
            

            
        }
        
    	
    	
		require_once 'views/client/footer.php';
    }

    public function product_detail()
    {
        $user = $this->auth->user();

        if($user != 0)
        {
            $user_id = $user['id'];
            $customer = $this->customer->where('user_id = ' . $user_id);

            $customer_id = $customer[0]['id'];
        }
        

        if(isset($_GET['l1']))
        {
            $product_id = $_GET['l1'];
            $star = $this->star->where('product_id = ' . $product_id);

            $count_product_star = count($star);

            $count_one_star = count($this->star->where('product_id = ' . $product_id . " AND number_star = 1"));
            $count_two_star = count($this->star->where('product_id = ' . $product_id . " AND number_star = 2"));
            $count_three_star = count($this->star->where('product_id = ' . $product_id . " AND number_star = 3"));
            $count_four_star = count($this->star->where('product_id = ' . $product_id . " AND number_star = 4"));
            $count_five_star = count($this->star->where('product_id = ' . $product_id . " AND number_star = 5"));

            $product = $this->product->find($product_id);
            $brand_id = $product['brand_id'];
            $product_slider = $this->slider->where('product_id = '.$product_id);
            $featured_products = $this->product->where('featured = 1 ORDER BY id DESC LIMIT 4');
            $related_products = $this->product->where('id <> '.$product_id.' AND brand_id = '.$brand_id );
            require_once 'views/client/header.php';
            require_once 'views/client/pages/product-detail/product-detail.php';
            require_once 'views/client/footer.php';
        }
    	
    }

    public function news()
    {
        $user = $this->auth->user();

        $last_news = $this->news->multiple('ORDER BY id DESC');
        $popular_news = $this->news->multiple('ORDER BY view DESC LIMIT 4');
    	require_once 'views/client/header.php';
    	require_once 'views/client/pages/news/news.php';
		require_once 'views/client/footer.php';
    }

    public function news_load_more()
    {
        if(isset($_POST['start']) && isset($_POST['offset']) )
        {
            $start = $_POST['start'];
            $offset = $_POST['offset'];
            $news_load_more = $this->news->limit($start, $offset);
            echo json_encode($news_load_more);
        }
    }

    public function new_products_load_more()
    {
        if(isset($_POST['start']) && isset($_POST['offset']) )
        {
            $start = $_POST['start'];
            $offset = $_POST['offset'];
            $new_products_load_more = $this->product->limit($start, $offset);
            echo json_encode($new_products_load_more);
        } 
    }    

    public function category_products_load_more()
    {
        if(isset($_POST['start']) && isset($_POST['offset']) && isset($_POST['category_id']))
        {
            $start = $_POST['start'];
            $offset = $_POST['offset'];
            $category_id = $_POST['category_id'];
            $category_products_load_more = $this->product->where('category_id = ' . $category_id . ' ORDER BY id DESC LIMIT ' . $offset . ' OFFSET ' . $start);
            echo json_encode($category_products_load_more);
        } 
    }

    public function brand_products_load_more()
    {
        if(isset($_POST['start']) && isset($_POST['offset']) && isset($_POST['brand_id']))
        {
            $start = $_POST['start'];
            $offset = $_POST['offset'];
            $brand_id = $_POST['brand_id'];
            $brand_products_load_more = $this->product->where('brand_id = ' . $brand_id . ' ORDER BY id DESC LIMIT ' . $offset . ' OFFSET ' . $start);
            echo json_encode($brand_products_load_more);
        } 
    }

    public function news_detail()
    {
        $user = $this->auth->user();

        if(isset($_GET['l1']))
        {
            $news_id = $_GET['l1'];
            $news = $this->news->find($news_id);
            // $brand_id = $product['brand_id'];
            // $product_slider = $this->slider->where('product_id = '.$product_id);
            // $featured_products = $this->product->where('featured = 1 AND status = 1 ORDER BY id DESC LIMIT 4');
            $popular_news = $this->news->multiple('ORDER BY view DESC LIMIT 4');

            $new_products = $this->product->multiple(' ORDER BY id DESC LIMIT 4');
            $user = $this->auth->user();
            require_once 'views/client/header.php';
            require_once 'views/client/pages/news-detail/news-detail.php';
            require_once 'views/client/footer.php';
        }    	
    }

    public function about()
    {
        $user = $this->auth->user();

    	require_once 'views/client/header.php';
    	require_once 'views/client/pages/about/about.php';
		require_once 'views/client/footer.php';
    }

    /* Contact */
    public function contact()
    {
        $user = $this->auth->user();

    	require_once 'views/client/header.php';
    	require_once 'views/client/pages/contact/contact.php';
		require_once 'views/client/footer.php';
    }

    public function contact_post()
    {
        if(isset($_POST['customer_id']) && isset($_POST['message']))
        {
            $customer_id = $_POST['customer_id'];
            $message = $_POST['message'];
            $data_contact = [
                'customer_id' => $customer_id,
                'message' => $message
            ];
            $this->contact->create($data_contact);
            echo "Cảm ơn bạn đã gửi cho chúng tôi !";
        }
    }

    public function show_cart()
    {
        if(isset($_POST['cart_customer_id']))
        {
            $cart_customer_id = $_POST['cart_customer_id'];
            $order = $this->order->where('customer_id = ' . $cart_customer_id);
            $order_id = $order[0]['id'];
            // $product = $this->product->all();
            $order_detail = $this->order_detail->where('order_id = ' . $order_id);

            echo json_encode($order_detail);
        }
    }

    public function product_info()
    {
        if(isset($_POST['product_id']))
        {
            $product_id = $_POST['product_id'];
            $product_info = $this->product->find($product_id);
            echo json_encode($product_info);
        }
    }

    // public function view_order()
    // {
    //     $user = $this->auth->user();
    //     $user_id = $user['id'];
    //     $customer = $this->customer->where('user_id = ' . $user_id);

    //     $customer_id = $customer[0]['id'];
    //     $order = $this->order->where('customer_id = ' . $customer_id);
    //     return $order;
    // }

    public function add_to_cart()
    {
        $user = $this->auth->user();
        $user_id = $user['id'];
        $customer = $this->customer->where('user_id = ' . $user_id);

        $customer_id = $customer[0]['id'];
        $order = $this->order->where('customer_id = ' . $customer_id);
        if(count($order) != 0)
        {
            $order_id = $order[0]['id'];
        }
        else
        {
            $data_order = [
                'customer_id' => $customer_id
            ];
            $order_id = $this->order->create($data_order);
        }

        if(isset($_POST['product_id']))
        {
            $product_id = $_POST['product_id'];
            $check_product_cart = $this->order_detail->where('order_id = ' . $order_id . ' AND product_id = ' . $product_id);
            if(count($check_product_cart) != 0)
            {
                echo json_encode(['res_type' => 'error', 'response' => 'Sản phẩm này đã có trong giỏ hàng của bạn !']);
            }
            else
            {
                $data_order_detail = [
                'order_id' => $order_id,
                'product_id' => $product_id,
                'quantity' => 1
                ];
                $this->order_detail->create($data_order_detail);
                echo json_encode(['res_type' => 'success', 'response' => 'Đã thêm sản phẩm vào giỏ hàng của bạn thành công !']);
            }    
        }

    }

    public function delete_product_cart()
    {
        if(isset($_POST['order_detail_id']))
        {
            $order_detail_id = $_POST['order_detail_id'];
            $this->order_detail->destroy($order_detail_id);
            echo json_encode(['res_type' => 'success', 'response' => 'Đã xóa sản phẩm trong giỏ hàng thành công !']);
        }
    }

    public function update_quantity_order_detail()
    {
        if(isset($_POST['order_detail_id']) && isset($_POST['change_quantity']))
        {
            $order_detail_id = $_POST['order_detail_id'];
            $change_quantity = $_POST['change_quantity'];
            $order_detail = $this->order_detail->find($order_detail_id);
            $product_id = $order_detail['product_id'];
            $product = $this->product->find($product_id);
            $quantity = $product['quantity'];
            if($quantity < $change_quantity)
            {
                echo json_encode(['res_type' => 'error', 'response' => 'Bạn đã thêm tối đa số lượng sản phẩm vào giỏ hàng !']);
            }
            else 
            {
                $data_update_order_detail = [
                    'quantity' => $change_quantity
                ];
                $this->order_detail->update($order_detail_id, $data_update_order_detail);
                echo json_encode(['res_type' => 'success', 'response' => 'Bạn đã thay đổi thành công !']);
            }
        }
    }



    public function checkout()
    {
        $user = $this->auth->user();
        if($user != 0)
        {
            $user_id = $user['id'];
            $customer = $this->customer->where('user_id = ' . $user_id);
            $customer_id = $customer[0]['id'];
            $order = $this->order->where('customer_id = ' . $customer_id);
            $order_id = $order[0]['id'];
            $order_detail = $this->order_detail->where('order_id = ' . $order_id);
            require_once 'views/client/header.php';
            require_once 'views/client/pages/check-out/check-out.php';
            require_once 'views/client/footer.php';
        }
    }

    public function check_out_show()
    {
        if(isset($_POST['check_out_show']))
        {
            $check_out_show = $_POST['check_out_show'];
            $data_check_out = [
                'check_out_show' => $check_out_show
            ];
            $this->check_out->create($data_check_out);
            echo 'check_out_show';
        }
    }

    public function check_out_success()
    {
        $user = $this->auth->user();
        if($user != 0)
        {
            $user_id = $user['id'];
            $customer = $this->customer->where('user_id = ' . $user_id);
            $customer_id = $customer[0]['id'];
            $order = $this->order->where('customer_id = ' . $customer_id);
            $order_id = $order[0]['id'];
            $order_detail = $this->order_detail->where('order_id = ' . $order_id);

            foreach ($order_detail as $ord) {
                $quantity = $ord['quantity'];
                $product_id = $ord['product_id'];
                $product = $this->product->find($product_id);
                $product_quantity = $product['quantity'];
                $product_quantity_update = $product_quantity-$quantity;
                $data_update_product = [
                    'quantity' => $product_quantity_update
                ];
                $this->product->update($product_id, $data_update_product);

                $data_received_product = [
                    'customer_id' => $customer_id,
                    'product_id' => $product_id
                ];
                $this->received_product->create($data_received_product);
                $order_detail_id = $ord['id'];
                $this->order_detail->destroy($order_detail_id);
            }

            echo "Check out successfully !";
        }
    }





    /* Login - Logout - Register */

    public function login()
    {
        require_once 'views/client/pages/login/login.php';
    }

    public function login_post()
    {
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['remember']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $remember = $_POST['remember'];

            $user_check = $this->user->where("email = '" . $email . "' AND password = '" . $password ."'");
            if(count($user_check) != 0)
            {
                $this->auth->login($email, $password, $remember);
                echo json_encode(['res_type' => 'success', 'response' => 'Đăng nhập thành công !']);
            }
            else
            {
                // $this->auth->create($email, $password);
                echo json_encode(['res_type' => 'error', 'response' => 'Đăng ký thất bại !']);;
            }
        }
    }

    public function register()
    {
        require_once 'views/client/pages/register/register.php';
    }

    public function register_post()
    {
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user_check = $this->user->where("email = '" .$email ."'");
            if(count($user_check) != 0)
            {
                echo json_encode(['res_type' => 'error', 'response' => 'Email đã tồn tại !']);
            }
            else
            {
                $user_id = $this->auth->create($email, $password);
                $data_customer = [
                    'user_id' => $user_id
                ];
                $this->customer->create($data_customer);
                echo json_encode(['res_type' => 'success', 'response' => 'Đăng ký thành công !']);;
            }
        }
    }

    public function logout()
    {
        $this->auth->logout();
        header('Location: login.html');
    }

    public function profile()
    {
        $user = $this->auth->user();
        $user_id = $user['id'];
        $customer = $this->customer->where('user_id = ' . $user_id);

        require_once 'views/client/header.php';
        require_once 'views/client/pages/profile/profile.php';
        require_once 'views/client/footer.php'; 
    }

    public function view_customer()
    {
        $user = $this->auth->user();
        $user_id = $user['id'];
        $customer = $this->customer->where('user_id = ' . $user_id);
        echo json_encode($customer[0]);
    }

    public function update_profile()
    {
        $user = $this->auth->user();
        $user_id = $user['id'];
        $customer = $this->customer->where('user_id = ' . $user_id);
        $customer_id = $customer[0]['id'];
        if(isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phone']))
        {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $data_update_customer = [
                'name' => $name,
                'address' => $address,
                'phone' => $phone
            ];

            $this->customer->update($customer_id, $data_update_customer);
            echo "Bạn đã cập nhật thành công thông tin cá nhân !";
        }
    }


    public function search()
    {
        $user = $this->auth->user();
        if(isset($_GET['key_word']))
        {
            $key_word = $_GET['key_word'];
            $search_products = $this->product->multiple("WHERE name LIKE '%" . $key_word ."%' AND slug LIKE '%" . $key_word ."%'");
            require_once 'views/client/header.php';
            require_once 'views/client/pages/search/search.php';
            require_once 'views/client/footer.php'; 
        }

    }


    public function send_comment_news()
    {
        $user = $this->auth->user();
        if($user != 0)
        {
            $user_id = $user['id'];
            $customer = $this->customer->where('user_id = ' . $user_id);
            $customer_id = $customer[0]['id'];

            if(isset($_POST['comment']) && isset($_POST['news_id']))
            {
                $news_id = $_POST['news_id'];
                $comment = $_POST['comment'];
                $data_send_comment_news = [
                    'customer_id' => $customer_id,
                    'news_id' => $news_id,
                    'content' => $comment
                ];
                $this->news_comment->create($data_send_comment_news);
                echo "Bạn đã bình luận thành công !";
            }
        }
    }

    public function send_comment_product()
    {
        $user = $this->auth->user();
        if($user != 0)
        {
            $user_id = $user['id'];
            $customer = $this->customer->where('user_id = ' . $user_id);
            $customer_id = $customer[0]['id'];

            if(isset($_POST['comment']) && isset($_POST['product_id']))
            {
                $product_id = $_POST['product_id'];
                $comment = $_POST['comment'];
                $data_send_comment_product = [
                    'customer_id' => $customer_id,
                    'product_id' => $product_id,
                    'content' => $comment
                ];
                $this->product_comment->create($data_send_comment_product);
                echo "Bạn đã bình luận thành công !";
            }
        }
    }



    public function news_comments_load_more()
    {
        if(isset($_POST['news_id']) && isset($_POST['start']) && isset($_POST['offset']))
        {
            $news_id = $_POST['news_id'];
            $start = $_POST['start'];
            $offset = $_POST['offset'];
            $news_comments_load_more = $this->news_comment->multiple('WHERE news_id = ' . $news_id . " ORDER BY id DESC " . " LIMIT " . $offset . " OFFSET " . $start);

            echo json_encode($news_comments_load_more);
        }

    }

    public function product_comments_load_more()
    {
        if(isset($_POST['product_id']) && isset($_POST['start']) && isset($_POST['offset']))
        {
            $product_id = $_POST['product_id'];
            $start = $_POST['start'];
            $offset = $_POST['offset'];
            $product_comments_load_more = $this->product_comment->multiple('WHERE product_id = ' . $product_id . " ORDER BY id DESC " . " LIMIT " . $offset . " OFFSET " . $start);

            echo json_encode($product_comments_load_more);
        }

    }



    public function view_name_customer()
    {
        if(isset($_POST['customer_id']))
        {
            $customer_id = $_POST['customer_id'];
            $customer = $this->customer->find($customer_id);
            $name_customer = $customer['name'];
            echo $name_customer;
        }
    }


    public function count_news_comments()
    {
        if(isset($_POST['news_id']))
        {
            $news_id = $_POST['news_id'];
            $news_comment = $this->news_comment->where('news_id = ' . $news_id);
            echo count($news_comment);
            // echo $news_id;
        }
    }

        public function check_customer_check_out()
    {
        if(isset($_POST['customer_id']) && isset($_POST['product_id']))
        {
            $customer_id = $_POST['customer_id'];
            $product_id = $_POST['product_id'];
            $received_product = $this->received_product->where('customer_id = ' . $customer_id . ' AND product_id = '. $product_id);
            echo count($received_product);
        }
    }

    public function avaluate_product()
    {
        if(isset($_POST['customer_id']) && isset($_POST['product_id']) && isset($_POST['number_star']))
        {
            $customer_id = $_POST['customer_id'];
            $product_id = $_POST['product_id'];
            $number_star = $_POST['number_star'];

            $received_product = $this->received_product->where('customer_id = ' . $customer_id . ' AND product_id = '. $product_id);
            if(count($received_product) == 0)
            {
                echo json_encode(['res_type' => 'error', 'response' => 'Bạn chưa mua sản phẩm này nên không được đánh giá !']);
            }
            else
            {
                $check_avaluate = $this->star->where('customer_id = ' . $customer_id . ' AND product_id = '. $product_id);
                if(count($check_avaluate) > 0)
                {
                    echo json_encode(['res_type' => 'error', 'response' => 'Bạn đã đánh giá sản phẩm rồi !']);
                }
                else
                {
                    $data_star = [
                        'customer_id' => $customer_id,
                        'product_id' => $product_id,
                        'number_star' => $number_star
                    ]; 

                    $this->star->create($data_star);

                    $product_star = $this->star->where('product_id = '. $product_id);
                    $total_star = 0;
                    $count = 0;
                    foreach ($product_star as $value) {
                        $total_star += $value['number_star'];
                        $count++;
                    }
                    $product_update_star = round($total_star/$count, 1);
                    $data_update_product = [
                        'star' => $product_update_star
                    ];

                    $this->product->update($product_id, $data_update_product);

                    echo json_encode(['res_type' => 'success', 'response' => 'Cảm ơn bạn đã đánh giá !']);
                }
            }
                
        }
    }

    public function update_view_news()
    {
        if(isset($_POST['news_id']))
        {
            $news_id = $_POST['news_id'];
            $news = $this->news->find($news_id);
            $view = $news['view'];
            $update_view_news = [
                'view' => $view + 1
            ];
            $this->news->update($news_id, $update_view_news);
        }
    }



}
?>
