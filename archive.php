<?php get_header(); ?>

<div class="main-container">
    <main>
        <div id="Content">
            <div id="achive-news">
                <h2>お知らせ一覧</h2>
                <p>こちらのページでは日々の仕事での出来事などをご紹介しています。
                </p>
                <div id="all-category">
                    <!--カテゴリー別記事一覧取得処理-->
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category) {
                        /*記事のURLをaタグへ出力*/
                        echo '<dd class="category"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                    }
                    ?>
                </div>
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                ?>
                        <dl>
                            <!--記事のパーマリンクをaタグにあてはめる-->
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
                <!--ここまで-->
                <div id="Page-controll">
                    <!--投稿記事が限界まで来たら次のページを作成-->
                    <?php the_posts_pagination(); ?>
                </div>
            </div>

            <!--contactコンテンツの読み込み-->
            <?php get_template_part('template-parts/contact'); ?>
    </main>
    <?php get_sidebar(); ?>


    <?php get_footer(); ?>