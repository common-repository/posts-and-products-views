<?php
/**
 * @param string $post_id
 * @since 2.1
 * @version 1.0
 * @return string
 */
if ( !function_exists( 'ppvwc_get_views' ) ):
function ppvwc_get_views( $post_id = '' )
{
    $post_id = empty( $post_id ) ? get_the_ID() : $post_id;

    $count = get_post_meta( $post_id, 'papvfwc_counter', true );
    if ( $count > 0 )
        return "$count";
    else
        return '0';
}
endif;
