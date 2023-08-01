<div class="container">
    <div class="row mt-5 font-weight-bolder">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active" aria-current="page">Category</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row mt-6">
        <div class="col-6">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Enter Category ...">
                <span class="input-group-btn">
                    <button class="btn btn-info" id="btn_search"><span><i class="fa fa-search"></i></span></button>
                </span>
            </div>
        </div>
        <div class="col-3 text-right">
            <button class="btn btn-primary dropdown-toggle" id="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span><i class="fa fa-sort"></i></span>  Sort</button>
            <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                <li>
                    <a class="btn sort_select" data-id="1" id="sort_a_z"><span><i class="fa fa-sort-alpha-asc"></i> Name A-Z </span></a>
                </li> 
                <li>
                    <a class="btn sort_select" data-id="2" id="sort_z_a"><span><i class="fa fa-sort-alpha-desc"></i> Name Z-A </span></a>
                </li>
            </ul>
        </div>
        <div class="col-3 text-right">
            <a href="admin/category/create"><button class="btn btn-primary"><span><i class="fa fa-plus"></i></span></button></a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
             <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th class="text-center">
                            <span><i class="fa fa-cog"></i></span>
                        </th>
                    </tr>                    
                    <tr>
                        <th></th>
                        <th>
                            <input type="text" id="auto_search" class="form-control" placeholder="Enter Category ...">
                        </th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                    if(count($category) > 0)
                        {
                        $index = 0;
                        foreach ($category as $cat) {
                            $index++;
                    ?>
                    <tr>
                        <td><?= $index ?></td>
                        <td><?= $cat['name'] ?></td>
                        <td><?= $cat['slug'] ?></td>
                        <td class="text-center">
                            <a href="admin/category/edit/<?= $cat['id'] ?>/<?= $cat['slug'] ?>"><button class="badge badge-success"><span><i class="fa fa-edit"></i></span></button></a>
                            <button class="badge badge-danger delete-category" data-id="<?= $cat['id'] ?>" data-toggle="modal" data-target="#delete"><span><i class="fa fa-trash"></i></span></button>
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

<!-- delete Modal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this category ?</h5>
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
        $('.delete-category').click(function(){
            id = $(this).data('id');
            $('.delete-yes').click(function(){
                $.ajax({
                    url : 'admin/category/delete/' + id,
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

        function show_data(result)
        {
            let html = '';
            if(result.length > 0)
            {
                $.each(result, function(key, value){
                    html += '<tr>';
                        html += '<td>' + (key+1)  + '</td>';
                        html += '<td>' + value.name + '</td>';
                        html += '<td>' + value.slug + '</td>';
                        html += '<td class="text-center">';
                            html += ' <a href="admin/category/edit/'+ value.id +'/'+ value.slug +'"><button class="badge badge-success"><span><i class="fa fa-edit"></i></span></button></a>';
                            html += '<button class="badge badge-danger delete-category" data-id="' + value.id + '" data-toggle="modal" data-target="#delete"><span><i class="fa fa-trash"></i></span></button>';
                        html += '</td>';
                });
            }
            else
            {
                html += '<tr>';
                    html += '<td>Not Data</td>'
                html += '</tr>';
            }
            $('tbody').html(html);
        }

        function search(keyword)
        {
            $.ajax({
                url : 'admin/category/search',
                type : 'POST',
                dataType : 'json',
                data : {
                    keyword : keyword
                },
                success : function(result)
                {
                    show_data(result);
                }
            });
        }

        $('#auto_search').keyup(function(){
            keyword = $(this).val();
            search(keyword);
        });

        $('#btn_search').click(function(){
            keyword = $('#search').val();
            search(keyword);
        });

        $('.sort_select').click(function(){
            var sort = $(this).data('id');
            var sort_column = '';
            var sort_type = '';
            switch(sort)
            {
                case 1 : 
                    $('#sort_a_z').append('<span id="check_a_z"><i class="fa fa-check"></i></span>');
                    $('#check_z_a').remove();
                    sort_column = 'name';
                    sort_type = 'ASC';
                    break;
                case 2 : 
                    $('#sort_z_a').append('<span id="check_z_a"><i class="fa fa-check"></i></span>');
                    $('#check_a_z').remove();
                    sort_column = 'name';
                    sort_type = 'DESC';
                    break;
            }

            $.ajax({
                url : 'admin/category/sort',
                type : 'POST',
                dataType : 'json',
                data : {
                    sort_column : sort_column,
                    sort_type : sort_type
                },
                success : function(result)
                {
                    show_data(result);
                }
            });
        });
    });
</script>