<?php

    query_posts(['category_name'  => 'homepage', 'posts_per_page' => 3]);
    while (have_posts()) : 
        the_post();
?>

<!-- Sidebar (bottom) -->
<div class="v-card-1 v-post">

    <a href="<?php the_permalink(); ?>">
        <div>
            <img src="<?=get_the_post_thumbnail_url()?>" alt="<?php the_title(); ?>" />
        </div>

        <div class="v-title">
            <h4><?php the_title(); ?></h4>
        </div>
    </a>

    <div class="v-excerpt">
        <?php the_excerpt(); ?>
    </div>

    <div class="read-more">
        <a href="<?php the_permalink(); ?>">
            Read more &gt;
        </a>
    </div>

</div>


<?php
    endwhile;
?>
