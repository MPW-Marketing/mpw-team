<?php
 /*
Plugin Name: MPW Team
Plugin URI:  
Description: display team
Version:     0.1-alpha
Author:      MPW Marketing
Author URI:  
Text Domain: mpw
 */

function team_list_display ( $atts ) {
	$args = array(
	'post_type' => 'team',
	'posts_per_page' => -1,
	'order' => 'ASC',
	'orderby' => 'menu_order',
);
$the_query = new WP_Query( $args );
// The Loop
if ( $the_query->have_posts() ) {
	$cont .= '<div id="team-area" class="row">';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		global $post;
		$data_id = $post->ID;
		$thumb_id = get_post_thumbnail_id();
		$thumb_id = get_post_meta($post->ID, 'brand_main_image', true);
		$thumb_url = wp_get_attachment_url($thumb_id);
		$team_title = get_the_title();
		$comp_title = str_replace(" ","",$team_title);
		$cont .= '<div class="team-member col-xs-12 col-sm-4"><a data-id="'.$data_id.'" id="'.$comp_title.'-link" class="team-member-link" title="'.$comp_title.'" href="'.get_the_permalink().'"><img class="team-member-img" src="'.$thumb_url.'" /></a><h1 class="entry-title">'.$team_title.'</h1></div>';
	}
	$cont .= '</div>
		<div class="ajax-loading-img"><img class= "loading-icon" src="'.get_stylesheet_directory_uri() . '/images/ajax-loader.gif" /></div>
		<div id="full-team" class="all-content">
<article id="post-ID" class="post-class">
	<header class="entry-header">
		<h1 class="entry-title"></h1>
	</header>
	<hr class="service-brand-sep" />
<div class="row">
<main id="main-service" class="site-main col-xs-12" role="main">
	<span class="service-image">
	</span><!--end featured image-->
	<div id="main-content" class="entry-content">
	</div><!--end entry content-->
	</main><!--end main service-->
	</div><!--end row-->
</article><!--end post-article-->
</div><!--end full-team-member-->';

} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();


return $cont;

}

add_shortcode( 'team-list', 'team_list_display' );

?>