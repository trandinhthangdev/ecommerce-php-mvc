

<div class="container-fluid">
	<div class="row">
		<?php  
		require_once 'sidebar.php';
		?>
		<div class="col-md-8 col-lg-9">
			<div class="container mt-3">
			    <div class="row">
			        <div class="col-12">
			            <nav aria-label="breadcrumb" class="font-weight-bolder">
			                <ol class="breadcrumb">
			                    <li class=" text-dark breadcrumb-item"><?= $name_category ?></li>
			                    <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page"><?= $name_brand ?></li>
			                </ol>
			            </nav>                  
			        </div>
			    </div>
			    <input type="hidden" id="brand_id" value="<?= $brand_id ?>">
			    <div class="row" id="brand_products">
			    </div>
			    <div class="row">
			        <div class="col-12 text-center">
			            <button class="btn btn-dark" id="brand_products_load_more" value="1">Load More</button>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
    	var brand_id = $('#brand_id').val();
        function brand_products_load_more(start, offset)
        {
            $.ajax({
                url : 'brand_products_load_more.html',
                type : 'POST',
                data : {
                    start : start,
                    offset : offset,
                    brand_id : brand_id
                },
                dataType : 'JSON',
                success : function(result){
                    let html = '';
                    if(result.length > 0)
                    {
                        $.each(result, function(key, value){
                            html += '<div class="col-lg-4 col-md-6 mb-4">';
				                html += '<div class="card text-dark">';
				                    html += '<a href="product_detail.html/'+ value.id + '-' + value.slug + '">';
				                        html += '<img class="card-img-top" src="assets/uploads/products/thumbnails/' + value.thumbnail + '" alt="">';                
				                    html += '</a>';
				                    html += '<div class="card-body">';
				                        html += '<a href="product_detail.html/'+ value.id + '-' + value.slug + '" class="text-decoration-none">';
				                            html += '<span class="card-title font-weight-bolder text-info">';
				                            html += value.name;
				                        html += '</span>';
				                        html += '</a>';
				                        html += '<br>'; 
				                        if(value.discount_status == 1)
				                        {
				                        html += '<span class="font-italic text-dark font-weight-bolder">' + value.discount_price + '</span>';
				                        html += '/';
				                        html += '<span class="font-italic text-dark font-italic font-weight-light" style="text-decoration: line-through;">' + value.price + '</span>';   
				                        }
				                        else
				                        {
				                        html += '<span class="font-italic text-dark font-weight-bolder">' + value.price + '</span>';    
				                        }
				                    html += '</div>';
				                    html += '<div class="card-footer">';
				                        html += '<div class="row">';
				                            html += '<div class="col-8">';
				                                html += '<small class="text-muted" style="font-size: 17px;">';
				                                    star = value.star;
				                                    star_round = Math.round(star);
				                                    html += '<span><i class="fa fa-star ' + ((star_round >= 1) ? 'text-info' : '') + '"></i></span>';
				                                    html += '<span><i class="fa fa-star ' + ((star_round >= 2) ? 'text-info' : '') + '"></i></span>';
				                                    html += '<span><i class="fa fa-star ' + ((star_round >= 3) ? 'text-info' : '') + '"></i></span>';
				                                    html += '<span><i class="fa fa-star ' + ((star_round >= 4) ? 'text-info' : '') + '"></i></span>';
				                                    html += '<span><i class="fa fa-star ' + ((star_round == 5) ? 'text-info' : '') + '"></i></span>';
				                                html += '</small>';
				                            html += '</div>';
				                            html += '<div class="col-4 text-center">';
				                                html += '<button class="btn btn-dark" id="cart_product_id" value="' + value.id + '"><span><i class="fa fa-cart-plus"></i></span></button>';
				                            html += '</div>'; 
				                        html += '</div>';       
				                    html += '</div>';
				                html += '</div>';
				            html += '</div>'; 
                        });
                    }
                    else
                    {
                        html += '<span class="font-weight-bolder text-dark">Unable To Load More</span>';
                        $('#brand_products_load_more').val(0);
                    }
                    
                    $('#brand_products').append(html);
                    console.log(result);
                }
            });
        }
        var start = 0;
        var offset = 6;
        brand_products_load_more(start, offset);
        
        $('#brand_products_load_more').on('click', function(){
            let val_brand_products_load_more = $(this).val();
            if(val_brand_products_load_more != 0)
            {
                start = start + 6;            
                brand_products_load_more(start, offset);
                console.log(val_brand_products_load_more);
            }
        });
    });
</script>