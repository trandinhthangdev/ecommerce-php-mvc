<div class="container">
    <div class="row mt-5 font-weight-bolder">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active" aria-current="page">Product Comment</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
             <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Customer</th>
                        <th class="w-25">Product</th>
                        <th>Content</th>
                        <th>Date</th>
                    </tr>                    
                </thead>
                <tbody>
                    <?php  
                    if(count($product_comment) > 0)
                        {
                        $index = 0;
                        foreach ($product_comment as $prc) {
                            $index++;
                    ?>
                    <tr>
                        <td><?= $index ?></td>
                        <td>
                        <?php 
                        foreach ($customer as $cus) {
                            if($cus['id'] == $prc['customer_id'])
                            {
                                if($cus['name'] == '')
                                {
                                    echo 'Anonymous';
                                }  
                                else
                                {
                                    echo $cus['name'];
                                }
                            }
                        }
                        ?> 
                        </td>
                        <td>
                        <?php 
                        foreach ($product as $pro) {
                            if($pro['id'] == $prc['product_id'])
                            {
                                $slug = $pro['slug'];
                                if($pro['name'] == '')
                                {
                                    echo 'Anonymous';
                                }  
                                else
                                {
                                    echo $pro['name'];
                                }
                            }
                        }
                        ?> 
                        </td>
                        <td><?= $prc['content'] ?></td>
                        <td><?= $prc['create_at'] ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm view-product" data-id="<?= $prc['product_id'] ?>" data-slug="<?= $slug ?>" data-toggle="modal" data-target="#view"><span><i class="fa fa-eye"></i></span></button>
                        </td>
                    </tr>
                    <?php 
                        }
                    }
                    else
                    {
                    ?>
                    <tr>
                        <td>Not Data</td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>       
        </div>

    </div>
</div>

<!-- View  Modal -->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="min-width: 100%; margin: 0; min-height: 100vh;">
        <div class="modal-content" style="min-height: 100vh;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View News Detail</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="iframe_view_product">

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        
        $('.view-product').click(function(){
            id = $(this).data('id');
            slug = $(this).data('slug');
            link_news = 'product_detail.html/' + id + '-' + slug;
            html = '<iframe src="' + link_news + '" style="min-width:100%; min-height:75vh;"></iframe>';
            $('#iframe_view_product').html(html);
        });

    });
</script>    