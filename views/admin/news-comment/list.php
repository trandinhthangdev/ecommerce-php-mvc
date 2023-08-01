<div class="container">
    <div class="row mt-5 font-weight-bolder">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active" aria-current="page">News Comment</li>
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
                        <th class="w-25">News</th>
                        <th>Content</th>
                        <th>Date</th>
                        <th class="text-center"><span><i class="fa fa-cog"></i></span></th>
                    </tr>                    
                </thead>
                <tbody>
                    <?php  
                    if(count($news_comment) > 0)
                        {
                        $index = 0;
                        foreach ($news_comment as $nec) {
                            $index++;
                    ?>
                    <tr>
                        <td><?= $index ?></td>
                        <td>
                        <?php 
                        foreach ($customer as $cus) {
                            if($cus['id'] == $nec['customer_id'])
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
                        foreach ($news as $new) {
                            if($new['id'] == $nec['news_id'])
                            {
                                $slug = $new['slug'];
                                if($new['title'] == '')
                                {
                                    echo 'Anonymous';
                                }  
                                else
                                {
                                    echo $new['title'];
                                }
                            }
                        }
                        ?> 
                        </td>
                        <td><?= $nec['content'] ?></td>
                        <td><?= $nec['create_at'] ?></td>
                        <td class="text-center"><button class="btn btn-primary btn-sm view-news" data-id="<?= $nec['news_id'] ?>" data-slug="<?= $slug ?>" data-toggle="modal" data-target="#view"><i class="fa fa-eye"></i></button></td>
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
            <div class="modal-body" id="iframe_view_news">

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
        $('.view-news').click(function(){
            id = $(this).data('id');
            slug = $(this).data('slug');
            link_news = 'news_detail.html/' + id + '-' + slug;
            html = '<iframe src="' + link_news + '" style="min-width:100%; min-height:75vh;"></iframe>';
            $('#iframe_view_news').html(html);
        });
    });
</script>