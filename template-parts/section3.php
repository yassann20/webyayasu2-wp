<?php
$sec3image = [
  '/photos/PC-img/content3-img1.jpg',
  '/photos/PC-img/content3-img2.jpg'
];
$sec3h2txt = [
  '作業実績',
  '活動記録',
];
$sec3maintxt = [
  'これまで複数の案件に取り組ませていただきまして、その中で実績として添付できる物をご紹介しております。',
  '日々の業務での出来事、技術の習得などを記録しています。',
];
?>
<div id="Achievement">
  <h2 class="section3-h2-1"><?php echo get_theme_mod('sec3-h2-1', $sec3h2txt[0]); ?></h2>
  <img class="pc" src="<?php echo get_theme_mod("sec3_img_1", get_template_directory_uri().$sec3image[0]); ?>" alt="">
  <div>
    <p class="section3-p-1"><?php echo get_theme_mod('sec3-p-1', $sec3maintxt[0]); ?></p>
    <a href="<?php echo home_url('/category/work'); ?>">詳細</a>
  </div>
</div>
<div id="Activity">
<h2 class="section3-h2-2"><?php echo get_theme_mod('sec3-h2-2', $sec3h2txt[1]); ?></h2>
<img class="pc" src="<?php echo get_theme_mod("sec3_img_2", get_template_directory_uri().$sec3image[1]); ?>" alt="">
  <div>
  <p class="section3-p-2"><?php echo get_theme_mod('sec3-p-2', $sec3maintxt[1]); ?></p>
    <a href="<?php echo home_url('/news/'); ?>">詳細</a>
  </div>
</div>