<div class="container">
    <div class="row mt-5 font-weight-bolder">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active" aria-current="page">News</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-12 text-right">
            <a href="admin/news/create"><button class="btn btn-primary"><span><i class="fa fa-plus"></i></span></button></a>
        </div>
    </div>
    <div class="row mt-5">
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title & Description & Image</th>
                    <th class="w-50">Content</th>
                    <th>View</th>
                    <th class="text-center">
                        <span><i class="fa fa-cog"></i></span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php  
                if(count($news) > 0)
                {
                $index = 0;
                foreach ($news as $ne) {
                    $index++;
                ?>
                <tr>
                    <td><?= $index ?></td>
                    <td>
                        <p class="font-weight-bolder">Title</p>
                        <p class="font-italic"><?= $ne['title'] ?></p>
                        <div class="dropdown-divider"></div>                      
                        <p class="font-weight-bolder">Description</p>
                        <p class="font-italic"><?= $ne['description'] ?></p>
                        <div class="dropdown-divider"></div>                      
                        <img src="assets/uploads/news/<?= $ne['image'] ?>" alt="" class="img-thumbnail" style="width: 100px;">
                    </td>
                    <td class="w-50">
                        <?= $ne['content'] ?>
                    </td>
                    <td><?= $ne['view'] ?></td>
                    <td class="text-center">
                        <button class="badge badge-primary view-news" data-id="<?= $ne['id'] ?>" data-slug="<?= $ne['slug'] ?>" data-toggle="modal" data-target="#view"><span><i class="fa fa-eye"></i></span></button>
                        <a href="admin/news/edit/<?= $ne['id'] ?>/<?= $ne['slug'] ?>"><button class="badge badge-success"><span><i class="fa fa-edit"></i></span></button></a>
                        <button class="badge badge-danger delete-news" data-id="<?= $ne['id'] ?>" data-toggle="modal" data-target="#delete"><span><i class="fa fa-trash"></i></span></button>
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


<!-- delete Modal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this news ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="margin-left: 183px;">
                <button type="button" class="btn btn-success delete-yes">Yes</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
            <div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('.delete-news').click(function(){
            id = $(this).data('id');
            $('.delete-yes').click(function(){
                $.ajax({
                    url : 'admin/news/delete/' + id,
                    type: 'GET',
                    dataType: 'text',
                    success: function(result){
                        toastr.success(result, 'Response', {timeOut: 5000});
                        $('#delete').modal('hide');
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    }
                });
            });
        });

        $('.view-news').click(function(){
            id = $(this).data('id');
            slug = $(this).data('slug');
            link_news = 'news_detail.html/' + id + '-' + slug;
            html = '<iframe src="' + link_news + '" style="min-width:100%; min-height:75vh;"></iframe>';
            $('#iframe_view_news').html(html);
        });
    });
</script>  