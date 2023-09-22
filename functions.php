<?php
function webst8_setup()
{
    //ここに関数の中身を記述します。
    add_theme_support('post-thumbnails'); //アイキャッチ画像をON
    add_theme_support('menus');  //メニュー機能をON
}
add_action('after_setup_theme', 'webst8_setup');
//最後に作成したafter_setup_themeアクションフック※に登録します。
function post_has_archive($args, $post_type)
{

    if ('post' == $post_type) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'news'; //任意のスラッグ名
    }
    return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

function my_session_start()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $_SESSION['foo'] = 'var';
}
add_action('init', 'my_session_start');


//前の記事・次の記事のリンクにclassを付与する
function add_prev_post_link_class($output) {
  return str_replace('<a href=', '<a id="Prev-page" href=', $output); //前の記事リンク
}
add_filter( 'previous_post_link', 'add_prev_post_link_class' );
function add_next_post_link_class($output) {
  return str_replace('<a href=', '<a id="Next-page" href=', $output); //次の記事リンク
}
add_filter( 'next_post_link', 'add_next_post_link_class' );
//カスタマイザー付与
add_action( 'customize_register', 'theme_customize_register' );
function theme_customize_register($wp_customize) {
  /* セクション追加 */
  $wp_customize->add_setting('original_image', array(
    'type' => 'option',
  ));
if(class_exists('WP_Customize_Image_Control')):
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'original_image', array(
    'settings' => 'original_image',
    'label' => 'オリジナル画像',
    'section' => 'original_custom',
  )));
endif;
 
}