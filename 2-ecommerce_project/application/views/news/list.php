<?php

    // parse pagination paramaters passed
    $pageNumber = empty($params[0]) ? 1 : $params[0];
    $itemsPerPage = empty($params[1]) ? 5 : $params[1];

    // get appropriate page's data and last page number
    $p = new \Components\Paginator($data, $itemsPerPage);
    $pageData = $p->getPage($pageNumber);
    $pagesNum = $p->getPagesNum();

?>

<!-- Title -->
<div class="page-heading">
    <div class="page-title">
        <h2>News</h2>
    </div>
</div>
<!-- /Title -->
<div class="content">
    <div class="main-container col2-left-layout">
        <div class="main container">
            <div class="row">
                <div class="col-left sidebar col-sm-3 blog-side">
                    <div id="secondary" class="widget_wrapper13" role="complementary">
                        <div id="recent-posts-4" class="popular-posts widget widget__sidebar wow bounceInUp animated animated" style="visibility: visible;">
                            <h2 class="widget-title">Latest posts</h2>
                            <div class="widget-content">
                                <ul class="posts-list unstyled clearfix">
<?php

    $data = \Models\News::getList();

    // cut to first elements
    $dataToOutput = 3;
    $data = array_slice($data, 0, $dataToOutput);

    foreach ($data as $key => $value) {

        // create excerpt
        $excerpt = new \Components\Excerpt($value['body']);
        $excerpt = $excerpt->getExcerpt();

        // get author's name
        $author = \Models\User::getByID($value['user_id']);

?>
                                    <li>
                                        <figure class="featured-thumb">
                                            <a href="/news/show/<?=$value['id']?>">
                                                <img src="<?=IMG.'news'.DS.$value['image']?>" alt="<?=$value['title']?>">
                                            </a>
                                        </figure>
                                        <div class="content-info">
                                            <h4><a href="/news/show/<?=$value['id']?>" title="<?=$value['title']?>"><?=$value['title']?></a></h4>
                                            <p class="post-meta">
                                                <time class="entry-date"><?=date('M j, Y', strtotime($value['created_at']))?></time>
                                            </p>
                                        </div>
                                    </li>
<?php } //foreach ?>
                                </ul>
                            </div>
                        </div>
                        <!-- div id="categories-2" class="widget widget_categories wow bounceInUp animated animated" style="visibility: visible;">
                            <h2 class="widget-title">Categories</h2>
                            <div class="content">
                                <ul>
                                    <li><a href="#">Latest News</a></li>
                                    <li><a href="#">New Products</a></li>
                                    <li><a href="#">Technologies</a></li>
                                    <li><a href="#">Bryond News</a></li>
                                    <li><a href="#">Announcements</a></li>
                                    <li><a href="#">Videos</a></li>
                                </ul>
                            </div>
                        </div -->
                        <!-- Banner Ad Block -->
                        <!-- div class="custom-slider">
                            <div>
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li class="active" data-target="#carousel-example-generic" data-slide-to="0"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="images/slide2.jpg" alt="slide3">
                                            <div class="carousel-caption">
                                                <h4>Tech Shop</h4>
                                                <h3><a title=" Sample Product" href="product-detail.html">Up to 70% Off</a></h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                <a class="link" href="#">Buy Now</a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <img src="images/slide3.jpg" alt="slide1">
                                            <div class="carousel-caption">
                                                <h4>Fashion Shop</h4>
                                                <h3><a title=" Sample Product" href="product-detail.html">Mega Sale</a></h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                <a class="link" href="#">Buy Now</a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <img src="images/slide1.jpg" alt="slide2">
                                            <div class="carousel-caption">
                                                <h4>Home Shop</h4>
                                                <h3><a title=" Sample Product" href="product-detail.html">Up to 50% Off</a></h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                <a class="link" href="#">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="sr-only">Next</span> </a>
                                </div>
                            </div>
                        </div-->
 
                        <!-- Static about -->
                        <?php include_once(APP.'views'.DS.'modules'.DS.'static_about.php'); ?>
                        <!-- /Static about  -->
                        
                    </div>
                </div>
                <div class="col-main col-sm-9 main-blog">
                    <div id="main" class="blog-wrapper">
                        <div id="primary" class="site-content">
                            <div id="content" role="main">
<?php

    foreach ($pageData as $key => $value) {

        // create excerpt
        $excerpt = new \Components\Excerpt($value['body']);
        $excerpt = $excerpt->getExcerpt();

        // get author's name
        $author = \Models\User::getByID($value['user_id']);

?>
                                <article id="post-29" class="blog_entry clearfix wow bounceInUp animated animated" style="visibility: visible;">
                                    <div class="entry-content">
                                        <div class="featured-thumb"><a href="/news/show/<?=$value['id']?>">
                                            <img src="<?=IMG.'news'.DS.$value['image']?>" alt="<?=$value['title']?>"></a></div>
                                        <header class="blog_entry-header clearfix">
                                            <div class="blog_entry-header-inner">
                                                <h2 class="blog_entry-title"><a href="/news/show/<?=$value['id']?>" rel="bookmark"><?=$value['title']?></a></h2>
                                            </div>
                                        </header>
                                        <div class="entry-content">
                                            <ul class="post-meta">
                                                <li><i class="fa fa-user"></i>posted by <a href="/users/show/<?=$value['user_id']?>"><?=$author['first_name'].' '.$author['last_name']?></a></li>
                                                <!-- li><i class="fa fa-comments"></i><a href="#">8 comments</a></li-->
                                                <li><i class="fa fa-clock-o"></i><span class="day"><?=date('j', strtotime($value['created_at']))?></span>&nbsp;<span class="month"><?=date('M', strtotime($value['created_at']))?></span></li>
                                            </ul>
                                            <p><?=$excerpt?></p>
                                        </div>
                                        <p><a href="/news/show/<?=$value['id']?>" class="btn">Read more</a></p>
                                    </div>
                                </article>
<?php } //foreach ?>
                            </div>
                        </div>
                        <div class="pager">
                                    <div class="pages">
                                        <!-- Paginator -->
                                        <ul class="pagination">
                                            <li><a href="/news/list/<?= max(1,$pageNumber-1) ?>/<?=$itemsPerPage?>">&laquo;</a></li>
<?php

    for ($i=1; $i<=$pagesNum; $i++) {

        //check for long paginator 
        if ($pagesNum > 5) {
            if ($pageNumber==$i 
                OR $i==1 
                OR $i==$pagesNum 
                OR ($pageNumber<=2 AND ($i>=($pagesNum-1) OR $i<=2)) 
                OR ($pageNumber>=($pagesNum-1) AND ($i<=2 OR $i>=($pagesNum-1)))) {
                // show page marker
?>
                                            <li<?= $pageNumber==$i ? ' class="active"' : '' ?>><a<?= $pageNumber==$i ? ' class="a-disabled"' : '' ?> href="/news/list/<?=$i?>/<?=$itemsPerPage?>"><?=$i?></a></li>
<?php
                unset($dividerShown);
                continue;
            } else {
                if (empty($dividerShown)) { 
                    //show divider
?>
                                            <li><a class="a-disabled" href="/news/list/<?=$pageNumber?>/<?=$itemsPerPage?>">&hellip;</a></li>
<?php
                    // we don't need to repeat divider
                    $dividerShown = 1;
                }
                continue;
            }
        } else {
            // nothing to worry about
            // show page marker
?>
                                            <li<?= $pageNumber==$i ? ' class="active"' : '' ?>><a<?= $pageNumber==$i ? ' class="a-disabled"' : '' ?> href="/products/list/<?=$i?>/<?=$itemsPerPage?>"><?=$i?></a></li>
<?php }} //if //for ?>
                                            <li><a href="/news/list/<?= min($pagesNum,$pageNumber+1) ?>/<?=$itemsPerPage?>">&raquo;</a></li>
                                        </ul>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>