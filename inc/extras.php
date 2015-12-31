<?php

/**
 * 打印数组
 *
 * @since 1.0.0
 *
 * @access public
 * @return void
 */
function dump()
{
    foreach(func_get_args() as $val) {
        // 如果值为 bollean 类型, 退出当前脚本
        if (is_bool($val) && $val === true) {
            exit();
        } else {
            echo '<pre>'.htmlspecialchars($val === null ? 'NULL' : (is_scalar($val) ? $val : print_r($val, true)), ENT_QUOTES)."</pre>";
        }
    }
}

if ( ! function_exists( 'sparkling_header_menu' ) ) :
/**
 * Header menu (should you choose to use one)
 */
function pure_header_menu() {
    wp_nav_menu(array(
        'menu'              => 'primary',
        'theme_location'    => 'primary',
        'container'         => 'div',
        'container_class'   => 'navbar-collapse collapse',
        'container_id'      => 'navbar',
        'menu_class'        => 'nav navbar-nav navbar-right',
        'fallback_cb'       => '',
        'walker'            => new wp_pure_navbar()
    ));
} // pure_header_menu
endif;