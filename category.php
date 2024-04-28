<?php get_header(); ?>

<!--カテゴリー名下準備-->
<div class="main-container">
    <main>
        <div id="Content">
            <div id="achive-news">
                <h2><?php echo $catname; ?>一覧</h2>
                <!--ワークスの場合は以下のtext-->
                <?php if (is_category('works')) : ?>
                    <p>実績をご紹介しております、なおクライアント様の意向により制作したデータを見せられないものがありますのでご容赦ください。</p>
                    <!--ポートフォリオの場合は下記を表示-->
                <?php elseif (is_category('portfolio')) : ?>
                    <p>どのようなサイトを作ることができるのか、実際にアップロードしたURLとデザインカンプを元にご紹介しています。</p>
                    <!--あてはまらない場合は下記-->
                <?php else : ?>
                    <p>ブログ記事をカテゴリーごとにまとめています。</p>
                <?php endif; ?>
                <div id="all-category">
                    <!--現在あるカテゴリータグをすべて生成-->
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category) {
                        echo '<dd class="category"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                    }
                    ?>
                </div>
                <!--記事取得処理-->
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                ?>
                        <dl>
                            <!--パーマリンクを取得-->
                            <!--記事のパーマリンクをaタグにあてはめる-->
                            <a class="achive-a" href="<?php echo get_permalink(); ?>">
                                <!--サムネイル表示、ない場合はnoimg.jpgを表示-->
                                <div class="img">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail(); ?>
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/photos/PC-img/singlesample.jpg" alt="">
                                    <?php endif; ?>
                                </div>
                                <!--ここまで-->
                                <div class="achive-left">
                                    <!--本文を取得５０文字以降は切り捨て-->
                                    <dt><?php echo mb_substr(get_the_excerpt(), 0, 50) . '…'; ?></dt>
                                    <!--カテゴリー名を取得-->
                                    <dd class="category"><?php the_category(', ') ?></dd>
                                    <div class="time-date">
                                        <img class="time-img" src="<?php echo get_template_directory_uri(); ?>/photos/PC-img/time-img.jpg" alt="">
                                        <!--投稿日を取得-->
                                        <dd><?php echo get_the_date('Y.m.d'); ?></dd>
                                    </div>
                                </div>
                            </a>
                        </dl>
                <?php
                    endwhile;
                endif; ?>
                <div id="Page-controll">
                    <!--記事がページ限界になったら次のページへのリンクを生成-->
                    <?php the_posts_pagination(); ?>
                </div>
            </div>
            <!--contactコンテンツの読み込み-->
            <?php get_template_part('template-parts/contact'); ?>
    </main>

    <?php get_sidebar(); ?>

    <?php get_footer(); ?>