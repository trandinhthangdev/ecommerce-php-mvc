<div id="last-news" class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="font-weight-bolder">
                    <ol class="breadcrumb">
                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Last News</li>
                    </ol>
                </nav>                  
            </div>
        </div>
        <div class="row">
            <?php  
            foreach ($last_news as $lan) {
            ?>
            <div class="col-md-12 col-lg-6 mb-2">
                <div class="row">
                    <div class="col-4 p-2">
                        <a href="news_detail.html/<?= $lan['id'] ?>-<?= $lan['slug'] ?>" class="stretched-link">
                            <img src="assets/uploads/news/<?= $lan['image'] ?>" class="w-100" alt="">
                        </a>
                    </div>
                    <div class="col-8 p-2 pr-5">
                        <span class="font-weight-bolder "><a href="news_detail.html/<?= $lan['id'] ?>-<?= $lan['slug'] ?>" class="text-decoration-none text-info stretched-link"><?= $lan['title'] ?></a></span>
                        <br>
                        <span class="text-dark" style="font-size: 12px;"><?= $lan['description'] ?></span>
                    </div>
                </div>                
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>