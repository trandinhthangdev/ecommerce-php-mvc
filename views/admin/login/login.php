<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Admin Ecommerce PHP</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="http://localhost/ecommerce_php/" />
    <link rel="stylesheet" href="assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/admin/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body class="bg-dark h-100">
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12 text-light font-weight-bolder mt-5">
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
				    <button type="submit" class="btn btn-light">LOGIN</button>
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
                    console.log(data['email'] + data['password']);
                    $.ajax({
                        url : 'admin/login_post.html',
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
                                toastr.error(result.response, 'Response');
                            }
                            else if(result.res_type == 'success')
                            {
                                
                                toastr.success(result.response, 'Response');
                                setTimeout("$(location).attr('href', 'admin');",500);
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>