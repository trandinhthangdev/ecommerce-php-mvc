<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Ecommerce PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="http://localhost/ecommerce_php/" />
    <link rel="stylesheet" href="assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/admin/css/toastr.min.css">

    <script src="assets/admin/js/jquery.min.js"></script>
    <script src="assets/admin/js/popper.min.js"></script>
    <script src="assets/admin/js/bootstrap.min.js"></script>
    <script src="assets/admin/js/toastr.min.js"></script>
<!--         <link rel="stylesheet" href="assets/admin/css/bootstrap-select.min.css">
 -->    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--     <script src="assets/admin/js/bootstrap-select.min.js"></script>
 -->    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.min.css" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>
</head>
<body class="min-vh-100">
    <?php  
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="admin"><img src="assets/uploads/logo.png" alt="" style="width: 36px; height: 36px;" class="rounded-circle img-thumbnail"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav w-100">
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($url, 'admin/category')) ? 'active' : '' ?>" href="admin/category/index">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($url, 'admin/brand')) ? 'active' : '' ?>" href="admin/brand/index">Brand</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($url, 'admin/product')) ? 'active' : '' ?>" href="admin/product/index">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($url, 'admin/news')) ? 'active' : '' ?>" href="admin/news/index">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($url, 'admin/slider')) ? 'active' : '' ?>" href="admin/slider/index">Slider</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($url, 'admin/user')) ? 'active' : '' ?>" href="admin/user/index">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($url, 'admin/news-comment')) ? 'active' : '' ?>" href="admin/news-comment/index">Comment News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($url, 'admin/product-comment')) ? 'active' : '' ?>" href="admin/product-comment/index">Comment Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($url, 'admin/contact')) ? 'active' : '' ?>" href="admin/contact/index">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($url, 'admin/checkout')) ? 'active' : '' ?>" href="admin/checkout/index">Check Out</a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost/ecommerce_php/admin/logout.html" class="nav-link text-light"><span><i class="fa fa-power-off"></i></span>&nbsp;Logout</a>
                    </li>
                </ul>
            </div>
        </nav>   
    </header>