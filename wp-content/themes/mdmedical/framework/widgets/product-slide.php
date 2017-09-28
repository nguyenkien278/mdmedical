<?php
/**
 * Widget API: Inwave_Product_Slide_Widget class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */
class Inwave_Product_Slide_Widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'description' => esc_html__( 'Display a product slide.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'product_slide', esc_html__( 'Product Slide' ), $widget_ops );
	}
	public function widget( $args, $instance ) {
		
		$limit = isset($instance['limit']) ?  strip_tags($instance['limit']) : 3;
		$include_ids = isset($instance['include_ids']) ?  strip_tags($instance['include_ids']) : '';
		$exclude_ids = isset($instance['exclude_ids']) ?  strip_tags($instance['exclude_ids']) : '';
		$select_product_cat = isset($instance['select_product_cat']) ?  strip_tags($instance['select_product_cat']) : '';
		
		$include_ids = $include_ids ? explode(',', $include_ids) : array();
		$exclude_ids = $exclude_ids ? explode(',', $exclude_ids) : array();
			
		$arg = array(
			'numberposts' => ($limit ? $limit : -1),
			'post_type' => 'product',
			'include' => $include_ids,
			'exclude' => $exclude_ids,
			'product_cat' => $select_product_cat,
		);

		$products = get_posts($arg);

		if ( empty( $products ) ) {
			return;
		}

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		echo $args['before_widget'];
			wp_enqueue_style('owl-carousel');
			wp_enqueue_style('owl-theme');
			wp_enqueue_style('owl-transitions');
			wp_enqueue_script('owl-carousel');
			
			$sliderConfig = '{';
			$sliderConfig .= '"navigation":false';
			$sliderConfig .= ',"autoPlay":false';
			$sliderConfig .= ',"pagination":true';
			$sliderConfig .= ',"items":2';
			$sliderConfig .= ',"singleItem":true';
			$sliderConfig .= ',"addClassActive":true';
			$sliderConfig .= '}';
		?>
			<div class="product_slide_widget">
					<?php 
						global $woocommerce;
						$currency_symbol = get_woocommerce_currency_symbol();
					?>
						<?php if ($title){ ?>
							<div class="title-group">
								<h3 class="title"><?php echo $title; ?></h3>
							</div>
						<?php } ?>
						<div class="product-slide-inner">
								<div class="owl-carousel" data-plugin-options='<?php echo $sliderConfig; ?>'>
									<?php foreach( $products as $product ){
										$_product = wc_get_product($product->ID);
									
										$price = $_product->get_price();
										$price_display = wc_price($price,array());
										
										$img = wp_get_attachment_image_src(get_post_thumbnail_id($product->ID), 'full');
										$img_src = count($img) ? $img[0] : '';
										if(!$img_src){
											$img_src = inwave_get_placeholder_image();
										}							
									?>
										<div class="product-slide-item">
											<div class="product-image">
												<img src="<?php echo $img_src; ?>" alt="">
											</div>
											<div class="product-slide-detail">
												<h3 class="product-title">
													<a href="<?php echo get_permalink($product->ID); ?>"><?php echo $product->post_title; ?></a>
												</h3>
												<div class="product-price"><?php echo $price_display; ?></div>
												<div class="readmore"><a href="<?php echo get_permalink($product->ID); ?>">See more</a></div>
											</div>
										</div>
									<?php } ?>
								</div>
							
						</div>
					</div>
		<?php
		echo $args['after_widget'];
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['limit'] = strip_tags($new_instance['limit']);
		$instance['include_ids'] = strip_tags($new_instance['include_ids']);
		$instance['exclude_ids'] = strip_tags($new_instance['exclude_ids']);
		$instance['select_product_cat'] = strip_tags($new_instance['select_product_cat']);
		return $instance;
	}
	
	public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => __('Product Slide', 'intravel') ) );
		$title_id = $this->get_field_id( 'title' );
        $title = strip_tags($instance['title']);
		$limit = $instance['limit'];
		$include_ids = $instance['include_ids'];
		$exclude_ids = $instance['exclude_ids'];
		$select_product_cat = $instance['select_product_cat'];
		
		
		$args = array(
			'taxonomy' => 'product_cat',
			'hide_empty' => false,
		);

		$product_cats = get_terms($args);
		$select_product_cats = array();
		$select_product_cats[__("All", "inwavethemes")] = '';
		if(!is_wp_error($product_cats) && $product_cats){
			foreach ($product_cats as $product_cat){
				$select_product_cats[$product_cat->name] = $product_cat->slug;
			}
		}
	?>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'inevent'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php esc_html_e('Limit:', 'inevent'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" type="text" value="<?php echo esc_attr($limit); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('include_ids')); ?>"><?php esc_html_e('Include Ids:', 'inevent'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('include_ids')); ?>" name="<?php echo esc_attr($this->get_field_name('include_ids')); ?>" type="text" value="<?php echo esc_attr($include_ids); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('exclude_ids')); ?>"><?php esc_html_e('Exclude Ids:', 'inevent'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('exclude_ids')); ?>" name="<?php echo esc_attr($this->get_field_name('exclude_ids')); ?>" type="text" value="<?php echo esc_attr($exclude_ids); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('select_product_cat')); ?>"><?php esc_html_e('Select product category:', 'inevent'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('select_product_cat')); ?>" name="<?php echo esc_attr($this->get_field_name('select_product_cat')); ?>">
				<?php foreach ($select_product_cats as $key => $value){ ?>
					<option value="<?php echo  $value ?>" <?php echo ($select_product_cat == $value ? 'selected' : '')?>><?php echo $key; ?></option>
				<?php } ?>
            </select>
        </p>
	
	
	<?php
	}

}

function product_slide_widget() {
    register_widget('Inwave_Product_Slide_Widget');
}
add_action('widgets_init', 'product_slide_widget');