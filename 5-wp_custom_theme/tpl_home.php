<?php 
// Template Name: Homepage
?>

<?php get_header(); ?>

    <div class="v-hero">

        <div class="v-card-1">
            <!-- Slider -->
            <?php echo do_shortcode('[smartslider3 slider=2]'); ?>
        </div>
        
        <div class="v-card-2 v-dog">

            <?php

                query_posts(['category_name'  => 'hero', 'posts_per_page' => 1]);
                while (have_posts()) : 
                    the_post();
            ?>

                <h2 class="v-hero-title"><?php the_title(); ?></h2>

                <?php the_content(); ?>

            <?php
                endwhile;
            ?>

        </div>
        
    </div> <!-- /v-hero -->

    <div class="v-row v-post">

        <?php get_sidebar('home'); ?>

    </div> <!-- /v-row -->
    
<?php get_footer(); ?>