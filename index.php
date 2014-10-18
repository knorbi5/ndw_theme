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
			});
		});
	</script>
	<div id="content">
		<div class="fb-like-box" style="position: absolute" data-href="https://www.facebook.com/NewDanceWorld?fref=ts" data-width="280" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
		<div id="mainArticle">
<?php
			foreach($posts as $post){
				$embedded = wp_oembed_get($post->post_content, array('width'=>400));
				if(embedded){
					echo $embedded;
				}else{
					echo $post->post_content;
				}
			}
?>
		</div>
		<div id="mainArticleDesc">
<?php
			foreach($posts as $post){
				echo $post->post_title;
			}
?>
		</div>
		<div>Kiemelt cikkek:</div>
		<div id="ndwPostViewer">
			<div id="ndwPostViewerScroller">
<?php
				$args = array('category_name'=>'kiemelt', 'posts_per_page'=>-1);
				$posts = get_posts($args);
				
				foreach($posts as $post){
?>
					<div class="ndwPostViewerPost" data-fullImageSRC="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0]; ?>"><img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail')[0]; ?>"><?php echo $post->post_title; ?></div>
<?php
				}
?>
			</div>
			<img id="ndwPostViewerSelectedImage" src="">
		</div>
		<div id="indexFooter">
		
		</div>
	</div>
<?php
	get_footer();
?>