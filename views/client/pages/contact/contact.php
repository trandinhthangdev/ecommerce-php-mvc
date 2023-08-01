<div class="container mt-4">
    <h2 class="font-weight-bolder text-center text-dark">Contact Us</h2>
    <form action="" method="POST" id="contact_form">
        <div class="form-group">
            <label for="message" class="font-weight-bolder text-dark">Message</label>
            <textarea class="form-control" rows="24" name="message" id="message" required></textarea>
            <div id="contact_error">
                
            </div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <?php  
                if(isset($user))
                {
                    if($user != 0)
                    {
                        $check = 1;
                        $user_id = $user['id'];
                        $customer = $this->customer->where('user_id = ' . $user_id);
                        $customer_id = $customer[0]['id'];
                ?>
                <input type="hidden" value="<?= $customer_id ?>" id="customer_id" >
                <?php
                    }
                    else
                    {
                        $check = 0;
                    }
                }
                ?>
                <button type="submit" class="btn btn-dark form-control font-weight-bolder" id="contact_btn" value="<?= $check ?>">Send Us</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#contact_form').on('submit', function(event){
            event.preventDefault();
            var check = $('#contact_btn').val();
            if(check != 0)
            {
                var customer_id = $('#customer_id').val();
                var data_contact = $(this).serializeArray();
                $.each(data_contact, function(key, value){
                    message = value.value;
                });
               
                $.ajax({
                    url : 'contact_post.html',
                    type : 'POST',
                    data : {
                        customer_id : customer_id,
                        message : message
                    },
                    dataType : 'text',
                    success : function(result){
                        $('#message').val('');
                        toastr.success(result, 'Response',{timeOut: 200});
                    }
                });
            }
            else
            {
                toastr.error("Bạn chưa đăng nhập, Bạn không thể gửi cho chúng tôi !", 'Response',{timeOut: 200});
            }
            
        });
    });
</script>
