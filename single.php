<?php get_header(); ?>

<div class="main-container">
<main>
    <div id="Content">
        <!--コンテンツ取得-->
        <?php if (have_posts()) :
            while (have_posts()) :
                the_post();
                /*カテゴリー名を取得*/
                $cat = get_the_category();
                $catname = $cat[0]->cat_name;
        ?>
                <div id="Single">
                    <!--サムネイルがある場合は画像を表示しない場合はnoimg.jpを表示-->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="Thumbnail" style="background-image: url('<?php the_post_thumbnail_url(); ?>');"></div>
                    <?php else : ?>
                        <div class="Thumbnail" style="background-image: url('<?php echo get_template_directory_uri(); ?>/photos/PC-img/singlesample.jpg');"></div>
                    <?php endif; ?>
                    <!--ここまで-->
                    <!--タイトルを表示-->
                    <h1 id="Single-title"><?php the_title(); ?></h1>
                    <dl>
                        <!--カテゴリー名を出力-->
                        <dd class="category"><?php echo $catname; ?></dd>
                        <!--投稿日を出力-->
                        <dd><?php echo get_the_date('Y.m.d'); ?></dd>
                    </dl>
                    <!--コンテンツを出力-->
                    <?php the_content(); ?>
                    <div id="Page-controll">
                        <!--前の記事の出力-->
                        <?php previous_post_link('%link', '＜ 前の記事'); ?>
                        <!--次の記事の出力-->
                        <?php next_post_link('%link', '次の記事 ＞'); ?>
                    </div>
                </div>
        <?php
            endwhile;
        endif; ?>
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
    </main>
    <?php get_sidebar(); ?>



<?php get_footer(); ?>