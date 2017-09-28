<?php 
get_header(); 
global $post;
?>

<div class="single-nhansu row-page-sample">
	<div class="container">
		<div class="single-nhansu-inner">

			<div class="single-lan-da-maincontent">
			<?php while (have_posts()) : the_post(); ?>
				<div class="post-content-desc">
					<div class="post-text">
						<?php echo apply_filters('the_content', get_the_content()); ?>
					</div>
				</div>
			<?php endwhile;?>
			</div>			
		</div>
	</div>
</div>
<?php get_footer(); ?>