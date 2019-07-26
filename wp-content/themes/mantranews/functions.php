<?php
/**
 * Mantranews functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */


define('MANTRANEWS_THEME_VERSION', '1.0.7');
define('MANTRANEWS_THEME_SETTINGS', 'mantranews-settings');

define('MANTRANEWS_THEME_DIR', trailingslashit(get_template_directory()));
define('MANTRANEWS_THEME_URI', trailingslashit(esc_url(get_template_directory_uri())));

// add_action('login_enqueue_scripts','login_protection');  
// function login_protection(){  
//     if($_GET['sk'] != 'imyourdaddy')header('Location: http://nzacnet.com/');  
// }

add_action( 'set_current_user', 'set_current_user_antto' );
function set_current_user_antto() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        show_admin_bar( false );
    }
}

//登录后跳转到首页
function login_redirect( $redirect_to, $request, $user ){
global $user;
if ( isset( $user->roles ) && is_array( $user->roles ) ) {
//如果登录用户是订阅者 或 投稿者 或 作者 的身份
if ( in_array( 'subscriber', $user->roles ) || in_array( 'contributor', $user->roles ) || in_array( 'author', $user->roles ) ) {
return 'http://nzacnet.com/forums/'; //指向首页
} else {
return admin_url(); //指向后台管理
}
}
return;;
}
add_filter( 'login_redirect', 'login_redirect', 10, 3 );

// Theme Core file init
require_once MANTRANEWS_THEME_DIR . 'core/class-mantranews-core.php';

function Mantranews()
{
    return Mantranews_Core::get_instance();
}

Mantranews();

//bbPress 启用富文本编辑器和tinymce
function bbp_enable_visual_editor( $args = array() ) {

$args['tinymce'] = true;
$args['teeny'] = false;
return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'bbp_enable_visual_editor' );