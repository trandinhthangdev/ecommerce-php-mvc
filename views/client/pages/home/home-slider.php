
<div class="slider">
    <div id="demo" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ul class="carousel-indicators">
            <?php  
            $i = 0;
            $count_slider = count($home_slider);
            while ($count_slider) {
                if($i==0)
                {
            ?>
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <?php
                } 
                else 
                {
            ?>
            <li data-target="#demo" data-slide-to="<?= $i+1 ?>"></li>
            <?php          
                }  
                $i++;
                $count_slider--;
            }
            ?>
            
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <?php  
            $i = 0;
            foreach ($home_slider as $hos) {
                if($i==0)
                {
            ?>
            <div class="carousel-item active">
                <a href="<?= $hos['link'] ?>"><img src="assets/uploads/sliders/<?= $hos['image'] ?>" style="width: 100%; height: 100%;"></a>
            </div>
            <?php
                } 
                else 
                {
            ?>
            <div class="carousel-item">
                <a href="<?= $hos['link'] ?>"><img src="assets/uploads/sliders/<?= $hos['image'] ?>" style="width: 100%; height: 100%;"></a>
            </div>
            <?php          
                }  
                $i++;
            }    
            ?>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>

    </div>
</div>