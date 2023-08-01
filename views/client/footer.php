    <?php  
    if(isset($user))
    {
        if($user != 0)
        {
        require_once 'cart.php';
        $check_user_cart = 1;
        }
        else 
        {
        $check_user_cart = 0;  
        }
    }
    ?>
    <footer>
        <input type="hidden" id="check_user_cart" value="<?= $check_user_cart ?>">
        <div class="container-fluid bg-dark mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mt-3">
                        <p>&copy; 2019 Vietnam . Design by <span class="text-info">Tony Tran</span></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript">


    $(document).ready(function(){

        function product_info(product_id)
        {
            var product_info;
            $.ajax({
                async: false,
                url : 'product_info.html',
                type : 'POST',
                data : {
                    product_id : product_id
                },
                dataType : 'JSON',
                success : function(result){
                    product_info = result;
                }
            });

            return product_info;
        }

        function show_cart_check_out(cart_customer_id)
        {
            $.ajax({
                url : 'show_cart.html',
                type : 'POST',
                data : {
                    cart_customer_id : cart_customer_id
                },
                dataType : 'JSON',
                success : function(result)
                {
                    var total = 0;
                    var html = '';
                    var count_cart = 0;
                    $.each(result, function(key, value){
                        count_cart ++;
                        html += '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                            html += '<div>';
                                html += '<span class="text-info">' + product_info(value.product_id).name + '</span>';
                                html += '<br>';
                                html += '<span class="badge badge-secondary badge-pill">' + value.quantity + '</span>';
                            html += '</div>';
                            if(product_info(value.product_id).discount_status == 1)
                            {
                                var price = product_info(value.product_id).discount_price;
                            }
                            else
                            {
                                var price = product_info(value.product_id).price;
                            }
                            total += price*value.quantity;
                            html += '<span class="text-muted">' + price + '</span>';
                        html += '</li>';
                    });
                    html += '<li class="list-group-item d-flex justify-content-between">';
                        html += '<span>Total (USD)</span>';
                        html += '<strong id="cart_total_check_out">' + total + '</strong>';
                    html += '</li>';

                    $('#count_cart_check_out').html(count_cart);
                    $('#show_cart_check_out').html(html);
                }
            });
        }
        
        function show_cart(cart_customer_id)
        {
            $.ajax({
                url : 'show_cart.html',
                type : 'POST',
                data : {
                    cart_customer_id : cart_customer_id
                },
                dataType : 'JSON',
                success : function(result)
                {
                    var total = 0;
                    var html = '';
                    var count_cart = 0;
                    $.each(result, function(key, value){
                        count_cart ++;
                        html += '<tr>';
                        html += '<td class="w-25">';
                            html += '<img src="assets/uploads/products/thumbnails/' + product_info(value.product_id).thumbnail + '" class="img-fluid img-thumbnail">';
                        html += '</td>';
                        html += '<td>' + product_info(value.product_id).name + '</td>';
                        if(product_info(value.product_id).discount_status == 1)
                        {
                            var price = product_info(value.product_id).discount_price;
                        }
                        else
                        {
                            var price = product_info(value.product_id).price;
                        }

                        html += '<td>' + price + '</td>';
                        html += '<td class="w-25">';
                            html += '<div class="row">';
                            html += '<button class="badge badge-dark col-3" id="change_quantity" data-id="' + value.id + '" value="' + (parseInt(value.quantity)-1) + '"><span><i class="fa fa-minus"></i></span></button>';
                            // html += '<input type="number" class="col-6" name="qty" value ="' + value.quantity + '" min="1" max="' + product_info(value.product_id).quantity + '"/>';
                            html += '<span class="badge badge-light col-6">' + value.quantity + '</span>';
                            html += '<button class="badge badge-dark col-3" id="change_quantity" data-id="' + value.id + '" value="' + (parseInt(value.quantity)+1) + '"><span><i class="fa fa-plus"></i></span></button>';
                            html += '</div>';
                        html += '</td>';
                        total += price*value.quantity;
                        html += '<td>' + (price*value.quantity) + '</td>';
                        html += '<td>';
                            html += '<button class="btn btn-danger btn-sm" id="delete_product_cart" value="' + value.id + '">';
                                html += '<i class="fa fa-times"></i>';
                            html += '</button>';
                        html += '</td>';
                        html += '</tr>';
                    });
                    $('#count_cart').html(count_cart);
                    $('#show_cart').html(html);
                    console.log(result);
                    $('#cart_total').html(total);

                }
            });
        }


        var cart_customer_id = $('#cart_customer_id').val();
        console.log(cart_customer_id);
        show_cart(cart_customer_id);

        $(document).on('click', '#cart_product_id', function(){
            var check_user_cart = $('#check_user_cart').val();
            if(check_user_cart == 0)
            {
                toastr.error("Bạn phải đăng nhập mới thêm sản phẩm vào giỏ hàng !", 'Response',{timeOut: 200});
            }
            else
            {
                product_id = $(this).val();
                console.log(product_id);
                $.ajax({
                    url : 'add_to_cart.html',
                    type : 'POST',
                    data : {
                        product_id : product_id
                    },
                    dataType : 'JSON',
                    success : function(result){
                        if(result.res_type == 'success')
                        {
                            toastr.success(result.response, 'Response',{timeOut: 200});
                            show_cart(cart_customer_id);
                            show_cart_check_out(cart_customer_id)
                        }
                        else
                        {
                            toastr.error(result.response, 'Response',{timeOut: 200});
                        }
                    }                    
                });
            }
        });

        $(document).on('click', '#delete_product_cart', function(){
            var order_detail_id = $(this).val();
            $.ajax({
                url : 'delete_product_cart.html',
                type : 'POST',
                data : {
                    order_detail_id : order_detail_id
                },
                dataType : 'JSON',
                success : function(result){
                    if(result.res_type == 'success')
                    {
                        toastr.success(result.response, 'Response',{timeOut: 200});
                        show_cart(cart_customer_id);
                        show_cart_check_out(cart_customer_id)
                    }
                    else
                    {
                        toastr.error("Xóa sản phẩm trong giỏ hàng không thành công !", 'Response',{timeOut: 200});
                    }
                }
            });
        });

        $(document).on('click', '#change_quantity', function(){
            var change_quantity = $(this).val();
            var order_detail_id = $(this).data('id');
            console.log(order_detail_id);
            console.log(change_quantity);
            if(change_quantity == 0)
            {
                toastr.error("Số lượng tối thiểu là 1, nếu bạn không mua bạn có thể Xóa sản phẩm trong giỏ hàng !", 'Response',{timeOut: 200});
            }
            else
            {
                $.ajax({
                    url : 'update_quantity_order_detail.html',
                    type : 'POST',
                    data : {
                        order_detail_id : order_detail_id,
                        change_quantity : change_quantity
                    },
                    dataType : 'JSON',
                    success : function(result){
                        if(result.res_type == 'success')
                        {
                            toastr.success(result.response, 'Response',{timeOut: 400});
                            show_cart(cart_customer_id);
                            show_cart_check_out(cart_customer_id)
                        }
                        else
                        {
                            toastr.error(result.response, 'Response',{timeOut: 400});
                        }
                    }
                });
            }
        });


        $('#search_form').on('submit', function(event){
            event.preventDefault();
            data_search = $(this).serializeArray();
            console.log(data_search);
            $.each(data_search, function(key,value){
                key_word = value.value;
            });
            console.log(key_word);
            url = 'search.html/' + key_word;
            $(location).attr('href', url);
        });

    });
    </script>
</body>
</html>