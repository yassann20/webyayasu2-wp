<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <header>
    <div class="slider">
      <div>
      <a href="<?php echo home_url(); ?>">
      <img src="<?php echo get_option('original_image1')?>">
      </a>
      </div>
      <div>
      <a href="<?php echo home_url(); ?>">
      <img src="<?php echo get_option('original_image2')?>">
      </a>
      </div>
      <div>
      <a href="<?php echo home_url(); ?>">
      <img src="<?php echo get_option('original_image3')?>">
      </a>
      </div>
    </div>
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