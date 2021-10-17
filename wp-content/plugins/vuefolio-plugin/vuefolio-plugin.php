<?php
/*
Plugin Name: vuefolio-plugin
Description: API REST pour requêtes venant front en vue.js vuefolio
Author:       Swann
Author URI:   https://github.com/Swann606
Version:      1.0.0
*/


add_action( 'rest_api_init', function () {
    include 'Rest_Project_API.php';

    $myRoutes = new Rest_Project_API();

    $myRoutes->register_routes();
});


