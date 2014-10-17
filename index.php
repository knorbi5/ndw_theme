<?php
	get_header();
	
	$mainArticleID = get_cat_ID('vezercikk');
	
	$args = array('category'=>$mainArticleID, 'posts_per_page'=>1);
	$posts = get_posts($args);
?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
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
	</div>
<?php
	get_footer();
?>