<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'astra-theme-css' ) );
        wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

function custom_menu_items($items, $args) {
    if ($args->theme_location === 'primary') {
        if (is_user_logged_in()) {
            // Construit manuellement le lien 'Admin'
            $admin_link = '<li id="menu-item-admin" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-admin">';
            $admin_link .= '<a href="http://localhost/Planty/wp-admin/index.php" class="admin-button">Admin</a>';
            $admin_link .= '</li>';

            // Trouve l'ID du deuxième élément ('Commander') dans le menu
            $order_id = wp_filter_object_list(wp_get_nav_menu_items('Principal'), array('title' => 'Commander'));
            $order_id = reset($order_id)->ID;

            // Trouve la position du deuxième élément dans le menu
            $position = strpos($items, '<li id="menu-item-' . $order_id . '"');

            // Insère le lien 'Admin' avant le deuxième élément
            if ($position !== false) {
                $items = substr_replace($items, $admin_link, $position, 0);
            }
        }

        return $items;
    }

    if ($args->theme_location === 'footer_menu') {
        return $items;
    }
}

add_filter('wp_nav_menu_items', 'custom_menu_items', 10, 2);
// END ENQUEUE PARENT ACTION
