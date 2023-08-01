<div class="container">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item">News</li>
                <li class="breadcrumb-item active" aria-current="page">Add</li>
            </ol>
        </nav>
    </div>
    <div class="row mt-5">
        <div class="col-12 font-weight-bolder">
            <div class="card">
                <div class="card-header ext-center">
                    <h2 class="text-center">Add News</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="admin/news/store" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Image</label>
                            <input type="file" name="image" class="form-control-file" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter title ..." required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="5" required>
                                
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control" rows="20" required>
                                
                            </textarea>
                        </div>
                        <input class="btn btn-success" type="submit" name="save" value="Add">
                        <input class="btn btn-primary" type="reset" value="Reset">
                        <a href="admin/news/index"><input type="button" class="btn btn-danger" name="" value="Cancel"></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  

    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    
    
    <script>
            CKEDITOR.replace( 'content' );
    </script>