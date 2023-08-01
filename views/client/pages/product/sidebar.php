<div class="col-md-4 col-lg-3">
	<div class="container mt-3">
		<div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="font-weight-bolder">
                    <ol class="breadcrumb">
                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Select Category & Brand</li>
                    </ol>
                </nav>                  
            </div>
        </div>
	    <div id="accordion" class="font-weight-bolder">
	    	<div class="card">
	            <div class="card-header bg-dark">
	                <a class="card-link text-light" href="product.html">
		          	New Products
		        	</a>
	            </div>
	        </div>
        	<?php  
        	$i = 0;
        	foreach ($category as $cat) {
        	$i++;
        	?>
	        <div class="card">		        	
	            <div class="card-header bg-dark">
	                <a class="card-link text-light" data-toggle="collapse" href="#collapse<?= $i ?>">
		          	<?= $cat['name'] ?>
		        	</a>
	            </div>
	            <div id="collapse<?= $i ?>" class="collapse" data-parent="#accordion">
	                <div class="card-body bg-secondary">
	                	<ul class="list-group list-inline">
						  	<li><a href="product.html/<?= $cat['id']?>-<?= $cat['slug'] ?>" class="text-decoration-none text-light">All</a></li>
						  	<?php  
						  	foreach ($brand as $bra) {
						  		if($bra['category_id'] == $cat['id'])
						  		{
						  	?>
							<li><a href="product.html/<?= $cat['id']?>-<?= $cat['slug'] ?>/<?= $bra['id']?>-<?= $bra['slug'] ?>" class="text-decoration-none text-light"><?= $bra['name'] ?></a></li>
						  	<?php
						  		}
						  	}
						  	?>	
	                    </ul>
	                </div>
	            </div>
	        </div>
	        <?php	
        	}
        	?>
	    </div>
	</div>
</div>