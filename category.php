<?php get_header(); ?>

<!--カテゴリー名下準備-->
<?php
$cat = get_the_category();
$catname = $cat[0]->cat_name;
?>
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
                        <a href="<?php echo get_permalink(); ?>">
                            <!--サムネイルの取得、ない場合はnoimg.jpg-->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="news-img" style="background-image: url('<?php the_post_thumbnail_url('thumbnail'); ?>');"></div>
                            <?php else : ?>
                                <div class="news-img" style="background-image: url('<?php echo get_template_directory_uri(); ?>/photos/PC-img/singlesample.jpg');"></div>
                            <?php endif; ?>
                            <div>
                                <!--抜粋を７０文字まで取得、それ以降は切り捨て-->
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
            <div id="Page-controll">
                <!--記事がページ限界になったら次のページへのリンクを生成-->
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