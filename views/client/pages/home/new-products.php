<div id="new-products" class="mt-3">
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
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card text-dark">
                    <a href="product_detail.html/<?= $nep['id'] ?>-<?= $nep['slug'] ?>">
                        <img class="card-img-top" src="assets/uploads/products/thumbnails/<?= $nep['thumbnail'] ?>" alt="">                 
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