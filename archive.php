<?php get_header(); ?>

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

                    $cat = get_the_category();
                    $catname = $cat[0]->cat_name;
            ?>
                    <dl>
                        <!--記事のパーマリンクをaタグにあてはめる-->
                        <a href="<?php echo get_permalink(); ?>">
                            <!--サムネイル表示、ない場合はnoimg.jpgを表示-->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="news-img" style="background-image: url('<?php the_post_thumbnail_url('thumbnail'); ?>');"></div>
                            <?php else : ?>
                                <div class="news-img" style="background-image: url('<?php echo get_template_directory_uri(); ?>/photos/PC-img/singlesample.jpg');"></div>
                            <?php endif; ?>
                            <div>
                                <!--本文を取得７０文字以降は切り捨て-->
                                <dt><?php echo mb_substr(get_the_excerpt(), 0, 70) . '…'; ?></dt>
                                <!--カテゴリー名を取得-->
                                <dd class="category"><?php echo $catname; ?></dd>
                                <div>
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
        <div id="Contact">
            <h2>お問い合わせ</h2>
            <form action="<?php echo home_url('/confirmation/'); ?>" class="top-border-none" method="post">
                <label for="">
                    <h3>氏名</h3>
                    <input type="text" name="nam" id="">
                </label>
                <label for="">
                    <h3>氏名(ふりがな)</h3>
                    <input type="text" name="kana" id="">
                </label>
                <label for="">
                    <h3>メールアドレス</h3>
                    <input type="text" name="mail" id="">
                </label>
                <label for="">
                    <h3>内容</h3>
                    <textarea name="text" id="" cols="30" rows="10"></textarea>
                </label>
                <button type="submit" name="submit">送信</button>
                </form>
        </div>
    </div>
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>