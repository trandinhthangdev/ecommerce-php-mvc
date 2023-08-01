<div class="container">
	<div class="row">
		<div class="col-md-8 mt-4">
			<div class="col-12">
                <nav aria-label="breadcrumb" class="font-weight-bolder">
                    <ol class="breadcrumb">
                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page"><?= $news['title'] ?>
                        </li>
                    </ol>
                </nav>                
            </div>
            <div class="row text-dark">
            	<div class="col-12 overflow-hidden">
            		<?= $news['content'] ?>
            	</div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="col-12">
			    <ul class="list-inline">
			        <li class="list-inline-item text-info mr-5"><span><i class="fa fa-eye"></i></span><span id="count_views"></span> <?= $news['view'] ?> Views</li>
			        <li class="list-inline-item text-success"><span><i class="fa fa-comments"></i></span><span id="count_comments"></span> Comments</li>
			    </ul>
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
		            	<input type="hidden" value="<?= $news['id'] ?>" id="news_id">
		            	<button type="submit" class="form-control btn btn-dark" value="">Send Comment</button>
		            </form>
	            </div>
	            <div class="m-2" id="view_news_comments">
	            	
	            </div>
				<div class="col-12 text-center">
					<button class="btn btn-dark" id="news_comments_load_more" value="1">Load More</button>
				</div>
			</div>
			<div class="row mt-4">
	            <div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Popular News</li>
	                    </ol>
	                </nav>                
	            </div>
		        <div class="col-12">
			        <div class="row">
			        	<?php 
			            foreach ($popular_news as $pon) {
			            ?>
			            <div class="col-12 mb-2">
			                <div class="row">
			                    <div class="col-4 p-2">
			                        <a href="news_detail.html/<?= $pon['id'] ?>-<?= $pon['slug'] ?>" class="stretched-link">
			                            <img src="assets/uploads/news/<?= $pon['image'] ?>" class="w-100" alt="">
			                        </a>
			                    </div>
			                    <div class="col-8 p-2 pr-5">
			                        <span class="font-weight-bolder "><a href="news_detail.html/<?= $pon['id'] ?>-<?= $pon['slug'] ?>" class="text-decoration-none text-info stretched-link"><?= $pon['title'] ?></a></span>
			                        <br>
			                        <span class="text-dark" style="font-size: 12px;"><?= $pon['description'] ?></span>
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
			                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">New Products</li>
			                    </ol>
			                </nav>                
			            </div>
			        </div>
			        <div class="row">
			        	<?php 
			            foreach ($new_products as $nep) {
			            ?>
			            <div class="col-12 mb-3">
			                <div class="card text-dark">
			                    <a href="product_detail.html/<?= $nep['id'] ?>-<?= $nep['slug'] ?>">
			                        <img class="card-img-top" src="assets/uploads/products/thumbnails/<?= $nep['thumbnail'] ?>" alt="" style="position: relative;">              
			                    </a>
			                    <div class="card-body">
			                        <a href="product_detail.html/<?= $nep['id'] ?>-<?= $nep['slug'] ?>" class="text-decoration-none">
			                            <span class="card-title font-weight-bolder text-info">
			                            <?= $nep['name'] ?>
			                        </span>
			                        </a>
			                        <br>
			                        <?php  
			                        if($nep['discount_status'])
			                        {
			                        ?>
			                        <span class="font-italic text-dark font-weight-bolder"><?= $nep['discount_price'] ?></span>
			                        <span class="font-italic text-dark font-italic font-weight-light" style="text-decoration: line-through;"><?= $nep['price'] ?></span>
			                        <?php    
			                        }
			                        else
			                        {
			                        ?>
			                        <span class="font-italic text-dark font-weight-bolder"><?= $nep['price'] ?></span>
			                        <?php    
			                        }
			                        ?>
			                        
			                    </div>
			                    <div class="card-footer">
			                        <div class="row">
			                            <div class="col-8">
			                                <small class="text-muted" style="font-size: 17px;">
			                                    <?php  
			                                    $star = $nep['star'];
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
			                                <button class="btn btn-dark" id="cart_product_id" value="<?= $nep['id'] ?>"><span><i class="fa fa-cart-plus"></i></span></button>
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

		function update_view_news()
		{
			var news_id = $('#news_id').val();
			$.ajax({
				url : 'update_view_news.html',
				type : 'POST',
				data : {
					news_id : news_id
				}
			});
		}

		update_view_news();

		function count_news_comments()
		{
			var news_id = $('#news_id').val();
			var count_news_comments = 0;
			$.ajax({
                async: false,
                url : 'count_news_comments.html',
                type : 'POST',
                data : {
                    news_id : news_id
                },
                dataType : 'text',
                success : function(result){
                	$('#count_comments').html(result);
                }
            });			
		}

		count_news_comments();

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

		function news_comments_load_more(start, offset)
		{
			var news_id = $('#news_id').val();
			$.ajax({
				url : 'news_comments_load_more.html',
				type : 'POST',
				data : {
					news_id : news_id,
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
                        $('#news_comments_load_more').val(0);
					}

					$('#view_news_comments').append(html);
				}
			});
		}

		function news_comments_reload(start, offset)
		{
			var news_id = $('#news_id').val();
			$.ajax({
				url : 'news_comments_load_more.html',
				type : 'POST',
				data : {
					news_id : news_id,
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

					$('#view_news_comments').html(html);
				}
			});
		}




		var start = 0;
        var offset = 4;
        news_comments_load_more(start, offset);

        $('#news_comments_load_more').on('click', function(){
            let val_news_comments_load_more = $(this).val();
            if(val_news_comments_load_more != 0)
            {
                start = start + 4;            
                news_comments_load_more(start, offset);
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
				var news_id = $('#news_id').val();
				$.ajax({
					url : 'send_comment_news.html',
					type : 'POST',
					data : {
						comment : comment,
						news_id : news_id
					},
					dataType : 'text',
					success : function(result){
						$('#comment').val('');
						toastr.success(result, 'Response',{timeOut: 200});
						news_comments_reload(0,4);
						count_news_comments();
					}
				});
			}
		});



	});
</script>