<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="font-weight-bolder">
                <ol class="breadcrumb">
                    <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Keyword : <span class="font-italic font-weight-normal"><?= $key_word ?></span></li>
                </ol>
            </nav>                  
        </div>
        <div class="col-12 text-dark">
        	<h4>Show Result : </h4>
        </div>
        <div class="col-12">
        <?php  
        if(count($search_products))
        {
        ?>
		<div class="row">
            <?php 
            foreach ($search_products as $sep) {
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card text-dark">
                    <a href="product_detail.html/<?= $sep['id'] ?>-<?= $sep['slug'] ?>">
                        <img class="card-img-top" src="assets/uploads/products/thumbnails/<?= $sep['thumbnail'] ?>" alt="" style="position: relative;">              
                    </a>
                    <div class="card-body">
                        <a href="product_detail.html/<?= $sep['id'] ?>-<?= $sep['slug'] ?>" class="text-decoration-none">
                            <span class="card-title font-weight-bolder text-info">
                            <?= $sep['name'] ?>
                        </span>
                        </a>
                        <br>
                        <?php  
                        if($sep['discount_status'])
                        {
                        ?>
                        <span class="font-italic text-dark font-weight-bolder"><?= $sep['discount_price'] ?></span>
                        <span class="font-italic text-dark font-italic font-weight-light" style="text-decoration: line-through;"><?= $sep['price'] ?></span>
                        <?php    
                        }
                        else
                        {
                        ?>
                        <span class="font-italic text-dark font-weight-bolder"><?= $sep['price'] ?></span>
                        <?php    
                        }
                        ?>
                        
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-8">
                                <small class="text-muted" style="font-size: 17px;">
                                    <?php  
                                    $star = $sep['star'];
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
                                <button class="btn btn-dark" id="cart_product_id" value="<?= $sep['id'] ?>"><span><i class="fa fa-cart-plus"></i></span></button>
                            </div> 
                        </div>       
                    </div>
                </div>
            </div>            
            <?php
            }
            ?>
        </div>
        <?php  
    	}
    	else
    	{
        ?>
		<span class="text-danger font-italic">Không tìm thấy kết quả !</span>
        <?php  
    	}	
        ?>
        </div>
    </div>
</div>