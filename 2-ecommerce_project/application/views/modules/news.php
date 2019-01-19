<div class="latest-blog wow bounceInUp animated animated container">
    <div>
<?php

    $data = \Models\News::getList();

    // cut to first elements
    $dataToOutput = 2;
    $data = array_slice($data, 0, $dataToOutput);

    foreach ($data as $key => $value) {

        // create excerpt
        $excerpt = new \Components\Excerpt($value['body']);
        $excerpt = $excerpt->getExcerpt();

        // get author's name
        $author = \Models\User::getByID($value['user_id']);

?>
        <!-- Item -->
        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 blog-post">
            <div class="blog_inner">
                <div class="blog-img"> <a href="/news/show/<?=$value['id']?>"> <img src="<?=IMG.'news'.DS.$value['image']?>" alt="<?=$value['title']?>"> </a>
                    <div class="mask"> <a class="info" href="/news/show/<?=$value['id']?>">Read More</a> </div>
                </div>
                <div class="blog-info">
                    <div class="post-date">
                        <time class="entry-date" datetime="<?=$value['created_at']?>"><span style="padding-top: 15px;"><?=date('M j', strtotime($value['created_at']))?></span></time>
                    </div>
                    <ul class="post-meta">
                        <li><i class="fa fa-user"></i>Posted by <a href="/users/show/<?=$value['user_id']?>"><?=$author['first_name'].' '.$author['last_name']?></a></li>
                        <!-- li><i class="fa fa-comments"></i><a href="#">4 comments</a> </li -->
                    </ul>
                    <h3><a href="/news/<?=$value['id']?>"><?=$value['title']?></a></h3>
                    <p><?=$excerpt?></p>
                </div>
            </div>
        </div>
        <!-- /Item -->

<?php } // foreach ?>

    </div>
</div>
