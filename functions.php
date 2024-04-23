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
    /*section2本文*/
    $sec2ptxt = [
      'デザインカンプを元にアークアップ、プログラミングしていき最終的にインターネットで閲覧できるデータを制作します。',
      'プログラミングしたデータを元にワードプレスのテーマを制作します。ブログや情報発信を行う場合など必須のツールです。',
      'サイト運用中の軽微なデザイン修正、また機能の追加などサイトに不都合が生じた際の保守やブログ更新などを行います。'
    ];
    /* sectionの見出し*/
    for($i = 1; $i <= 3; $i++){
      $wp_customize->add_section('section_li_text'.$i , array(
        'title' => 'セクション2-'.$i.'見出し',
        'priority' => 20,
        'panel' => 'business_panel',
      ));
      $wp_customize->add_setting('section2-'.$i.'-h2', array(
        'type' => 'theme_mod',
        'default' => $sec2h3txt[$i-1],
      ));
      $wp_customize->add_control('section2-'.$i.'-h2', array(
        'settings' => 'section2-'.$i.'-h2',
        'label' => 'セクション2-'.$i.'見出し',
        'section' => 'section_li_text'.$i,
        'type' => 'text',
      ));
      $wp_customize->selective_refresh->add_partial('section2-'.$i.'-h2', array(
        'selector' => '.section2-h2-'.$i,
        'render_callback' => function() use ($i){
          echo '<h2>' . get_theme_mod('section2-'.$i.'-h2', 'WEBYAYASU') . '</h2>'; // レンダリングするコールバック関数を設定します
        }
      ));
      /*見出しはここまで*/
      /*ここからは本文を記載*/
      $wp_customize->add_section('sec2maintxt'.$i, array(
        'title' => 'セクション2本文'.$i,
        'priority' => 30,
        'panel' => 'business_panel',
      ));
      $wp_customize->add_setting('sec2_maintxt'.$i, array(
        'type' => 'theme_mod',
        'default' => $sec2ptxt[$i-1],
      ));
      $wp_customize->add_control('sec2_maintxt'.$i, array(
        'settings' => 'sec2_maintxt'.$i,
        'label' => 'セクション2本文'.$i,
        'section' => 'sec2maintxt'.$i,
        'type' => 'textarea',
      ));
      $wp_customize->selective_refresh->add_partial('sec2_maintxt'.$i, array(
        'selector' => '.sec2maintxt'.$i,
        'render_callback' => function() use ($i){
          echo '<p class="sec2-maintxt-"'.$i.'>' . get_theme_mod('sec2_maintxt'.$i) . '</p>'; // レンダリングするコールバック関数を設定します
        }
      ));
    }
    /*section2本文ここまで*/

    /*section3コンテンツをまとめるパネルを追加*/
    $wp_customize->add_panel('section3', array(
      'title' => 'コンテンツ3',
      'priority' => 20,
    ));

    /*sec3内で使用するデフォルトテキスト*/
    $sec3h2txt = [
      '作業実績',
      '活動記録',
    ];
    $sec3maintxt = [
      'これまで複数の案件に取り組ませていただきまして、その中で実績として添付できる物をご紹介しております。',
      '日々の業務での出来事、技術の習得などを記録しています。',
    ];
    for( $i = 1; $i <= 2; $i++){
      $wp_customize->add_section('sec3-img-'.$i, array(
        'title' => 'セクション3画像'.$i,
        'priority' => 10,
        'panel' => 'section3',
      ));
      $wp_customize->add_setting('sec3_img_'.$i, array(
        'type' => 'theme_mod',
        'default' => get_template_directory_uri().'/photos/PC-img/content3-img'.$i.'.jpg',
      ));
      if(class_exists('WP_Customize_Image_Control')){
        $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'sec3_img_'.$i, array(
          'settings' => 'sec3_img_'.$i ,
          'label' => 'セクション3画像'.$i ,
          'section' => 'sec3-img-'.$i ,
          'type' => 'image',
        )));
      }

      /*sec3見出し*/
      $wp_customize->add_section('sec3-h2-'.$i , array(
        'title' => 'セクション3-見出し'.$i,
        'priority' => 20,
        'panel' => 'section3',
      ));
      $wp_customize->add_setting('sec3-h2-'.$i, array(
        'type' => 'theme_mod',
        'default' => $sec3h2txt[$i-1],
      ));
      $wp_customize->add_control('sec3-h2-'.$i, array(
        'settings' => 'sec3-h2-'.$i,
        'label' => 'セクション3-見出し'.$i,
        'section' => 'sec3-h2-'.$i,
        'type' => 'text',
      ));
      $wp_customize->selective_refresh->add_partial('sec3-h2-'.$i, array(
        'selector' => '.section3-h2-'.$i,
        'render_callback' => function() use ($i){
          echo '<h2>' . get_theme_mod('sec3-h2-'.$i) . '</h2>'; // レンダリングするコールバック関数を設定します
        }
      ));

      /*sec3本文*/
      $wp_customize->add_section('sec3-p-'.$i , array(
        'title' => 'セクション3本文'.$i,
        'priority' => 20,
        'panel' => 'section3',
      ));
      $wp_customize->add_setting('sec3-p-'.$i, array(
        'type' => 'theme_mod',
        'default' => $sec3maintxt[$i-1],
      ));
      $wp_customize->add_control('sec3-p-'.$i, array(
        'settings' => 'sec3-p-'.$i,
        'label' => 'セクション3本文'.$i,
        'section' => 'sec3-p-'.$i,
        'type' => 'text',
      ));
      $wp_customize->selective_refresh->add_partial('sec3-p-'.$i, array(
        'selector' => '.section3-p-'.$i,
        'render_callback' => function() use ($i){
          echo '<h2>' . get_theme_mod('sec3-p-'.$i) . '</h2>'; // レンダリングするコールバック関数を設定します
        }
      ));
    }
    /*プロフィール自己紹介文*/
    $wp_customize->add_section('profile-text' , array(
      'title' => '自己紹介本文',
      'priority' => 20,
    ));
    $wp_customize->add_setting('profile-text', array(
      'type' => 'theme_mod',
      'default' => '初めまして。私は札幌市を中心にウェブサイトの制作業務を請け負っています。迅速かつハイクオリティを目標に活動しています。ご縁がありましたら是非ともよろしくお願いいたします。',
    ));
    $wp_customize->add_control('profile-text', array(
      'settings' => 'profile-text',
      'label' => '自己紹介本文',
      'section' => 'profile-text',
      'type' => 'textarea',
    ));
    $wp_customize->selective_refresh->add_partial('profile-text', array(
      'selector' => '.profile-text',
      'render_callback' => function() use ($i){
        echo '<p>' . get_theme_mod('profile-text') . '</p>'; // レンダリングするコールバック関数を設定します
      }
    ));
    // セレクティブリフレッシュを有効にする
    add_theme_support( 'customize-selective-refresh' );
}
add_action( 'customize_register', 'theme_customize_register' );

