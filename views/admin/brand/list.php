<div class="container">
    <div class="row mt-5 font-weight-bolder">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active" aria-current="page">Brand</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row mt-6">
        <div class="col-12 text-right">
            <a href="admin/brand/create"><button class="btn btn-primary"><span><i class="fa fa-plus"></i></span></button></a>
        </div>
    </div>
    <div class="row mt-5">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Category</th>
                    <th class="text-center">
                        <span><i class="fa fa-cog"></i></span>
                    </th>
                </tr>                    
            </thead>
            <tbody>
                <?php  
                if(count($brand) > 0)
                    {
                    $index = 0;
                    foreach ($brand as $bra) {
                        $index++;
                ?>
                <tr>
                    <td><?= $index ?></td>
                    <td><?= $bra['name'] ?></td>
                    <td><?= $bra['slug'] ?></td>
                    <td>
                        <?php  
                        foreach ($category as $cat) {
                            if($cat['id'] == $bra['category_id'])
                            {
                        ?>
                        <p><?= $cat['name'] ?></p>
                        <?php  
                            }
                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <a href="admin/brand/edit/<?= $bra['id'] ?>/<?= $bra['slug'] ?>"><button class="badge badge-success"><span><i class="fa fa-edit"></i></span></button></a>
                        <button class="badge badge-danger delete-brand" data-id="<?= $bra['id'] ?>" data-toggle="modal" data-target="#delete"><span><i class="fa fa-trash"></i></span></button>
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

<!-- delete Modal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this brand ?</h5>
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
        $('.delete-brand').click(function(){
            id = $(this).data('id');
            $('.delete-yes').click(function(){
                $.ajax({
                    url : 'admin/brand/delete/' + id,
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

    });
</script>