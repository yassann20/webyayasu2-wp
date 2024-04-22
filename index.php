<?php get_header(); ?>

  <div id="News">
    <h2>お知らせ</h2>
    <div>
      <!--最新記事を3つ取得し、NEWSに出力-->
      <?php
      query_posts('posts_per_page=3');
      if (have_posts()) :
        while (have_posts()) :
          the_post();

          $cat = get_the_category();
          $catname = $cat[0]->cat_name;
      ?>
          <dl>
            <!--パーマリンクを取得-->
            <a href="<?php echo get_permalink(); ?>">
            <!--投稿日を取得-->
              <dd class="dd1"><?php echo get_the_date('Y.m.d'); ?></dd>
              <!--カテゴリー名を取得-->
              <dd class="category"><?php echo $catname; ?></dd>
              <!--タイトルを取得60文字以降は切り捨て-->
              <dt><?php echo mb_substr($post->post_title, 0, 60) . '…'; ?></dt>
            </a>
          </dl>
      <?php
        endwhile;
      endif; ?>
      <!--ここまで-->
    </div>
  </div>
  <div class="main-container">
  <main>
  <div id="Content">

    <!--wellcomeコンテンツの読み込み-->
    <?php get_template_part('template-parts/wellcome'); ?>

    <!--businessコンテンツの読み込み-->
    <?php get_template_part('template-parts/business'); ?>

    <!--achievementコンテンツの読み込み-->
    <?php get_template_part('template-parts/achievement'); ?>

    <!--activityコンテンツの読み込み-->
    <?php get_template_part('template-parts/activity'); ?>

    <!--contactコンテンツの読み込み-->
    <?php get_template_part('template-parts/contact'); ?>

  </main>
  <?php get_sidebar(); ?>


<?php get_footer(); ?>