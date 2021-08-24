<?php


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style('generatepress', get_template_directory_uri() . '/style.css');
}

/////////////////////////////Custom_Post_Type///////////////////
include('cpt/cpt-projects.php');