<div class="post-pagination">
    <?php 
		// echo paginate_links(
			// array(
				// 'type'=>'plain',
				// 'prev_text'          => wp_kses(__('<i class="fa fa-angle-left"></i>', 'mdmedical'), inwave_allow_tags('i')),
				// 'next_text'          => wp_kses(__('<i class="fa fa-angle-right"></i>', 'mdmedical'), inwave_allow_tags('i'))
			// )
		// )
	?>
	
	<?php 
		echo paginate_links(
			array(
				'type'=>'plain',
				// 'prev_text'      => wp_kses(__('<i class="fa fa-angle-left"></i>', 'mdmedical'), inwave_allow_tags('i')),
				// 'next_text'      => wp_kses(__('<i class="fa fa-angle-right"></i>', 'mdmedical'), inwave_allow_tags('i')),
				'prev_next'         => false,
				'prev_text'         => __('Previous'),
				'next_text'         => __('Next'),
				'base'				=> get_pagenum_link(1) . '%_%',
			)
		)
	?>
	<div class="clearfix"></div>
</div>