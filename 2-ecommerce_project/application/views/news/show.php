<div class="page-heading">
    <div class="page-title">
        <h2>FASION & STYLE</h2>
    </div>
</div>
<!-- Page Header Ends Here -->
<div class="content">
    <!-- News Page Main Container Starts Here -->
    <div class="main-container col2-left-layout">
        <div class="main container">
            <div class="row">
                <div class="col-left sidebar col-sm-3 blog-side">
                    <div id="secondary" class="widget_wrapper13" role="complementary">
                        <div id="recent-posts-4" class="popular-posts widget widget__sidebar wow bounceInUp animated animated" style="visibility: visible;">
                            <h2 class="widget-title">Latest news</h2>
                            <div class="widget-content">
                                <ul class="posts-list unstyled clearfix">
<?php

    $tmpData = $data;

    $pageData = \Models\News::getList();

    // cut to first elements
    $dataToOutput = 3;
    $pageData = array_slice($pageData, 0, $dataToOutput);

    foreach ($pageData as $key => $value) {

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
 
                        <!-- Categories menu -->
                        <?php include_once(APP.'views'.DS.'modules'.DS.'categories_menu.php'); ?>
                        <!-- /Categories menu  -->
                        
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
                        </div -->
 
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

        $data = $tmpData;

        // get the author
        $author = \Models\User::getById($data['user_id']);
?>
                                <article id="post-29" class="blog_entry clearfix wow bounceInUp animated animated" style="visibility: visible;">
                                    <div class="entry-content">
                                        <div class="featured-thumb"><img src="<?=IMG.'news'.DS.$data['image']?>" alt="<?=$data['title']?>"></div>
                                        <header class="blog_entry-header clearfix">
                                            <div class="blog_entry-header-inner">
                                                <h2 class="blog_entry-title"><?=$data['title']?></h2>
                                            </div>
                                            <!--blog_entry-header-inner-->
                                        </header>
                                        <div class="entry-content">
                                            <ul class="post-meta">
                                                <li><i class="fa fa-user"></i>posted by <a href="/users/show/<?=$data['user_id']?>"><?=$author['first_name'].' '.$author['last_name']?></a></li>
                                                <!-- li><i class="fa fa-comments"></i><a href="#">8 comments</a> </li -->
                                                <li><i class="fa fa-clock-o"></i><?=date('M j', strtotime($data['created_at']))?></li>
                                            </ul>
                                            <?=$data['body']?>
                                        </div>
                                    </div>
                                </article>
                                <!-- div class="comment-content wow bounceInUp animated">
                                    <div class="comments-wrapper">
                                        <h3> Comments </h3>
                                        <ol class="commentlist">
                                            <li class="comment">
                                                <div>
                                                    <img alt="" src="images/member1.png" class="avatar avatar-60 photo">
                                                    <div class="comment-text">
                                                        <div class="ratings">
                                                            <div class="rating-box">
                                                                <div style="width:100%" class="rating"></div>
                                                            </div>
                                                        </div>
                                                        <p class="meta">
                                                            <strong>Steve George</strong>
                                                            <span>–</span> <time>December 3, 2018</time>
                                                        </p>
                                                        <div class="description">
                                                            <p>Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus. Donec rutrum congue leo eget malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                            <p>Donec sollicitudin molestie malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis lorem ut libero malesuada feugiat. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="comment">
                                                <div>
                                                    <img alt="" src="images/member2.png" class="avatar avatar-60 photo">
                                                    <div class="comment-text">
                                                        <div class="ratings">
                                                            <div class="rating-box">
                                                                <div style="width:100%" class="rating"></div>
                                                            </div>
                                                        </div>
                                                        <p class="meta">
                                                            <strong>Diego Beltran</strong> <span>–</span> <time>June 02, 2018</time>
                                                        </p>
                                                        <div class="description">
                                                            <p>Donec rutrum congue leo eget malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div -->
                                    <!--comments-wrapper-->
                                    <!-- div class="comments-form-wrapper clearfix">
                                        <h3>Leave A reply</h3>
                                        <form class="comment-form" method="post" id="postComment" action="">
                                            <div class="field">
                                                <label for="name">Name<em class="required">*</em></label>
                                                <input type="text" class="input-text" title="Name" value="" id="user" name="user_name">
                                            </div>
                                            <div class="field">
                                                <label for="email">Email<em class="required">*</em></label>
                                                <input type="text" class="input-text validate-email" title="Email" value="" id="email" name="user_email">
                                            </div>
                                            <div class="clear"></div>
                                            <div class="field aw-blog-comment-area">
                                                <label for="comment">Comment<em class="required">*</em></label>
                                                <textarea rows="5" cols="50" class="input-text" title="Comment" id="comment" name="comment"></textarea>
                                            </div>
                                            <div style="width:96%" class="button-set">
                                                <input type="hidden" value="1" name="blog_id">
                                                <button type="submit" class="bnt-comment"><span><span>Add A New Comment</span></span></button>
                                            </div>
                                        </form>
                                    </div -->
                                    <!--comments-form-wrapper clearfix-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--#main wrapper grid_8-->
                </div>
                <!--col-main col-sm-9-->
            </div>
        </div>
        <!--main-container Ends Here -->
    </div>
    <!--col2-layout-->
</div>