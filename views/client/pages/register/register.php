<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - Ecommerce PHP</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="http://localhost/ecommerce_php/" />
    <link rel="stylesheet" href="assets/client/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/client/css/toastr.min.css">
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
				<h2 class="text-center mb-3">Register System</h2>
				<div class="dropdown-divider mb-5"></div>
				<form method="POST" id="register_form">
				    <div class="form-group">
				        <label for="username">Email :</label>
				        <input type="email" class="form-control" name="email" placeholder="Enter email ..." required>
				        <div id="email_error">
						  	
						</div>
				    </div>
				    <div class="form-group">
				        <label for="password">Password :</label>
				        <input type="password" class="form-control" name="password" placeholder="Enter password ..." required>
				        <div id="password_error">
						  	
						</div>
				    </div>
				    <div class="form-group">
				        <label for="repeat_password">Repeat Password :</label>
				        <input type="password" class="form-control" name="repeat_password" placeholder="Enter repeat password ..." required>
				        <div id="repeat_password_error">
						  	
						</div>
				    </div>
				    <button type="submit" class="btn btn-light font-weight-bolder">REGISTER</button>
				    <p class="font-italic font-weight-normal mt-3">Do you already have an account? <a href="login.html"><button type="button" class="badge badge-light">LOGIN</button></a></p>
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
    		$('#register_form').on('submit', function(event){
    			event.preventDefault();
    			$('#email_error').html('');
    			$('#password_error').html('');
    			$('#repeat_password_error').html('');
    			
    			var register_data = $(this).serializeArray();

    			var data = {};
    			$.each(register_data, function(key,value){
    				data[value.name] = value.value;
    			});
    			if(data['password'].length < 8 || data['password'] > 255)
    			{
    				let html = '';
    				html += '<div class="alert alert-danger">';
						html += 'Mật khẩu phải có độ dài từ 8 đến 255 ký tự !'; 	
					html += '</div>';

    				$('#password_error').html(html);
    			}
    			else if(data['repeat_password'].length < 8)
    			{
    				let html = '';
    				html += '<div class="alert alert-danger">';
						html += 'Mật khẩu phải có độ dài từ 8 đến 255 ký tự !'; 	
					html += '</div>';

    				$('#repeat_password_error').html(html);
    			}
    			else if(data['password'] != data['repeat_password'])
    			{
    				let html = '';
    				html += '<div class="alert alert-danger">';
						html += 'Mật khẩu nhập lại sai !'; 	
					html += '</div>';

    				$('#repeat_password_error').html(html);
    			} 
    			else
    			{
    				$.ajax({
    					url : 'register_post.html',
    					type : 'POST',
    					data : {
    						email : data['email'],
    						password : data['password']
    					},
    					dataType : 'JSON',
    					success : function(result){
    						console.log(result);
    						if(result.res_type == 'error')
    						{
    							let html = '';
			    				html += '<div class="alert alert-danger">';
									html += result.response; 	
								html += '</div>';

			    				$('#email_error').html(html);
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