<!DOCTYPE html>
<html lang="en">
<head>
    <title>Client - Ecommerce PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="http://localhost/ecommerce_php/" />
    <link rel="stylesheet" href="assets/client/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/client/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/client/js/jquery.min.js"></script>
    <script src="assets/client/js/popper.min.js"></script>
    <script src="assets/client/js/bootstrap.min.js"></script>
    <script src="assets/client/js/toastr.min.js"></script>
    
</head>
<body style="color: #f8f8f8;">
    <?php  
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <header class="sticky-top">
        <div class="container-fluid bg-dark">
            <div class="container">
                <div class="row">           
                    <div class="col-6 text-center">
                        <?php  
                        if(isset($user))
                        {
                            if($user != 0)
                            {
                        ?>
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#cartModal">
                            <span><i class="fa fa-shopping-cart"></i></span>
                            <span class="badge badge-light badge-pill" id="count_cart"></span>
                        </button> 
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-6 text-center">
                        <?php  
                        if(isset($user))
                        {
                            if($user != 0)
                            {
                        ?>
                        <div class="dropdown">
                            <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                                <span><i class="fa fa-user"></i></span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="profile.html">Profile Settings</a>
                                <a class="dropdown-item" href="logout.html"><span><i class="fa fa-sign-out"></i></span> Logout</a>
                            </div>
                        </div>
                        <input type="hidden" id="check_user_login" value="1">
                        
                        <?php
                            }
                            else
                            {
                        ?>
                        <a href="login.html"><button class="btn btn-dark"><span><i class="fa fa-sign-in"></i></span> Login</button></a>
                        <a href="register.html"><button class="btn btn-dark"><span><i class="fa fa-sign-in"></i></span> Register</button></a>
                        <input type="hidden" id="check_user_login" value="0">
                        <?php

                            }
                        }
                        ?>
                        
                    </div>                            
                </div> 
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark font-weight-bolder">
                            <a class="navbar-brand pr-2 border-right" href="index.html"><img src="assets/uploads/logo.png" alt="" style="width: 36px; height: 36px;" class="rounded-circle img-thumbnail"></a>
                            <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="false">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="navbar-collapse collapse" id="navb" style="">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item mt-2 <?= (strpos($url, 'product.html')) ? 'active' : '' ?>">
                                        <a class="nav-link" href="product.html">Products</a>
                                    </li>
                                    
                                    <li class="nav-item mt-2 <?= (strpos($url, 'news.html')) ? 'active' : '' ?>">
                                        <a class="nav-link" href="news.html">News</a>
                                    </li>
                                    <li class="nav-item mt-2 <?= (strpos($url, 'contact.html')) ? 'active' : '' ?>">
                                        <a class="nav-link" href="contact.html">Contact</a>
                                    </li>
                                    <li class="nav-item mt-2 <?= (strpos($url, 'about.html')) ? 'active' : '' ?>">
                                        <a class="nav-link" href="about.html">About</a>
                                    </li>
                                </ul>
                                <div class="col-lg-4 col-md-12">
                                    <form method="POST" class="input-group" id="search_form">
                                        <input type="text" name="key_word" class="form-control" placeholder="Enter Category ..." required value="<?= (isset($key_word)) ? $key_word : '' ?>">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info" id="btn_search"><span><i class="fa fa-search"></i></span> Search</button>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>            
            </div>
        </div>
    </header>
