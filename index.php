<?php
	get_header();
	
	$args = array('category_name'=>'vezercikk', 'posts_per_page'=>1);
	$posts = get_posts($args);
?>
	<div id="fb-root"></div>
	<script type="text/javascript">
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	
		jQuery(document).ready(function(){
			jQuery(".ndwPostViewerPost").click(function(){
				jQuery("#ndwPostViewerSelectedImage").attr("src", jQuery(this).attr("data-fullImageSRC"));
				jQuery("#ndwPostViewerSelectedImageOpener").attr("href", jQuery(this).attr("data-fullImageSRC"));
			});
			
			jQuery("#ndwPostViewerScroller").mCustomScrollbar({theme:"dark-2"});
			
			jQuery('#ndwPostViewerSelectedImageOpener').swipebox({hideBarsDelay : 0});
			
			jQuery(".ndwPostViewerPost").click(function(){
				jQuery(".ndwPostViewerPost").removeClass('ndwPostViewerPost_selected');
				jQuery(this).addClass('ndwPostViewerPost_selected');
			});
			
			jQuery(".ndwPostViewerPost:first").click();
		});
	</script>
	<div id="content">
		<div id="mainArticle">
			<div class="fb-like-box" data-href="https://www.facebook.com/NewDanceWorld?fref=ts" data-width="280" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
<?php
			foreach($posts as $post){
				$embedded = wp_oembed_get(get_post_meta($post->ID, 'ndwYoutubeLink')[0], array('width'=>450));
				if(embedded){
					echo $embedded;
				}else{
?>
					<img style="width: 400px;" src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium')[0]; ?>">
<?php
				}
			}
?>
			<div id="mainArticleDesc">
<?php
				foreach($posts as $post){
?>
					<h3 id="mainArticleTitle"><?php echo $post->post_title; ?></h3>
					<div id="mainArticleAbout"><?php echo $post->post_content; ?></div>
<?php
				}
?>
			</div>
		</div>
		<div id="ndwPostViewerContainer">
			<div id="ndwPostViewerHelptext">KIEMELT CIKKEK<img src="<?php echo get_bloginfo('template_directory'); ?>/images/selectedInPageMenu.png"></div>
			<div id="ndwPostViewer">
				<div id="ndwPostViewerScroller">
<?php
					$args = array('category_name'=>'kiemelt', 'posts_per_page'=>-1, 'orderby'=>'post_date', 'order'=>'DESC');
					$posts = get_posts($args);
					
					foreach($posts as $post){
?>
						<div class="ndwPostViewerPost cPointer" data-fullImageSRC="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0]; ?>">
							<img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail')[0]; ?>">
							<div class="ndwPostViewerPostDesc"><?php echo $post->post_title; ?></div>
						</div>
<?php
					}
?>
				</div>
				<a id="ndwPostViewerSelectedImageOpener" href="#"><img id="ndwPostViewerSelectedImage" src=""></a>
			</div>
		</div>
		<div id="indexFooter">
	
		</div>
	</div>
<?php
	get_footer();
?>