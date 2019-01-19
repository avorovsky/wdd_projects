<?php
/**
 * Make category use parent category template
 * Source: http://werdswords.com/force-sub-categories-use-the-parent-category-template/
 *
 * @return string
 */

function load_cat_parent_template($template) {

    $cat_ID = absint( get_query_var('cat') );
    $category = get_category( $cat_ID );

    $templates = array();

    if ( !is_wp_error($category) )
        $templates[] = "category-{$category->slug}.php";

    $templates[] = "category-$cat_ID.php";

    // trace back the parent hierarchy and locate a template
    if ( !is_wp_error($category) ) {
        $category = $category->parent ? get_category($category->parent) : '';

        if( !empty($category) ) {
            if ( !is_wp_error($category) )
                $templates[] = "category-{$category->slug}.php";

            $templates[] = "category-{$category->term_id}.php";
        }
    }

    $templates[] = "category.php";
    $template = locate_template($templates);

    return $template;
}
add_action('category_template', 'load_cat_parent_template');