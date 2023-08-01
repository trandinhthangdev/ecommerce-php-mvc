<div class="container">
    <div class="row mt-5 font-weight-bolder">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active" aria-current="page">Slider</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row mt-6">
        <div class="col-12 text-right">
            <a href="admin/slider/create"><button class="btn btn-primary"><span><i class="fa fa-plus"></i></span></button></a>
        </div>
    </div>
    <div class="row mt-5">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th class="text-center">
                        <span><i class="fa fa-cog"></i></span>
                    </th>
                </tr>                    
            </thead>
            <tbody>
                <?php  
                if(count($slider) > 0)
                    {
                    $index = 0;
                    foreach ($slider as $sli) {
                        $index++;
                ?>
                <tr>
                    <td><?= $index ?></td>
                    <td>
                        <img src="assets/uploads/sliders/<?= $sli['image'] ?>" alt="" class="img-thumbnail" style="width: 100px;">
                    </td>
                    <td>
                        <?= $sli['link'] ?>               
                    </td>
                    <td class="text-center">
                        <?php 
                        if($sli['status']) 
                        {
                        ?>
                        <span class="badge badge-danger status-badge" data-id='<?= $sli['id'] ?>'>Show</span>
                        <?php
                        }
                        else
                        {
                        ?>
                        <span class="badge badge-success status-badge" data-id='<?= $sli['id'] ?>'>Hide</span> 
                        <?php  
                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <a href="admin/slider/edit/<?= $sli['id'] ?>"><button class="badge badge-success"><span><i class="fa fa-edit"></i></span></button></a>
                        <button class="badge badge-danger delete-slider" data-id="<?= $sli['id'] ?>" data-toggle="modal" data-target="#delete"><span><i class="fa fa-trash"></i></span></button>
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
    
    <script src="assets/admin/js/slider.js"></script>
