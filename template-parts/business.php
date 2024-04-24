<?php 
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
?>

<div id="Business">
  <h2><?php echo get_option('section1-h2')?></h2>
  <ul>
    <li>
      <div class="img">
        <img class="section2-thumbnail-1" src="<?php echo get_theme_mod('section2_image1', get_template_directory_uri() . '/photos/PC-img/content2-img1.jpg'); ?>" alt="">
      </div>
      <h3 class="section2-h2-1"><?php echo get_theme_mod('section2-1-h2', $sec2h3txt[0]);?></h3>
      <p class="sec2maintxt1"><?php echo get_theme_mod('sec2_maintxt1', $sec2ptxt[0])?></p>
    </li>
    <li>
      <div class="img">
        <img class="section2-thumbnail-2" src="<?php echo get_theme_mod('section2_image2', get_template_directory_uri() . '/photos/PC-img/content2-img2.jpg'); ?>" alt="">
      </div>
      <h3 class="section2-h2-1"><?php echo get_theme_mod('section2-2-h2', $sec2h3txt[1]);?></h3>
      <p class="sec2maintxt2"><?php echo get_theme_mod('sec2_maintxt2', $sec2ptxt[1])?></p>
    </li>
    <li>
      <div class="img">
        <img class="section2-thumbnail-3" src="<?php echo get_theme_mod('section2_image3', get_template_directory_uri() . '/photos/PC-img/content2-img3.jpg'); ?>" alt="">
      </div>
      <h3 class="section2-h2-1"><?php echo get_theme_mod('section2-3-h2', $sec2h3txt[2]);?></h3>
      <p class="sec2maintxt3"><?php echo get_theme_mod('sec2_maintxt3', $sec2ptxt[2])?></p>
    </li>
  </ul>
</div>