<?php
/** Widget recent post footer*/
class Inwave_Recent_Posts_Footer_Widget extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_recent_entries_footer',
            'description' => esc_html__( 'Your site&#8217;s most recent Posts in footer.', 'mdmedical' )
        );
        parent::__construct( 'recent-posts-footer', esc_html__( 'Recent Posts footer' , 'mdmedical'), $widget_ops );
        $this->alt_option_name = 'widget_recent_entries';
    }

    public function widget($args, $instance) {

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        ob_start();

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts Footer', 'mdmedical');

        /** This filter is documented in wp-includes/default-widgets.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$show_thumb = isset( $instance['show_thumb'] ) ? $instance['show_thumb'] : false;

        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );

        if ($r->have_posts()) :
            ?>
            <?php echo wp_kses_post($args['before_widget']); ?>
            <?php if ( $title ) {
            echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
        } ?>
            <ul class="recent-blog-posts recent-blog-posts-footer">
                <?php while ( $r->have_posts() ) : $r->the_post();
				
					$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
					$img_src = count($img) ? $img[0] : '';
					if ($img_src){
						$img_src = inwave_resize($img_src, 75, 75, true);
					}					
                    $thumb = get_the_post_thumbnail();
                ?>
                    <li class="recent-blog-post">
						<?php if($show_thumb){ ?>
							<?php if($thumb):?>
								<a class="recent-blog-post-thumnail" href="<?php echo esc_url(get_the_permalink()); ?>">
									<img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
								</a>
							<?php endif?>
						<?php } ?>
                        <div class="recent-blog-post-detail">
                            <h3 class="recent-blog-post-title"><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h3>
                            <?php if ( $show_date ) : ?>
                                <div class="post-date"><?php the_date('F d-Y'); ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="clearfix"></div>
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php echo wp_kses_post($args['after_widget']); ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

        endif;

        if ( ! $this->is_preview() ) {
            $cache[ $args['widget_id'] ] = ob_get_flush();
            wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
        } else {
            ob_end_flush();
        }
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_thumb'] = isset( $new_instance['show_thumb'] ) ? (bool) $new_instance['show_thumb'] : false;
        return $instance;
    }

    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_thumb = isset( $instance['show_thumb'] ) ? (bool) $instance['show_thumb'] : false;
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'mdmedical' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'mdmedical' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Display post date?', 'mdmedical' ); ?></label></p>
			
		<p><input class="checkbox" type="checkbox"<?php checked( $show_thumb ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_thumb' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_thumb' )); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id( 'show_thumb' )); ?>"><?php esc_html_e( 'Show thumbnail?', 'mdmedical' ); ?></label></p>
		
        <?php
    }

}

function inwave_recent_post_footer_widget() {
    register_widget('Inwave_Recent_Posts_Footer_Widget');
}
add_action('widgets_init', 'inwave_recent_post_footer_widget');