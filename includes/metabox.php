<?php

if( !class_exists( 'Ppvwc_Metabox' ) ):
class Ppvwc_Metabox {

    public $ppvwc_object;

    /**
     * Ppvwc_Metabox constructor.
     * @since 2.0
     * @version 2.1
     */
    public function __construct()
    {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ), 10, 2 );

        add_action( 'save_post', array( $this, 'save_post' ), 10, 3 );
    }

    /**
     * @param $post_type
     * @param $post
     * @since 2.0
     * @version 2.1
     */
    public function add_meta_box($post_type, $post )
    {
        if( $post_type == 'post' || $post_type == 'page' || $post_type == 'product' )
        {
            add_meta_box(
                'ppvwc-metabox',
                'Views Counter',
                array( $this, 'metabox_callback' ),
                $post_type,
                'side',
                'default'
            );
        }
    }

    /**
     * @since 2.0
     * @version 2.1
     */
    public function metabox_callback()
    {
        $views = (int)ppvwc_get_views();

        $content = "
        <label for='views-counts'>Views Counts</label>
        <input type='number' id='views-counts' name='ppvwc_counts' value='{$views}' />
        ";

        echo $content;
    }

    public function save_post( $post_ID, $post, $update )
    {
        if( $post->post_type == 'post' || $post->post_type == 'page' || $post->post_type == 'product' )
        {
            if ( isset( $_POST['ppvwc_counts'] ) )
            {
                $views = sanitize_text_field( $_POST['ppvwc_counts'] );
                $views = (int)$views;

                update_post_meta( $post_ID, 'papvfwc_counter', $views );
            }
        }
    }
}

new Ppvwc_Metabox();

endif;
