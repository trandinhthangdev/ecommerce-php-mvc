<div class="container">
    <div class="row mt-5 font-weight-bolder">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
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
                        <th>Content</th>
                        <th>Date</th>
                    </tr>                    
                </thead>
                <tbody>
                    <?php  
                    if(count($contact) > 0)
                        {
                        $index = 0;
                        foreach ($contact as $con) {
                            $index++;
                    ?>
                    <tr>
                        <td><?= $index ?></td>
                        <td>
                        <?php 
                        foreach ($customer as $cus) {
                            if($cus['id'] == $con['customer_id'])
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
                        <td><?= $con['message'] ?></td>
                        <td><?= $con['create_at'] ?></td>
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
