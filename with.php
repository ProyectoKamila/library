<?php 
if(YITH_WCWL_UI){
class MY_YITH extends YITH_WCWL_UI{

    public static function add_to_wishlist_button( $url, $product_type, $exists ) {
        global $yith_wcwl, $product;

        $label = apply_filters( 'yith_wcwl_button_label', get_option( 'yith_wcwl_add_to_wishlist_text' ) );
        $icon = get_option( 'yith_wcwl_add_to_wishlist_icon' ) != 'none' ? '<i class="' . get_option( 'yith_wcwl_add_to_wishlist_icon' ) . '"></i>' : '';

        $classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';

        $html  = '<div class="yith-wcwl-add-to-wishlist">';
        $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

        $html .= $exists ? ' hide" style="display:none;"' : ' show"';

        $html .= '><a href="' . esc_url( $yith_wcwl->get_addtowishlist_url() ) . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' ><span class="glyphicon glyphicon-heart" aria-hidden="true" style="/*padding: 12px 0px !important;*/color: black;"></span></a>';
//        $html .= '<img src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" class="ajax-loading" id="add-items-ajax-loading" alt="" width="16" height="16" style="visibility:hidden" />';
        $html .= '</div>';

        $html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url( $url ) . '"></a></div>';
        $html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '"></a></div>';
        $html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

        $html .= '</div>';
        $html .= '<div class="clear"></div>';

        return $html;
	}
        
        
    public static function add_to_cart_button( $product_id, $stock_status ) {
        global $yith_wcwl;

        if ( function_exists( 'get_product' ) )
            $product = get_product( $product_id );
        else
            $product = new WC_Product( $product_id );

        $url = $product->product_type == 'external' ? $yith_wcwl->get_affiliate_product_url( $product_id ) : $yith_wcwl->get_addtocart_url( $product_id );
        $label = $product->product_type == 'variable' ? apply_filters( 'variable_add_to_cart_text', __('Select options', 'yit') ) : apply_filters( 'yith_wcwl_add_to_cart_label', get_option( 'yith_wcwl_add_to_cart_text' ) );
        $icon = get_option( 'yith_wcwl_use_button' ) == 'yes' && get_option( 'yith_wcwl_add_to_cart_icon' ) != 'none' ? '<i class="' . get_option( 'yith_wcwl_add_to_cart_icon' ) . '"></i>' : '';

        $cartlink = '';
        $redirect_to_cart = get_option( 'yith_wcwl_redirect_cart' ) == 'yes' && $product->product_type != 'variable' ? 'true' : 'false';
        $style = ''; //indicates the style (background-color and font color)

        if( get_option( 'yith_wcwl_use_button' ) == 'yes' ) {
            if( $product->product_type == 'external' ) {
                $cartlink .= '<a target="_blank" class="add_to_cart button alt" href="' . $url . '"';
            } else {
                $js_action = esc_attr( 'check_for_stock(\'' . $url . '\',\'' . $stock_status . '\',\'' . $redirect_to_cart . '\');' );
                $cartlink .= '<a class="add_to_cart button alt" onclick="' . $js_action . '"';
            }

            $cartlink .= $style . '>' . $icon . $label . '</a>';
        } else {
            if( $product->product_type == 'external' ) {
                $cartlink .= '<a target="_blank" class="add_to_cart button alt" href="' . $url . '">' . $icon . $label . '</a>';
            } else {
                $js_action = esc_attr( 'check_for_stock(\'' . $url . '\',\'' . $stock_status . '\',\'' . $redirect_to_cart . '\');' );
                $cartlink .= '<a class="add_to_cart button alt" href="javascript:void(0);" onclick="' . $js_action . '">' . $icon . $label . '</a>';
            }
        }

        return $cartlink;
    }
}
}