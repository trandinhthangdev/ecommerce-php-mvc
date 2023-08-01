<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="font-weight-bolder">
                <ol class="breadcrumb">
                    <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Popular News</li>
                </ol>
            </nav>                  
        </div>
    </div>
    <div class="row">
        <?php  
        foreach ($popular_news as $pon) {
        ?>
        <div class="col-md-12 col-lg-6 mb-2">
            <div class="row">
                <div class="col-4 p-2">
                    <a href="news_detail.html/<?= $pon['id'] ?>-<?= $pon['slug'] ?>" class="stretched-link">
                        <img src="assets/uploads/news/<?= $pon['image'] ?>" class="w-100" alt="">
                    </a>
                </div>
                <div class="col-8 p-2 pr-5">
                    <span class="font-weight-bolder "><a href="news_detail.html/<?= $pon['id'] ?>-<?= $pon['slug'] ?>" class="text-decoration-none text-info stretched-link"><?= $pon['title'] ?></a></span>
                    <br>
                    <span class="text-dark" style="font-size: 12px;"><?= $pon['description'] ?></span>
                </div>
            </div>                
        </div>
        <?php
        }
        ?>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="font-weight-bolder">
                <ol class="breadcrumb">
                    <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Last News</li>
                </ol>
            </nav>                  
        </div>
    </div>
    <div class="row" id="last_news">
        
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-dark" id="news_load_more" value="1">Load More</button>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        function news_load_more(start, offset)
        {
            $.ajax({
                url : 'news_load_more.html',
                type : 'POST',
                data : {
                    start : start,
                    offset : offset
                },
                dataType : 'JSON',
                success : function(result){
                    let html = '';
                    if(result.length > 0)
                    {
                        $.each(result, function(key, value){
                            html += '<div class="col-md-12 col-lg-6 mb-2">';
                                html += '<div class="row">';
                                    html += '<div class="col-4 p-2">';
                                        html += '<a href="news_detail.html/'+ value.id + '-' + value.slug + '" class="stretched-link">';
                                            html += '<img src="assets/uploads/news/' + value.image + '" class="w-100" alt="">';
                                        html += '</a>'
                                    html += '</div>';
                                    html += '<div class="col-8 p-2 pr-5">';
                                        html += '<span class="font-weight-bolder "><a href="news_detail.html/'+ value.id + '-' + value.slug + '" class="text-decoration-none text-info stretched-link">' + value.title + '</a></span>';
                                        html += '<br>';
                                        html += '<span class="text-dark" style="font-size: 12px;">' + value.description + '</span>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                        });
                    }
                    else
                    {
                        html += '<span class="font-weight-bolder text-dark">Unable To Load More</span>';
                        $('#news_load_more').val(0);
                    }
                    
                    $('#last_news').append(html);
                    console.log(result);
                }
            });
        }
        var start = 0;
        var offset = 4;
        news_load_more(start, offset);
        
        $('#news_load_more').on('click', function(){
            let val_news_load_more = $(this).val();
            if(val_news_load_more != 0)
            {
                start = start + 4;            
                news_load_more(start, offset);
                console.log(val_news_load_more);
            }
        });
    });
</script>












