<?php
function pk_get_cat_ID( $cat_name, $cat ) {
    $cat = get_term_by( 'slug', $cat_name, $cat );
    if ( $cat )
        return $cat->term_id;
    return 0;
}