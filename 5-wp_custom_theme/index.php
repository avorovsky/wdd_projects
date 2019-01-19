<?php get_header(); ?>

<!-- Posts -->
<div class="v-row v-post">

    <div class="v-card-1">
        <h2 class="v-section-title">All posts</h2>
    </div>

    <?php
        while (have_posts()) : 
            the_post();
    ?>

    <div class="v-card-3 v-post">

        <article>

            <?php
                if (has_post_thumbnail()) :
            ?>

                <div class="v-card-1 v-thumb">
                    <?php the_post_thumbnail(); ?>
                </div>

                <div class="v-card-2">

            <?php
                else :
            ?>

                <div class="v-card-3">

            <?php
                endif;
            ?>

                <?php the_title('<h2>', '</h2>'); ?>
                <p><small>
                    Posted on <?php the_date(); ?> at <?php the_time(); ?> by <?php the_author(); ?>
                </small></p>
                <?php the_excerpt(); ?>

                <div class="read-more">
                    <a href="<?php the_permalink(); ?>">
                        Read more &gt;
                    </a>
                </div>

            </div>

        </article>

    </div>

    <?php
        endwhile;
    ?>

</div>

<?php get_footer(); ?>