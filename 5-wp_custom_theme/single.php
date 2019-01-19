<?php get_header(); ?>

<div class="v-row v-post">

    <?php
        if (have_posts()) : 
            the_post();
    ?>

        <!-- Post/page -->
        <article>

            <h2 class="v-section-title"><?php the_title() ?></h2>

            <hr>

            <div class="v-card-1 v-thumb">
                <?php the_post_thumbnail(); ?>
            </div>

            <div class="v-card-2">

                <?php the_content(); ?>

            </div>

        </article>

    <?php
        endif;
    ?>

</div>

<?php get_footer(); ?>