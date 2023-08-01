<div class="container">
    <div class="row mt-5 font-weight-bolder">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row mt-5">

        <div class="col-6 font-weight-bolder">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">Admin</li>
                </ol>
            </nav>
        </div>
        <div class="col-6 font-weight-bolder text-right">
            <button class="btn btn-dark" data-toggle="modal" data-target="#create_admin_modal"><span><i class="fa fa-plus"></i></span></button>
        </div>
        <div class="col-12">
             <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Email</th>
                    </tr>                    
                </thead>
                <tbody>
                    <?php  
                    if(count($user) > 0)
                        {
                        $index = 0;
                        foreach ($user as $use) {
                            if($use['role'] == 1)
                            {
                            $index++;
                    ?>
                    <tr>
                        <td><?= $index ?></td>
                        <td><?= $use['email'] ?> 
                        </td>
                    </tr>
                    <?php 
                            }
                        }
                    }
                    else
                    {
                    ?>
                    <tr>
                        <td>Not Data</td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>       
        </div>
        <div class="col-6 font-weight-bolder">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">Customer</li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
             <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Email</th>
                        <th>Info</th>
                    </tr>                    
                </thead>
                <tbody>
                    <?php  
                    if(count($customer) > 0)
                        {
                        $index = 0;
                        foreach ($customer as $cus) {
                            $index++;
                    ?>
                    <tr>
                        <td><?= $index ?></td>
                        <td>
                        <?php 
                        foreach ($user as $use) {
                            if($use['id'] == $cus['user_id'])
                            {
                                echo $use['email'];
                            }
                        }
                        ?> 
                        </td>
                        <td>
                        <span class="font-weight-bolder">Name : </span>
                        <br>
                        <span class="font-italic"><?= $cus['name'] ?></span>
                        <hr>
                        <span class="font-weight-bolder">Address : </span>
                        <br>
                        <span class="font-italic"><?= $cus['address'] ?></span>
                        <hr>
                        <span class="font-weight-bolder">Phone : </span>
                        <br>
                        <span class="font-italic"><?= $cus['phone'] ?></span>
                        </td>
                    </tr>
                    <?php 
                        }
                    }
                    else
                    {
                    ?>
                    <tr>
                        <td>Not Data</td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>       
        </div>

    </div>
</div>

<!-- The Modal -->
<div class="modal" id="create_admin_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Admin</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body font-weight-bolder">
                <form method="POST" id="create_admin_form">
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
                    <button type="submit" class="btn btn-dark font-weight-bolder">Create Admin</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#create_admin_form').on('submit', function(event){
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
                url : 'admin/user/create_admin',
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
                        setTimeout("location.reload();",500);
                    }
                }
            });
        }
    });
});    
</script>
