<!doctype html>

<html <?php language_attributes(); ?>>

    <head>

        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title><?=get_bloginfo('name')?></title>

        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>>

        <div class="v-wrapper">

            <!-- Utilities bar -->
            <?php wp_nav_menu(['menu' => 'utils', 'container_class' => 'v-utils', 'menu_class' => 'menu' ]) ?>

            <a class="v-social" href="https://facebook.com" title="Follow us">
                <i class="fa fa-facebook-square"></i>
            </a>
            <a class="v-social" href="https://twitter.com" title="Follow us">
                <i class="fa fa-twitter-square"></i>
            </a>

            <!-- Header logo/banner -->
            <div class="v-header">
                <a href="/" title="Home page">
                    <img src="<?=get_stylesheet_directory_uri()?>/images/header_left.png" alt="Westland logo" />
                </a>
            </div>
                
            <!-- Navigation bar -->
            <?php wp_nav_menu(['menu' => 'main', 'container_class' => 'v-nav', 'menu_class' => 'menu' ]) ?>
