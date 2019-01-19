<?php get_header(); ?>

<div class="v-row v-post">

    <!-- Sidebar -->
    <?php get_sidebar('404'); ?>

    <!-- Posts -->
    <div class="v-card-2">

       <h2 class="v-section-title">Search results</h2>

        <?php
            while (have_posts()) : 
                the_post();
        ?>

        <div class="v-card-3 v-post">

            <article>

                <div class="v-card-3">

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

</div>

<?php get_footer(); ?>