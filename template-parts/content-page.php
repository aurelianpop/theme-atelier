<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme-atelier
 */

?>

<article class="margin0" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'theme-atelier'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->
    </div>

    <?php if (is_front_page()) {
        $dateFormat = get_option('date_format');
        ?>
        <div class="row grey lighten-4 margin0 padding-top60 padding-bottom60">
            <div class="container">
                <div id="at-causes" class="col m8 s12 ">
                    <h3>Cauze</h3>
                    <hr class="blue accent-4"/>
                    <div class="row">
                        <?php
                        $args = array(
                            'posts_per_page' => 6,
                            'offset' => 0,
                            'orderby' => 'modified',
                            'order' => 'DESC',
                            'post_type' => 'atelier_causes',
                            'post_status' => 'publish',
                            'suppress_filters' => true
                        );
                        $causes_array = get_posts($args);
                        foreach ($causes_array as $cause) {
                            $img_url = wp_get_attachment_url(get_post_thumbnail_id($cause->ID));
                            ?>
                            <div class="col m4 s12">
                                <div class="card">
                                    <a class="blue-link" href="<?php echo $cause->guid ?>">
                                        <div style="height:240px; background-image:url('<?php echo $img_url;?>');background-size:cover">
                                        </div>
                                        <?php $date = strtotime($cause->post_modified); ?>
                                        <div class="card-content">
                                            <p class="truncate"><?php echo $cause->post_title?></p>
                                            <p class="grey-text text-accent-3"><?php echo date($dateFormat, $date) ?> </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div id="at-news" class="col m4 s12">
                    <h3>Noutati</h3>
                    <hr class="blue accent-4"/>
                    <?php
                    $args = array(
                        'posts_per_page' => 5,
                        'offset' => 0,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'suppress_filters' => true
                    );
                    $news_array = get_posts($args);
                    ?>
                    <ul class="collection"><?php
                        foreach ($news_array as $news) {
                            $img_url = wp_get_attachment_url(get_post_thumbnail_id($news->ID));
                            $date = strtotime($news->post_date);
                            ?>
                            <li class="collection-item avatar">
                                <a class="blue-link" href="<?php echo $news->guid ?>">
                                    <?php echo !empty($img_url) ? '<img class="circle" src="' . $img_url . '"/>' : '' ?>
                                    <h6 class="title truncate"><?php echo $news->post_title ?></h6>
                                    <p class="grey-text text-accent-4"><?php echo date($dateFormat, $date) ?></p>
                                    <?php $content = preg_replace('/<iframe.*?\/iframe>/i','', $news->post_content); ?>
                                    <p class="truncate padding-top30"><?php echo substr ( $content , 0, 20 );  ?></p>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>
</article><!-- #post-## -->
