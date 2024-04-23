<?php
session_start();
$_SESSION["number"] = 3; /* スライドショーの枚数 */

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

//スライドショーをカスタム投稿機能で編集できるようにする
function custom_slideshow(){
  register_post_type('images',
  array(
    'labels' => array(
      'name' => __('スライドショー画像'),
      'singular_name' => __('画像')
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'images'),
    'supports' => array('title', 'thumbnail'),
  ));
}
add_action('init', 'custom_slideshow');

//カスタマイザー付与
function theme_customize_register($wp_customize) {


    /* トップページ大見出し */
    $wp_customize->add_section('original_h1' , array(
      'title' => 'トップページ大見出し',
      'priority' => 10,
    ));
    $wp_customize->add_setting('original_txt', array(
      'type' => 'theme_mod',
      'default' => 'WEBYAYASU'//編集されない場合この文字列が出力される
    ));
   
    $wp_customize->add_control( 'original_txt', array(
      'settings' => 'original_txt',
      'label' => 'オリジナルテキスト',
      'section' => 'original_h1',
      'type' => 'text',
    ));
    $wp_customize->selective_refresh->add_partial('original_txt', array(
      'selector' => '.default-h1',
      'render_callback' => function(){
        echo '<h1>' . get_theme_mod('original_txt', 'WEBYAYASU') . '</h1>'; // レンダリングするコールバック関数を設定します
      }
    ));
    /* 大見出しここまで */

    /*business内のカスタマイザーを一つのパネルにまとめる*/
    $wp_customize->add_panel('business_panel', array(
      'title'       => __( '事業内容', 'textdomain' ),
    'description' => __( '事業内容に関するパネル', 'textdomain' ),
    'priority'    => 10,
    ));

    /* sectionの画像 */
    for( $i=1; $i<=3; $i++):
      $wp_customize->add_section('section2-img'.$i , array(
        'title' => 'セクションコンテンツ画像'.$i ,
        'priority' => 10,
        'panel' => 'business_panel',
      ));
      $wp_customize->add_setting('section2_image'.$i , array(
        'type' => 'theme_mod',
        'default' => get_template_directory_uri() . '/photos/PC-img/content2-img'.$i.'.jpg',

      ));
      if(class_exists('WP_Customize_Image_Control')):
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'section2_image'.$i , array(
          'settings' => 'section2_image'.$i ,
          'label' => 'オリジナル画像'.$i ,
          'section' => 'section2-img'.$i ,
          'type' => 'image',
        )));
        endif;
      endfor;
    /* sectionの画像ここまで */

    $sec2h3txt = [
      'コーディング',
      'ワードプレス',
      '保守・管理',
    ];
    /* sectionの見出し*/
    for($i = 1; $i <= 3; $i++){
      $wp_customize->add_section('section_li_text'.$i , array(
        'title' => '(セクション'.$i.')見出し',
        'priority' => 20,
        'panel' => 'business_panel',
      ));
      $wp_customize->add_setting('section2-'.$i.'-h2', array(
        'type' => 'option',
        'default' => $sec2h3txt[$i-1],
      ));
      $wp_customize->add_control('section2-'.$i.'-h2', array(
        'settings' => 'section2-'.$i.'-h2',
        'label' => 'オリジナルテキスト',
        'section' => 'section_li_text'.$i,
        'type' => 'text',
      ));
      $wp_customize->selective_refresh->add_partial('section2-'.$i.'-h2', array(
        'selector' => '.section2-h2-'.$i,
        'render_callback' => function() use ($i){
          echo '<h2>' . get_theme_mod('section2-'.$i.'-h2', 'WEBYAYASU') . '</h2>'; // レンダリングするコールバック関数を設定します
        }
      ));
    }
    /* section2見出しここまで */


    /* sectionの見出し*/
    $sec2ptxt = [
      '(セクション1)見出し',
      '(セクション2)見出し',
      '(セクション3)見出し',
    ];
    for($i = 1; $i <= 3; $i++){
      $wp_customize->add_section('section'.$i."h2" , array(
        'title' => '(セクション'.$i.')見出し',
        'priority' => 30,
      ));
      $wp_customize->add_setting('section'.$i.'-h2', array(
        'type' => 'option',
      ));
      $wp_customize->add_control('section'.$i.'-h2', array(
        'settings' => 'section'.$i.'-h2',
        'label' => 'オリジナルテキスト',
        'section' => 'section'.$i."h2",
        'type' => 'text',
      ));
    }
    /* section見出しここまで */

    /* section　本文*/
    $maintext_array = [
      '(セクション1)本文',
      '(セクション2)本文',
      '(セクション3)本文',
      '(セクション4)本文',
    ];
    for($i = 1; $i <= count($maintext_array); $i++){
      $wp_customize->add_section('sec'.$i.'-maintext' , array(
        'title' => '(セクション'.$i.')本文',
        'priority' => 30,
      ));
      $wp_customize->add_setting('sec'.$i.'_maintext', array(
        'type' => 'option',
      ));
      $wp_customize->add_control('sec'.$i.'_maintext', array(
        'settings' => 'sec'.$i.'_maintext',
        'label' => 'オリジナルテキスト',
        'section' => 'sec'.$i.'-maintext',
        'type' => 'textarea',
      ));
    }
    /* section　本文ここまで*/


    /* section　本文*/
    $sectionbutton_array = [
      '(セクション3)本文',
      '(セクション4)本文',
    ];
    for($i = 1; $i <= count($sectionbutton_array); $i++){
      $wp_customize->add_section('sec'.$i.'-button' , array(
        'title' => 'セクションボタン'.$i,
        'priority' => 30,
      ));
      $wp_customize->add_setting('sec'.$i.'_button', array(
        'type' => 'option',
      ));
      $wp_customize->add_control('sec'.$i.'_button', array(
        'settings' => 'sec'.$i.'_button',
        'label' => 'オリジナルテキスト',
        'section' => 'sec'.$i.'-button',
        'type' => 'text',
      ));
    }
    /* section　本文ここまで*/

  /* リストコンコンテンツ画像　*/
  for( $i=1; $i<=$num; $i++):
  $wp_customize->add_section('list-img'.$i , array(
    'title' => 'リストコンテンツ画像'.$i ,
    'priority' => 30,
  ));
  $wp_customize->add_setting('original_list_image'.$i , array(
    'type' => 'option',
  ));
  if(class_exists('WP_Customize_Image_Control')):
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'original_list_image'.$i , array(
      'settings' => 'original_list_image'.$i ,
      'label' => 'オリジナル画像'.$i ,
      'section' => 'list-img'.$i ,
      'description' => 'リスト内の画像を選択してください',
    )));
    endif;
  endfor;
  /* リストコンテンツ画像 */
  

    /* section2リストごとのテキスト*/
    $sec1_li_array = [
      'section2内li見出し',
      'section2内li見出し',
      'section2内li見出し',
    ];
    for($i = 1; $i <= count($sec1_li_array); $i++){
      $wp_customize->add_section('section_li_h3'.$i , array(
        'title' => 'リストコンテンツ内見出し'.$i,
        'priority' => 30,
      ));
      $wp_customize->add_setting('section2_li'.$i.'-h3', array(
        'type' => 'option',
      ));
      $wp_customize->add_control('section2_li'.$i.'-h3', array(
        'settings' => 'section2_li'.$i.'-h3',
        'label' => 'オリジナルテキスト',
        'section' => 'section_li_h3'.$i,
        'type' => 'text',
      ));
    }
    /* section2テキストここまで */


    /* section2リストごとのテキスト*/
    $sec1_li_array = [
      'section2内liテキスト',
      'section2内liテキスト',
      'section2内liテキスト',
    ];
    for($i = 1; $i <= count($sec1_li_array); $i++){
      $wp_customize->add_section('section_li_text'.$i , array(
        'title' => 'section2内テキスト'.$i,
        'priority' => 30,
      ));
      $wp_customize->add_setting('section2_li'.$i.'-text', array(
        'type' => 'option',
      ));
      $wp_customize->add_control('section2_li'.$i.'-text', array(
        'settings' => 'section2_li'.$i.'-text',
        'label' => 'オリジナルテキスト',
        'section' => 'section_li_text'.$i,
        'type' => 'textarea',
      ));
    }
    /* section2テキストここまで */
    // セレクティブリフレッシュを有効にする
    add_theme_support( 'customize-selective-refresh' );
}
add_action( 'customize_register', 'theme_customize_register' );

