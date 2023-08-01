<div class="container">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">Slider</li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
            </ol>
        </nav>
    </div>
    <div class="row mt-5">
        <div class="col-12 font-weight-bolder">
            <div class="card">
                <div class="card-header ext-center">
                    <h2 class="text-center">Add Slider</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="admin/slider/store" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control-file" accept="image/jpg, image/png, image/jpeg" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Link</label>
                            <input type="text" name="link" class="form-control" placeholder="Enter link ..." required>
                        </div>
                        <div class="form-group">
                            <label for="name">Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Show</option>   
                                <option value="0">Hide</option>   
                            </select>
                        </div>
                        <input class="btn btn-success" type="submit" name="save" value="Add">
                        <input class="btn btn-primary" type="reset" value="Reset">
                        <a href="admin/slider/index"><input type="button" class="btn btn-danger" name="" value="Cancel"></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  

    <script src="assets/admin/js/slider.js"></script>
