<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="row mt-4">
				<div class="col-lg-6">
					<div class="slider">
					    <div id="demo" class="carousel slide" data-ride="carousel">
					        <!-- Indicators -->
					        <ul class="carousel-indicators">
					            <?php  
					            $i = 0;
					            $count_slider = count($product_slider);
					            while ($count_slider) {
					                if($i==0)
					                {
					            ?>
					            <li data-target="#demo" data-slide-to="0" class="active"></li>
					            <?php
					                } 
					                else 
					                {
					            ?>
					            <li data-target="#demo" data-slide-to="<?= $i+1 ?>"></li>
					            <?php          
					                }  
					                $i++;
					                $count_slider--;
					            }
					            ?>
					            
					        </ul>

					        <!-- The slideshow -->
					        <div class="carousel-inner">
					            <?php  
					            $i = 0;
					            foreach ($product_slider as $prs) {
					                if($i==0)
					                {
					            ?>
					            <div class="carousel-item active">
					                <img src="assets/uploads/products/sliders/<?= $prs['image'] ?>" style="width: 100%; height: 100%;">
					            </div>
					            <?php
					                } 
					                else 
					                {
					            ?>
					            <div class="carousel-item">
					                <img src="assets/uploads/products/sliders/<?= $prs['image'] ?>" style="width: 100%; height: 100%;">
					            </div>
					            <?php          
					                }  
					                $i++;
					            }    
					            ?>
					        </div>

					        <!-- Left and right controls -->
					        <a class="carousel-control-prev" href="#demo" data-slide="prev">
					            <span class="carousel-control-prev-icon"></span>
					        </a>
					        <a class="carousel-control-next" href="#demo" data-slide="next">
					            <span class="carousel-control-next-icon"></span>
					        </a>

					    </div>
					</div>
				</div>
				<div class="col-lg-6 text-dark">
					<span class="font-weight-bolder" style="font-size: 24px;"><?= $product['name'] ?></span>
					<br>
					<?php  
                        if($product['discount_status'])
                        {
                        ?>
                        <span class="font-italic text-info font-weight-bolder"><?= $product['discount_price'] ?> Đ</span>
                        <span class="font-italic text-info font-italic font-weight-light" style="text-decoration: line-through;"><?= $product['price'] ?> Đ</span>
                        <?php    
                        }
                        else
                        {
                        ?>
                        <span class="font-italic text-info font-weight-bolder"><?= $product['price'] ?> Đ</span>
                        <?php    
                        }
                        ?>
					<br>
					<span class="font-weight-bolder">Description</span>
					<br>
					<span class="font-italic">
						<?= $product['description'] ?>
					</span>
					<br>
					<button class="btn btn-dark font-weight-bolder" id="cart_product_id" value="<?= $product['id'] ?>"><span><i class="fa fa-cart-plus"></i></span> Add To Cart</button>
				</div>
			</div>
			<div class="row mt-4 text-dark">
				<div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Products Details</li>
	                    </ol>
	                </nav>                
	            </div>
				<div class="col-12 overflow-hidden p-2">
					<?= $product['content'] ?>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Reviews</li>
	                    </ol>
	                </nav>
	                <div class="row text-dark">
	                	<div class="col-12">
			                <div class="row">
			                    <div class="col-xs-12 col-md-6 text-center">
			                        <h1 class="rating-num"><?= $product['star'] ?></h1>
			                        <div class="rating">
			                        	<?php  
	                                    $star = $product['star'];
	                                    $star_round = round($star);
	                                    ?>
	                                    <span><i class="fa fa-star <?= ($star >= 1) ? 'text-info' : '' ?>"></i></span>
	                                    <span><i class="fa fa-star <?= ($star >= 2) ? 'text-info' : '' ?>"></i></span>
	                                    <span><i class="fa fa-star <?= ($star >= 3) ? 'text-info' : '' ?>"></i></span>
	                                    <span><i class="fa fa-star <?= ($star >= 4) ? 'text-info' : '' ?>"></i></span>
	                                    <span><i class="fa fa-star <?= ($star == 5) ? 'text-info' : '' ?>"></i></span>
			                        </div>
			                        <div>
			                            <span class="glyphicon glyphicon-user"></span><?= $count_product_star ?> total
			                        </div>
			                    </div>
			                    <div class="col-xs-12 col-md-6">
			                        <div class="row rating-desc">
			                            <div class="col-xs-2 col-md-2 text-right">
			                                <span><i class="fa fa-star text-info"></i></span> 5
			                            </div>
			                            <div class="col-xs-7 col-md-8">
			                                <div class="progress progress-striped">
			                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
			                                        aria-valuemin="0" aria-valuemax="100" style="width: <?= ($count_five_star*100)/$count_product_star .'%' ?>">
			                                        <span class="sr-only"><?= ($count_five_star*100)/$count_product_star .'%' ?></span>		                              
			                                    </div>			     
			                                </div>
			                            </div>
										<div class="col-xs-1 col-md-1">
											<span class="badge badge-dark badge-pill"><?= $count_five_star ?></span>
										</div>
			                            <!-- end 5 -->
			                            <div class="col-xs-2 col-md-2 text-right">
			                                <span><i class="fa fa-star text-info"></i></span> 4
			                            </div>
			                            <div class="col-xs-7 col-md-8">
			                                <div class="progress">
			                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
			                                        aria-valuemin="0" aria-valuemax="100" style="width: <?= ($count_four_star*100)/$count_product_star .'%' ?>">
			                                        <span class="sr-only"><?= ($count_four_star*100)/$count_product_star .'%' ?></span>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="col-xs-1 col-md-1">
											<span class="badge badge-dark badge-pill"><?= $count_four_star ?></span>
										</div>
			                            <!-- end 4 -->
			                            <div class="col-xs-2 col-md-2 text-right">
			                                <span><i class="fa fa-star text-info"></i></span> 3
			                            </div>
			                            <div class="col-xs-7 col-md-8">
			                                <div class="progress">
			                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
			                                        aria-valuemin="0" aria-valuemax="100" style="width: <?= ($count_three_star*100)/$count_product_star .'%' ?>">
			                                        <span class="sr-only"><?= ($count_three_star*100)/$count_product_star .'%' ?></span>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="col-xs-1 col-md-1">
											<span class="badge badge-dark badge-pill"><?= $count_three_star ?></span>
										</div>
			                            <!-- end 3 -->
			                            <div class="col-xs-2 col-md-2 text-right">
			                                <span><i class="fa fa-star text-info"></i></span> 2
			                            </div>
			                            <div class="col-xs-7 col-md-8">
			                                <div class="progress">
			                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
			                                        aria-valuemin="0" aria-valuemax="100" style="width: <?= ($count_two_star*100)/$count_product_star .'%' ?>">
			                                        <span class="sr-only"><?= ($count_two_star*100)/$count_product_star .'%' ?></span>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="col-xs-1 col-md-1">
											<span class="badge badge-dark badge-pill"><?= $count_two_star ?></span>
										</div>
			                            <!-- end 2 -->
			                            <div class="col-xs-2 col-md-2 text-right">
			                                <span><i class="fa fa-star text-info"></i></span> 1
			                            </div>
			                            <div class="col-xs-7 col-md-8">
			                                <div class="progress">
			                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
			                                        aria-valuemin="0" aria-valuemax="100" style="width: <?= ($count_one_star*100)/$count_product_star .'%' ?>">
			                                        <span class="sr-only"><?= ($count_one_star*100)/$count_product_star .'%' ?></span>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="col-xs-1 col-md-1">
											<span class="badge badge-dark badge-pill"><?= $count_one_star ?></span>
										</div>
			                            <!-- end 1 -->
			                        </div>
			                        <!-- end row -->
			                    </div>
			                    <input type="hidden" id="customer_id" value="<?= ($user != 0) ? $customer_id : ''?>">
<!-- 			                    <div id="view_avaluate_product" class="col-12">
			                    	
			                    </div> -->
			                    <div class="col-12 text-center m-3 p-3">
		                    		<span class="font-weight-bolder pb-2 border-bottom">Đánh giá sản phẩm bạn đã mua</span><br>
		                    	</div>
			                 	<div class="col-12 text-center" style="font-size: 48px;">
									<button class="btn btn-light avaluate_product" value="1" ><span class="fa fa-star"></span></button>
									<button class="btn btn-light avaluate_product" value="2" ><span class="fa fa-star"></span></button>
									<button class="btn btn-light avaluate_product" value="3" ><span class="fa fa-star"></span></button>
									<button class="btn btn-light avaluate_product" value="4" ><span class="fa fa-star"></span></button>
									<button class="btn btn-light avaluate_product" value="5" ><span class="fa fa-star"></span></button>
								</div>
			                </div>
				        </div>
	                </div>                
	            </div>
			</div>
			<div class="row mt-4">
				<div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Comments</li>
	                    </ol>
	                </nav>                
	            </div>
	            <div class="col-12">
	            	<form action="" method="POST" id="comment_form">
		            	<div class="form-group">
		            		<textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
		            	</div>
		            	<input type="hidden" value="<?= $product['id'] ?>" id="product_id">
		            	<button type="submit" class="form-control btn btn-dark" value="">Send Comment</button>
		            </form>
	            </div>
	            <div class="m-2" id="view_product_comments">
	            	
	            </div>
				<div class="col-12 text-center">
					<button class="btn btn-dark" id="product_comments_load_more" value="1">Load More</button>
				</div>
			</div>
			<div class="row mt-4">
	            <div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Related Products</li>
	                    </ol>
	                </nav>                
	            </div>
		        <div class="col-12">
			        <div class="row">
			        	<?php 
			            foreach ($related_products as $rep) {
			            ?>
			            <div class="col-md-6 col-lg-4 mb-3">
			                <div class="card text-dark">
			                    <a href="product_detail.html/<?= $rep['id'] ?>-<?= $rep['slug'] ?>">
			                        <img class="card-img-top" src="assets/uploads/products/thumbnails/<?= $rep['thumbnail'] ?>" alt="">              
			                    </a>
			                    <div class="card-body">
			                        <a href="product_detail.html/<?= $rep['id'] ?>-<?= $rep['slug'] ?>" class="text-decoration-none">
			                            <span class="card-title font-weight-bolder text-info">
			                            <?= $rep['name'] ?>
			                        </span>
			                        </a>
			                        <br>
			                        <?php  
			                        if($rep['discount_status'])
			                        {
			                        ?>
			                        <span class="font-italic text-dark font-weight-bolder"><?= $rep['discount_price'] ?></span>
			                        <span class="font-italic text-dark font-italic font-weight-light" style="text-decoration: line-through;"><?= $rep['price'] ?></span>
			                        <?php    
			                        }
			                        else
			                        {
			                        ?>
			                        <span class="font-italic text-dark font-weight-bolder"><?= $rep['price'] ?></span>
			                        <?php    
			                        }
			                        ?>
			                        
			                    </div>
			                    <div class="card-footer">
			                        <div class="row">
			                            <div class="col-8">
			                                <small class="text-muted" style="font-size: 17px;">
			                                    <?php  
			                                    $star = $rep['star'];
			                                    $star_round = round($star);
			                                    ?>
			                                    <span><i class="fa fa-star <?= ($star >= 1) ? 'text-info' : '' ?>"></i></span>
			                                    <span><i class="fa fa-star <?= ($star >= 2) ? 'text-info' : '' ?>"></i></span>
			                                    <span><i class="fa fa-star <?= ($star >= 3) ? 'text-info' : '' ?>"></i></span>
			                                    <span><i class="fa fa-star <?= ($star >= 4) ? 'text-info' : '' ?>"></i></span>
			                                    <span><i class="fa fa-star <?= ($star == 5) ? 'text-info' : '' ?>"></i></span>
			                                </small>
			                            </div>
			                            <div class="col-4 text-center">
			                                <button class="btn btn-dark" id="cart_product_id" value="<?= $fep['id'] ?>"><span><i class="fa fa-cart-plus"></i></span></button>
			                            </div> 
			                        </div>       
			                    </div>
			                </div>
			            </div>            
			            <?php
			            }
		            	?>
			        </div>
		        </div>
			</div>
		</div>
		<div class="col-md-4">
			<div id="featured-products" class="mt-4">
			    <div class="container">
			        <div class="row">
			            <div class="col-12">
			                <nav aria-label="breadcrumb" class="font-weight-bolder">
			                    <ol class="breadcrumb">
			                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Featured Products</li>
			                    </ol>
			                </nav>                
			            </div>
			        </div>
			        <div class="row">
			        	<?php 
			            foreach ($featured_products as $fep) {
			            ?>
			            <div class="col-12 mb-3">
			                <div class="card text-dark">
			                    <a href="product_detail.html/<?= $fep['id'] ?>-<?= $fep['slug'] ?>">
			                        <img class="card-img-top" src="assets/uploads/products/thumbnails/<?= $fep['thumbnail'] ?>" alt="" style="position: relative;">              
			                    </a>
			                    <div class="card-body">
			                        <a href="product_detail.html/<?= $fep['id'] ?>-<?= $fep['slug'] ?>" class="text-decoration-none">
			                            <span class="card-title font-weight-bolder text-info">
			                            <?= $fep['name'] ?>
			                        </span>
			                        </a>
			                        <br>
			                        <?php  
			                        if($fep['discount_status'])
			                        {
			                        ?>
			                        <span class="font-italic text-dark font-weight-bolder"><?= $fep['discount_price'] ?></span>
			                        <span class="font-italic text-dark font-italic font-weight-light" style="text-decoration: line-through;"><?= $fep['price'] ?></span>
			                        <?php    
			                        }
			                        else
			                        {
			                        ?>
			                        <span class="font-italic text-dark font-weight-bolder"><?= $fep['price'] ?></span>
			                        <?php    
			                        }
			                        ?>
			                        
			                    </div>
			                    <div class="card-footer">
			                        <div class="row">
			                            <div class="col-8">
			                                <small class="text-muted" style="font-size: 17px;">
			                                    <?php  
			                                    $star = $fep['star'];
			                                    $star_round = round($star);
			                                    ?>
			                                    <span><i class="fa fa-star <?= ($star >= 1) ? 'text-info' : '' ?>"></i></span>
			                                    <span><i class="fa fa-star <?= ($star >= 2) ? 'text-info' : '' ?>"></i></span>
			                                    <span><i class="fa fa-star <?= ($star >= 3) ? 'text-info' : '' ?>"></i></span>
			                                    <span><i class="fa fa-star <?= ($star >= 4) ? 'text-info' : '' ?>"></i></span>
			                                    <span><i class="fa fa-star <?= ($star == 5) ? 'text-info' : '' ?>"></i></span>
			                                </small>
			                            </div>
			                            <div class="col-4 text-center">
			                                <button class="btn btn-dark" id="cart_product_id" value="<?= $fep['id'] ?>"><span><i class="fa fa-cart-plus"></i></span></button>
			                            </div> 
			                        </div>       
			                    </div>
			                </div>
			            </div>            
			            <?php
			            }
			            ?>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		function view_name_customer(customer_id)
		{
			var name_customer = 'Anonymous';
			$.ajax({
                async: false,
                url : 'view_name_customer.html',
                type : 'POST',
                data : {
                    customer_id : customer_id
                },
                dataType : 'text',
                success : function(result){
                	if(result != '')
                	{
                		name_customer = result;
                	}
                }
            });
			return name_customer;
		}

		function product_comments_load_more(start, offset)
		{
			var product_id = $('#product_id').val();
			$.ajax({
				url : 'product_comments_load_more.html',
				type : 'POST',
				data : {
					product_id : product_id,
					start : start,
					offset : offset
				},
				dataType : 'JSON',
				success : function(result){
					let html = '';
					if(result.length > 0 )
					{
						$.each(result, function(key, value){
							var customer_id = value.customer_id;
							var name_customer = view_name_customer(customer_id);
							html += '<div class="col-12 mt-2 mb-2 text-dark">';
				            	html += '<span class="font-weight-bolder"><span class="m-3"><i class="fa fa-user"></i></span>' + name_customer + '</span>';
				            	html += '<br>';
				            	html += '<span class="font-italic pl-5">' + value.content + '</span>';
				            html += '</div>';
						});
					}
					else
					{
						html += '<span class="font-weight-bolder text-dark">Unable To Load More</span>';
                        $('#product_comments_load_more').val(0);
					}

					$('#view_product_comments').append(html);
				}
			});
		}

		function product_comments_reload(start, offset)
		{
			var product_id = $('#product_id').val();
			$.ajax({
				url : 'product_comments_load_more.html',
				type : 'POST',
				data : {
					product_id : product_id,
					start : start,
					offset : offset
				},
				dataType : 'JSON',
				success : function(result){
					let html = '';
					$.each(result, function(key, value){
						var customer_id = value.customer_id;
						var name_customer = view_name_customer(customer_id);
						html += '<div class="col-12 mt-2 mb-2 text-dark">';
			            	html += '<span class="font-weight-bolder"><span class="m-3"><i class="fa fa-user"></i></span>' + name_customer + '</span>';
			            	html += '<br>';
			            	html += '<span class="font-italic pl-5">' + value.content + '</span>';
			            html += '</div>';
					});

					$('#view_product_comments').html(html);
				}
			});
		}




		var start = 0;
        var offset = 4;
        product_comments_load_more(start, offset);

        $('#product_comments_load_more').on('click', function(){
            let val_product_comments_load_more = $(this).val();
            if(val_product_comments_load_more != 0)
            {
                start = start + 4;            
                product_comments_load_more(start, offset);
            }
        });


		$('#comment_form').on('submit', function(event){
			event.preventDefault();
			check_user_login = $('#check_user_login').val();
			if(check_user_login == '0')
			{
				toastr.error("Bạn phải đăng nhập mới bình luận được !", 'Response',{timeOut: 200});
			}
			else
			{
				data_comment = $(this).serializeArray();
				$.each(data_comment, function(key, value){
					comment = value.value;
				});
				var product_id = $('#product_id').val();
				$.ajax({
					url : 'send_comment_product.html',
					type : 'POST',
					data : {
						comment : comment,
						product_id : product_id
					},
					dataType : 'text',
					success : function(result){
						$('#comment').val('');
						toastr.success(result, 'Response',{timeOut: 200});
						product_comments_reload(0,4);
					}
				});
			}
		});

		

		$('.avaluate_product').click(function(){
			console.log($(this).val());
			var number_star = $(this).val();
			var product_id = $('#product_id').val();
			var customer_id = $('#customer_id').val();
			if(customer_id == '')
			{
				toastr.error("Bạn phải đăng nhập mới đánh giá được sản phẩm !", 'Response',{timeOut: 200});
			}
			console.log(number_star);
			$.ajax({
				url : 'avaluate_product.html',
				type : 'POST',
				data : {
					customer_id : customer_id,
					product_id : product_id,
					number_star : number_star
				},
				dataType : 'JSON',
				success : function(result){
					if(result.res_type == 'success')
					{
						toastr.success(result.response, 'Response',{timeOut: 200});
					}
					else
					{
						toastr.error(result.response, 'Response',{timeOut: 200});
					}
				}
			});
		});



	});
</script>