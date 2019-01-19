<?php get_header(); ?>

        <div class="v-row">

            <div class="v-card-3 v-post">

                <?php
                    if (have_posts()) : 
                        the_post();
                ?>

                    <!-- Post/page -->
                    <article>

                        <?php the_title('<h1>', '</h1>'); ?>

                        <?php the_post_thumbnail(); ?>
                        
                        <?php the_content('<div>', '</div>'); ?>

                    </article>

                <?php
                    endif;
                ?>

            </div>

        </div>

<?php get_footer(); ?>