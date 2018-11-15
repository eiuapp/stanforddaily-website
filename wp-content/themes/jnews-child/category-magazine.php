<?php
get_header();
$term = get_queried_object();
$category = new \JNews\Category\Category($term);
$posts = get_posts( array( 'post_type' => 'tsd_magazine_post' ) );
// $posts = get_posts( array( 'post_type' => 'post' ) );
foreach ($posts as $post) {
    $catID = get_cat_ID("magazine");
    wp_set_post_categories($post->ID, $catID, true);
}
$issues = array(
    array("volume" => "I",
        "issue" => "1",
        "date" => "09.26.16",
        "id" => "28430991/65761807"),

    array("volume" => "I",
        "issue" => "2",
        "date" => "11.04.16",
        "id" => "28430991/65748806"),

    array("volume" => "I",
        "issue" => "3",
        "date" => "01.13.17",
        "id" => "28430991/65714607"),

    array("volume" => "I",
        "issue" => "4",
        "date" => "2.24.17",
        "id" => "28430991/45977522"),

    array("volume" => "I",
        "issue" => "5",
        "date" => "5.07.17",
        "id" => "28430991/65761817"),

    array("volume" => "I",
        "issue" => "6",
        "date" => "5.5.17",
        "id" => "28430991/48344745"),

    array("volume" => "I",
        "issue" => "7",
        "date" => "6.2.17",
        "id" => "28430991/50160766"),

    array("volume" => "II",
        "issue" => "1",
        "date" => "9.22.17",
        "id" => "28430991/55708902"),

    array("volume" => "II",
        "issue" => "2",
        "date" => "10.20.17",
        "id" => "28430991/55708935"),

    array("volume" => "II",
        "issue" => "3",
        "date" => "11.17.17",
        "id" => "28430991/55568201"),

    array("volume" => "II",
        "issue" => "4",
        "date" => "01.26.18",
        "id" => "28430991/65761858"),

    array("volume" => "II",
        "issue" => "5",
        "date" => "03.02.18",
        "id" => "28430991/65761868"),

    array("volume" => "II",
        "issue" => "6",
        "date" => "04.27.18",
        "id" => "28430991/65761877"),

    array("volume" => "II",
        "issue" => "7",
        "date" => "05.22.18",
        "id" => "28430991/65748802"),

    array("volume" => "III",
        "issue" => "1",
        "date" => "09.20.18",
        "id" => "28430991/65761903"),

    array("volume" => "III",
        "issue" => "2",
        "date" => "11.14.18",
        "id" => "28430991/65761909"),
);
?>

<div class="jeg_main <?php $category->main_class();?>">
    <div class="jeg_container">
        <div class="jeg_content">
            <div class="jnews_category_header_top">
                <?php echo jnews_sanitize_output($category->render_header('top')); ?>
            </div>

            <div class="jeg_section">
                <div class="container">

                    <?php do_action('jnews_archive_above_hero');?>

                    <div class="jnews_category_hero_container">
                        <?php //echo jnews_sanitize_output( $category->render_hero() ); ?>
                        <style>
                            .tsd-magazine-slider-item {
                                width: auto;
                                height: 300px;
                                margin: 0px 20px;
                                background-image: url('https://pbs.twimg.com/profile_images/828118030605381636/G3wb0UIB_400x400.jpg');
                                background-size: cover;
                                display: block;
                            }
                            .slick-prev::before, .slick-next::before {
                                color: black;
                            }
                            </style>
                        <script>
                        $(function() {
                            $(".tsd-magazine-slider").slick({
                                infinite: true,
                                slidesToShow: 3,
                                slidesToScroll: 3
                            });
                            $(".tsd-magazine-slider-item").click(function() {
                               console.log("clicked");
                            });
                        })
                        </script>

                        <div class="tsd-magazine-slider" style="margin-bottom: 40px;">
                        <?php foreach (array_reverse($issues) as $key => $issue) {?>
                            <a class="tsd-magazine-slider-item" data-fancybox data-type="iframe" data-src="//e.issuu.com/embed.html#<?php echo $issue['id']; ?>" href="javascript:;">

                            </a>
                        <?php }?>
                    </div>

                    <?php do_action('jnews_archive_below_hero');?>

                    <div class="jeg_cat_content row">
                        <div class="jeg_main_content jeg_column col-sm-<?php echo esc_attr($category->get_content_width()); ?>">
                            <div class="jnews_category_header_bottom">
                                <?php echo jnews_sanitize_output($category->render_header('bottom')); ?>
                            </div>
                            <div class="jnews_category_content_wrapper">
                                <?php echo jnews_sanitize_output($category->render_content()); ?>
                            </div>
                        </div>
	                    <?php $category->render_sidebar();?>
                    </div>
                </div>
            </div>

        </div>
        <?php do_action('jnews_after_main');?>
    </div>
</div>


<?php get_footer();?>