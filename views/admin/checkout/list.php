<div class="container">
    <div class="row mt-5 font-weight-bolder">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
                        <th class="w-75">Checkout</th>
                        <th>Date</th>
                    </tr>                    
                </thead>
                <tbody>
                    <?php  
                    if(count($checkout) > 0)
                        {
                        $index = 0;
                        foreach ($checkout as $che) {
                            $index++;
                    ?>
                    <tr>
                        <td><?= $index ?></td>
                        <td><?= $che['check_out_show'] ?></td>
                        <td><?= $che['create_at'] ?></td>
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
