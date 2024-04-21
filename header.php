<?php session_start(); /*スライド枚数を読み込むために追加*/?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, user-scalable=no" />
  <title>WEBYAYASU.COMは札幌市を中心にウェブ制作を個人で請け負っています。デザイン、コーディング、WPテーマ制作などお気軽にご相談ください。</title>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sanitize.css">
  <!--------------------CSS------------------------------------------------------------------------------------------>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
  <!----------------------------------------------------------------------------------------------------------------> 
  <?php if( is_page('confirmation') || is_page('semdmail')) :?>
    <style>
        #Content{
          width: 1300px !important; 
        }
    </style>
    <?php endif; ?>
  <?php wp_head(); ?>
</head>

<body>
  <div class="bg">
    <div id="particles-js">
    </div>
  </div>
  <div class="container">
  <header>
    <h1 class="default_h1"><?php echo get_theme_mod('')?></h1>
    <!--slickを使用したスライダーを表示-->
    <div class="slider">
      <?php
      $args = array(
        'post_type' => 'images',//スライドショーの投稿を選択
        'posts_per_page' => -1 //すべての投稿を出力
      );
      $slider_query = new WP_Query($args);

      if($slider_query->have_posts()):
        while($slider_query->have_posts()) : $slider_query->the_post();
      ?>
      <div class="img">
        <?php the_post_thumbnail(); ?>
      </div>
      <?php
        endwhile;
      endif;
      ?>
    </div>
    <!--slickスライドはここまで-->
    <nav id="nav">
      <?php
      $args = array(
        'container' => false,
      );
      wp_nav_menu($args);
      ?>
    </nav>
    <div id="Hum-menu">
          <span id="span1"></span>
          <span id="span2"></span>
          <span id="span3"></span>
        </div>
  </header>