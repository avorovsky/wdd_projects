<?php get_header(); ?>

<div class="v-row v-post">

    <!-- Sidebar -->
    <?php get_sidebar('testemonials'); ?>

    <!-- Posts -->
    <div class="v-card-2">

        <h2 class="v-section-title"><?php single_term_title() ?></h2>

        <?php
            while (have_posts()) : 
                the_post();
        ?>

            <?php
                if (has_post_thumbnail()) :
            ?>

                <div class="v-card-1">
                    <?php the_post_thumbnail(); ?>
                </div>

                <div class="v-card-2 v-post">

            <?php
                else :
            ?>

                <div class="v-card-3 v-post">

            <?php
                endif;
            ?>
 
            <blockquote>
                <?=get_the_content(); ?>
            </blockquote>

            <cite>
                <?=get_the_title(); ?>
            </cite>

        </div>

        <?php
            endwhile;
        ?>

    </div>

</div>

<?php get_footer(); ?>