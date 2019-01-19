<?php get_header(); ?>

<div class="v-row v-post">

    <!-- Sidebar -->
    <?php get_sidebar('prepared_food'); ?>

    <!-- Posts -->
    <div class="v-card-2">

        <h2 class="v-section-title"><?php single_term_title() ?></h2>

        <?php
            while (have_posts()) : 
                the_post();
        ?>

        <div class="v-card-3 v-post">

            <article>

                <div class="v-card-1 v-thumb">
                    <?php the_post_thumbnail(); ?>
                </div>

                <div class="v-card-2">

                    <?php the_title('<h2>', '</h2>'); ?>
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

</div>

<?php get_footer(); ?>