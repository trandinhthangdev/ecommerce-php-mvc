<?php  
$name = $customer[0]['name'];
$address = $customer[0]['address'];
$phone = $customer[0]['phone'];

?>
<div class="container text-dark">
	<div class="row mt-4">
		<div class="col-12">
			<nav aria-label="breadcrumb" class="font-weight-bolder">
                <ol class="breadcrumb p-3">
                    <li class=" text-dark font-weight-bolder breadcrumb-item active" style="font-size: 28px;" aria-current="page">Check out
                    </li>
                </ol>
            </nav>
		</div>
	</div>
	<div class="row mt-4" id="check_out_show">
		<div class="col-md-8 mt-4">
			<div class="row">
				<div class="col-12">
		            <nav aria-label="breadcrumb" class="font-weight-bolder">
		                <ol class="breadcrumb">
		                    <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Billing address
		                    </li>
		                </ol>
		            </nav>                  
		        </div>
		        <div class="col-12 font-weight-bolder">
		        	<form method="POST">
					    <div class="form-group">
					        <label for="name">Name :</label>
					        <input type="text" class="form-control" id="name" placeholder="Enter name ..." name="name" value="<?= $name ?>">
					    </div>
					    <div class="form-group">
					        <label for="address">Address :</label>
					        <input type="text" class="form-control" id="address" placeholder="Enter address ..." name="address" value="<?= $address ?>">
					    </div>
					    <div class="form-group">
					        <label for="phone">Phone :</label>
					        <input type="text" class="form-control" id="phone" placeholder="Enter phone ..." name="phone" value="<?= $phone ?>">
					    </div>
					    <button type="button" class="btn btn-dark" id="check_out_btn">Buy It Now</button>
					</form>
		        </div>
			</div>
		</div>
		<div class="col-md-4 mt-4">
			<div class="row">
				<div class="col-12">
		            <nav aria-label="breadcrumb" class="font-weight-bolder">
		                <ol class="breadcrumb">
		                    <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">
								Your cart 
								<span class="badge badge-secondary badge-pill" id="count_cart_check_out"></span>
		                    </li>
		                </ol>
		            </nav>                  
		        </div>
		        <div class="col-12 font-weight-bolder">
		        	<ul class="list-group mb-3 " id="show_cart_check_out">
					    
					</ul>
		        </div>
			</div>
		</div>
	</div>
</div>

<script src="assets/admin/js/html2canvas.js"></script>
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
		
		var cart_customer_id = $('#cart_customer_id').val();
		show_cart_check_out(cart_customer_id);

		$('#check_out_btn').click(function(){
			var count_cart_check_out = $('#count_cart_check_out').html();
			console.log(count_cart_check_out);
			if(count_cart_check_out == '0')
			{
				toastr.error("Giỏ hàng bạn trống !", 'Response',{timeOut: 200});
			}
			else
			{
				var check_out_show = $('#check_out_show').html();
				console.log(check_out_show);
				$.ajax({
					url : 'check_out_show.html',
					type : 'POST',
					data : {
						check_out_show : check_out_show
					}
				});

				$.ajax({
					url : 'check_out_success.html',
					dataType : 'text',
					success : function(result){
						toastr.success(result, 'Response',{timeOut: 400});
						setTimeout('location.reload();', 400);
					}
				});
			}



   		});

	});
</script>