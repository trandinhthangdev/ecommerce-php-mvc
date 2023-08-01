<?php  

    $id = $product['id'];
    $category_id = $product['category_id'];
    $brand_id = $product['brand_id'];
    $name = $product['name'];
    $description = $product['description'];
    $content = $product['content'];
    $quantity = $product['quantity'];
    $price = $product['price'];
    $discount_status = $product['discount_status'];
    $discount_price = $product['discount_price'];
    $thumbnail = $product['thumbnail'];
    $featured = $product['featured']; 
?>
<div class="container">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
    <div class="row mt-5">
        <div class="col-12 font-weight-bolder">
            <div class="card">
                <div class="card-header ext-center">
                    <h2 class="text-center">Edit Product</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="admin/product/update" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name ..." value="<?= $name ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="5" required>
                                <?= $description ?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control" rows="20" required>
                                <?= $content ?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Enter quantity ..." value="<?= $quantity ?>" required>
                        
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Enter price ..." value="<?= $price ?>" required>
                        </div>
                        </div>
                        <br>
                        <div class="form-check">
                            <?php  
                            if($discount_status)
                            {
                            ?>
                            <input class="form-check-input" type="checkbox" name="discount_status" id="discount_status" checked>
                            <?php  
                            }
                            else
                            {
                            ?>
                            <input class="form-check-input" type="checkbox" name="discount_status" id="discount_status">
                            <?php  
                            }
                            ?>
                            
                            <label class="form-check-label" for="discount_status">
                                Discount Status
                            </label>
                        </div>
                        <br>
                        <div id="discount_price_input">
                            <?php  
                            if($discount_status)
                            {
                            ?>
                            <div class="form-group">
                                <label for="discount_price">Discount Price</label>
                                <input type="number" name="discount_price" class="form-control" placeholder="Enter price ..." value="<?= $discount_price ?>" required>
                            </div>
                            <?php  
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="name">Category</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <?php  
                                foreach ($category as $cat) {
                                    if($category_id == $cat['id'])
                                    {
                                ?>
                                <option value="<?= $cat['id'] ?>" selected><?= $cat['name'] ?></option> 
                                <?php
                                    }
                                    else 
                                    {  
                                ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>   
                                <?php  
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Brand</label>
                            <select class="form-control" name="brand_id" id="brand_id">
                                 <option value="<?= $brand_id ?>"><?= $brand_id ?></option>
                                 <?php  
                                foreach ($brand as $braS) {
                                    if($brand_id == $bra['id'])
                                    {
                                ?>
                                <option value="<?= $bra['id'] ?>" selected><?= $bra['name'] ?></option>   
                                <?php  
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Featured</label>
                            <select class="form-control" name="featured">
                                <?php  
                                if($featured)
                                {
                                ?>
                                <option value="1" selected>Featured</option>   
                                <option value="0">Unfeatured</option>   
                                <?php
                                }
                                else
                                {
                                ?>
                                <option value="1">Featured</option>
                                <option value="0" selected>Unfeatured</option>
                                <?php    
                                }
                                ?>   
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control-file" accept="image/jpg, image/png, image/jpeg">
                            <input type="hidden" name="old_thumbnail" value="<?= $thumbnail ?>">
                            <img src="assets/uploads/products/thumbnails/<?= $thumbnail?>" alt="" style="width: 80px;" class="img-thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="slider">Slider</label>
                            <input type="file" name="slider[]" class="form-control-file" multiple accept="image/jpg, image/png, image/jpeg">
                            <?php  
                            foreach ($slider_by_product as $sli) {
                            ?>
                            <img src="assets/uploads/products/sliders/<?= $sli['image'] ?>" alt="" style="width: 100px;" class="img-thumbnail">
                            <?php
                            }
                            ?>
                        </div>
                        <input class="btn btn-success" type="submit" name="save" value="Update">
                        <input class="btn btn-primary" type="reset" value="Reset">
                        <a href="admin/product/index"><input type="button" class="btn btn-danger" name="" value="Cancel"></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="assets/admin/js/product.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var html = '';
            html += '<div class="form-group">';
                html += '<label for="discount_price">Discount Price</label>';
                html += '<input type="number" name="discount_price" class="form-control" placeholder="Enter discount prices ..." required>';
            html += '</div>';

            $('#discount_status').click(function(){
                if($(this).is(':checked'))
                {
                    $('#discount_price_input').html(html);
                }
                else
                {
                    $('#discount_price_input').html('');
                }
            });

            category_id = $('#category_id').val();
            brand_id = $('#brand_id').val();
            console.log(brand_id);
            $.ajax({
                url : 'admin/product/getBrandByCategory',
                data : {
                    category_id : category_id
                },
                dataType : 'JSON',
                type : 'POST',
                success : function(result){
                    console.log(result);
                    var html = '';
                    $.each(result, function(key, value){
                        if(value.id == brand_id)
                        {
                            html += '<option value="' + value.id + '" selected>' + value.name + '</option>';
                        }
                        else
                        {
                            html += '<option value="' + value.id + '">' + value.name + '</option>';
                        }  
                    });
                    $('#brand_id').html(html);
                }
            });

            $('#category_id').on('change', function(){
                category_id = $('#category_id').val();
                console.log(category_id);
                $.ajax({
                    url : 'admin/product/getBrandByCategory',
                    data : {
                        category_id : category_id
                    },
                    dataType : 'JSON',
                    type : 'POST',
                    success : function(result){
                        console.log(result);
                        var html = '';
                        $.each(result, function(key, value){
                            html += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                        $('#brand_id').html(html);
                    }
                });
            });
            
        });
    </script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

    <script>
            CKEDITOR.replace( 'content' );
    </script>