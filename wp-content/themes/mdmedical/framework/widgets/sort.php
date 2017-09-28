<?php
/** Widget contact in footer  */

class Inwave_Widget_Sort extends WP_Widget {

    /**
     * Construct
     */
    function __construct() {
        parent::__construct(
            'inwave-sort',
            esc_html__('MD Sort product', 'mdmedical'),
            array( 'description'  =>  esc_html__('Widget display product sort by menu order, best sale, price from low to hight, price hight to low, rating.', 'mdmedical') )
        );
    }

    /**
     * Tแบกo form option cho widget
     */
    function form( $instance ) {

        $instance = wp_parse_args( (array) $instance, array( 'title' => __('Product Slide', 'intravel') ) );
		$title_id = $this->get_field_id( 'title' );
        $title = strip_tags($instance['title']);
	?>	
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'inevent'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
	
	<?php
    }
    /**
     * save widget form
     */

    function update( $new_instance, $old_instance ) {

        $instance = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
        return $instance;

    }

    /**
     * Show widget
     */

    function widget( $args, $instance ) {

        extract( $args );
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo wp_kses_post($before_widget);
		
		// global $woocommerce, $product;
		$catalog_orderby_options = array(
			'menu_order' => esc_html( 'Mặc định', 'mdmedical' ),
			'popularity' => esc_html( 'Bán chạy nhất', 'mdmedical' ),
			'price'      => esc_html( 'Giá từ thấp đến cao', 'mdmedical' ),
			'price-desc' => esc_html( 'Giá từ cao đến thấp', 'mdmedical' ),
			'rating'     => esc_html( 'Bình chọn cao nhất', 'mdmedical' ),
		);
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'menu_order';
		// var_dump($catalog_orderby_options);
	?>	
			<div class="md-sort-product-widget">
				<?php if ($title){ ?>
					<div class="title-group">
						<h3 class="title"><span><?php echo $title; ?></span></h3>
					</div>
				<?php } ?>
			   <form class="woocommerce-ordering" method="get" style="float:none;">
				<!--	<select name="orderby" class="orderby" multiple>-->
						<?php foreach ( $catalog_orderby_options as $key => $name ){ ?>
						<div class="item">
							<input class="orderby" id="<?php echo esc_attr( $key ); ?>" type="radio" name="orderby" value="<?php echo esc_attr( $key ); ?>" <?php checked($orderby, $key); ?>>
							<label for="<?php echo esc_attr( $key ); ?>"><?php echo $name; ?></label>
						</div>
						<!--	<option value="<?php //echo esc_attr( $key ); ?>" <?php //selected($key); ?>><?php //echo $name; ?></option>-->
						<?php } ?>
				<!--	</select>-->
						
							
					<?php wc_query_string_form_fields( null, array('orderby', 'submit')); ?>
				</form>
				
				<div class="clearfix"></div>
			</div>
	<?php
        echo wp_kses_post($after_widget);
    }
}

function inwave_sort_widget() {
    register_widget('Inwave_Widget_Sort');
}
add_action('widgets_init', 'inwave_sort_widget');