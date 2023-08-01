<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Ecommerce PHP</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="http://localhost/ecommerce_php/" />
    <link rel="stylesheet" href="assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/admin/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body class="bg-dark h-100">
	    <header class="sticky-top">
        <div class="container-fluid bg-dark">
            <div class="container">
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
                            </div>
                        </nav>
                    </div>
                </div>            
            </div>
        </div>
    </header>
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-6 text-center mt-5 p-5">
				<div class="row mb-5">
					<div class="col-12">
						<img src="assets/uploads/logo.png" alt="" class="w-75 rounded-circle">				
					</div>
				</div>
				<span class="text-light font-weight-bolder h5">Ecommerce PHP</span>
			</div>
			<div class="col-md-6 text-light font-weight-bolder mt-5">
				<h2 class="text-center mb-3">Login System</h2>
				<div class="dropdown-divider mb-5"></div>
				<form action="" method="POST" id="login_form">
				    <div class="form-group">
				        <label for="email">Email :</label>
				        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email ..." required>
                        <div id="email_error">
                            
                        </div>
				    </div>
				    <div class="form-group">
				        <label for="password">Password :</label>
				        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password ..." required>
                        <div id="password_error">
                            
                        </div>
				    </div>
				    <div class="form-group form-check">
				        <label class="form-check-label">
				            <input class="form-check-input" type="checkbox" name="remember"> Remember me
				        </label>
				    </div>
				    <button type="submit" class="btn btn-light">LOGIN</button>
				    <p class="font-italic font-weight-normal mt-3">Do not have an account? <a href="register.html"><button type="button" class="badge badge-light">REGISTER</button></a></p>
				</form>
			</div>
		</div>
	</div>
	   
	<script src="assets/admin/js/jquery.min.js"></script>
    <script src="assets/admin/js/popper.min.js"></script>
    <script src="assets/admin/js/bootstrap.min.js"></script>
    <script src="assets/admin/js/toastr.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#login_form').on('submit', function(event){
                event.preventDefault();
                $('#email_error').html('');
                $('#password_error').html('');
                
                var login_data = $(this).serializeArray();

                var data = {};
                $.each(login_data, function(key,value){
                    data[value.name] = value.value;
                });
                var length_data = Object.keys(data).length;
                if(length_data == 2)
                {
                    var remember = 0;
                }
                else if(length_data = 3)
                {
                    var remember = 1;
                }
                if(data['password'].length < 8 || data['password'] > 255)
                {
                    let html = '';
                    html += '<div class="alert alert-danger">';
                        html += 'Mật khẩu phải có độ dài từ 8 đến 255 ký tự !';     
                    html += '</div>';

                    $('#password_error').html(html);
                }
                else
                {
                    $.ajax({
                        url : 'login_post.html',
                        type : 'POST',
                        data : {
                            email : data['email'],
                            password : data['password'],
                            remember : remember
                        },
                        dataType : 'JSON',
                        success : function(result){
                            console.log(result);
                            if(result.res_type == 'error')
                            {
                                toastr.error(result.response, 'Response');
                            }
                            else if(result.res_type == 'success')
                            {
                                
                                toastr.success(result.response, 'Response');
                                setTimeout("$(location).attr('href', 'index.html');",500);
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>