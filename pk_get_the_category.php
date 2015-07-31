<?php

function pk_get_the_category($id = false, $cat) {
    $categories = get_the_terms($id, $cat);
//    debug($categories);
    if (!$categories || is_wp_error($categories))
        $categories = array();

    return $categories = array_values($categories);

    
    }