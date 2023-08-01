<?php  
if(isset($brand))
{
    $name = $brand['name'];
    $category_id = $brand['category_id'];
    $id = $brand['id'];
}
?>
<div class="container">
    <div class="row mt-5 font-weight-bolder">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item">Brand</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 font-weight-bolder">
            <div class="card">
                <div class="card-header ext-center">
                    <h2 class="text-center">Edit Brand</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="admin/brand/update">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name ..." value="<?= $name ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Category</label>
                            <select class="form-control" name="category_id">
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
                        <input class="btn btn-success" type="submit" name="save" value="Update">
                        <input class="btn btn-primary" type="reset" value="Reset">
                        <a href="admin/brand/index"><input type="button" class="btn btn-danger" name="" value="Cancel"></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
