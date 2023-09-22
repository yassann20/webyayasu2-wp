<?php get_header(); ?>

<main>
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
              <!--タイトルを取得２５文字以降は切り捨て-->
              <dt><?php echo mb_substr($post->post_title, 0, 25) . '…'; ?></dt>
            </a>
          </dl>
      <?php
        endwhile;
      endif; ?>
      <!--ここまで-->
    </div>
  </div>
  <div id="Content">
    <div id="Welcom">
      <h2>ようこそWEBYAYASUへ</h2>
      <div>
        <img src="<?php echo get_template_directory_uri(); ?>/photos/PC-img/welcome-img.jpg" alt="">
        <p>私は北海道札幌市を起点にフロントエンドエンジニアとして活動している安崎と申します。業務内容は主にホームページのコーディングやワードプレステーマの制作をさせていただいております。</p>
      </div>
    </div>
    <div id="Business">
      <h2>業務内容</h2>
      <ul>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/photos/PC-img/coding.png" alt="">

          <h3>コーディング業務</h3>
          <p>デザインカンプを元にアークアップ、プログラミングしていき最終的にインターネットで閲覧できるデータを制作します。</p>
        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/photos/PC-img/wordpress.png" alt="">

          <h3>WPテーマ制作</h3>
          <p>プログラミングしたデータを元にワードプレスのテーマを制作します。ブログや情報発信を行う場合など必須のツールです。</p>

        </li>
        <li>
          <img src="<?php echo get_template_directory_uri(); ?>/photos/PC-img/setting.png" alt="">

          <h3>保守・運営</h3>
          <p>サイト運用中の軽微なデザイン修正、また機能の追加などサイトに不都合が生じた際など、サイト運営に関するサポートをしています。</p>

        </li>
      </ul>
    </div>
    <div id="Achievement">
      <h2>作業実績</h2>
      <img class="pc" src="<?php echo get_template_directory_uri(); ?>/photos/PC-img/achievement.png" alt="">
      <img class="sp" src="<?php echo get_template_directory_uri(); ?>/photos/SP-img/achievement.jpg" alt="">
      <div>
        <p>これまで複数の案件に取り組ませていただきまして、その中で実績として記載可能なものをご紹介しております。</p>
        <a href="<?php echo home_url('/category/work'); ?>">実績</a>
      </div>
    </div>
    <div id="Activity">
      <h2>活動記録</h2>
      <img class="pc" src="<?php echo get_template_directory_uri(); ?>/photos/PC-img/activity.png" alt="">
      <img class="sp" src="<?php echo get_template_directory_uri(); ?>/photos/SP-img/activity.jpg" alt="">
      <div>
        <p>日々の業務、私生活での出来事などをご紹介しております。</p>
        <a href="<?php echo home_url('/news/'); ?>">お知らせ</a>
      </div>
    </div>
    <div id="Contact">
      <h2>お問い合わせ</h2>
      <form action="<?php echo home_url('/confirmation/'); ?>" class="top-border-none" method="post">
        <label for="">
          <h3>氏名</h3>
          <input type="text" name="nam" required>
        </label>
        <label for="">
          <h3>氏名(ふりがな)</h3>
          <input type="text" name="kana" required>
        </label>
        <label for="">
          <h3>メールアドレス</h3>
          <input type="email" name="mail" required>
        </label>
        <label for="">
          <h3>内容</h3>
          <textarea name="text" id="" cols="30" rows="10"></textarea>
        </label>
        <button type="submit" name="submit">送信</button>
      </form>
      <p id="Contact-alt">※ いたずら防止のためIPアドレスの保存をしております、ご容赦ください</p>
    </div>
  </div>
  <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>