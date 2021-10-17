<?php

class Rest_Project_API extends WP_REST_Controller
{
    /**
     * Register the routes for the objects of the controller.
     */
    public function register_routes()
    {
        $version = '1';
        $namespace = '/vuefolio/v' . $version;
        $base = 'project';
        register_rest_route($namespace, '/' . $base.'/get_items', array(
            array(
                'methods' => WP_REST_Server::READABLE,
                'callback' => array($this, 'get_items'),
//                'permission_callback' => array($this, 'get_items_permissions_check'),
                //'args' => array(),
            ),
//            array(
//                'methods' => WP_REST_Server::CREATABLE,
//                'callback' => array($this, 'create_item'),
//                'permission_callback' => array($this, 'create_item_permissions_check'),
//                'args' => $this->get_endpoint_args_for_item_schema(true),
//            ),
        ));

         register_rest_route($namespace, '/' . $base . '/get_item/(?P<id>[\d]+)', array(
             array(
                 'methods' => WP_REST_Server::READABLE,
                 'callback' => array($this, 'get_item'),
                /* 'permission_callback' => array($this, 'get_item_permissions_check'),
                 'args' => array(
                     'context' => array(
                         'default' => 'view',
                     ),
                 ),*/
             ),
 //
         ));

    }
    public function get_item( $request ) {
        $params = $request->get_params();
//        $args = array(
//            'post_ID'=>$params['id'],
//            'post_per_page' => -1,
//            'post_type' => "project",
//            'post_status' => "publish",
//            );

        $post = get_post($params['id'], "project");

        $data = array();

        if ( empty( $post ) ) {
            return rest_ensure_response( $data );
        }

        $data=(object)array(
            'id' => $post->ID,
            'title'=> $post->post_title,
            'img_url'=> get_the_post_thumbnail_url($post->ID, 'large'),
            'tags' =>  get_field('tags',$post->ID),
            'description' =>  get_field('description',$post->ID)
        );

        return new WP_REST_Response( $data, 200 );

    }
    public function get_items( $request ) {
        $args = array(
            'post_per_page' => -1,
            'post_type' => "project",
            'post_status' => "publish",
        );

        $posts = get_posts( $args );

        $data = array();

        if ( empty( $posts ) ) {
            return rest_ensure_response( $data );
        }

        foreach ( $posts as $post ) {
            //$response = $this->prepare_item_for_response( $post, $request );
            //$data[] = $this->prepare_response_for_collection( $response );
            $data[]=array(
                'id' => $post->ID,
                'title'=> $post->post_title,
                'img_url'=> get_the_post_thumbnail_url($post->ID, 'medium'),
                'tags' =>  get_field('tags',$post->ID),
            );
        }

        return new WP_REST_Response( $data, 200 );
    }
}
