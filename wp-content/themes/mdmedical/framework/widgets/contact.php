<?php
/** Widget contact in footer  */

class Inwave_Widget_Contact extends WP_Widget {

    /**
     * Construct
     */
    function __construct() {
        parent::__construct(
            'inwave-contact',
            esc_html__('Inwave Contact', 'mdmedical'),
            array( 'description'  =>  esc_html__('Widget display contact information.', 'mdmedical') )
        );
    }

    /**
     * Tạo form option cho widget
     */
    function form( $instance ) {

        $default = array(
            'title'         => 'Title',
            'description'   => '',
            'email'         => '',
            'phone'         => '',
            'fax'           => '',
            'address'       => ''
        );
        $instance = wp_parse_args( (array) $instance, $default );
        $title = esc_attr($instance['title']);
        $description = esc_attr($instance['description']);
        $email = esc_attr($instance['email']);
        $phone = esc_attr($instance['phone']);
        $fax = esc_attr($instance['fax']);
        $address = esc_attr($instance['address']);

        echo '<p>'.esc_html__('Input Title', 'mdmedical').'<input type="text" class="widefat" id="'. esc_attr($this->get_field_id('title')) . '" name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr($title).'"/></p>';
        echo '<p>'.esc_html__('Description', 'mdmedical').'  <textarea class="widefat" rows="5" cols="10" class="widefat" id="'. esc_attr($this->get_field_id('description')) . '" name="'.esc_attr($this->get_field_name('description')).'">' . $description .'</textarea></p>';
        echo '<p>'.esc_html__('Email', 'mdmedical').' <input type="text" class="widefat" name="'.esc_attr($this->get_field_name('email')).'" value="'.esc_attr($email).'"/></p>';
        echo '<p>'.esc_html__('Phone', 'mdmedical').'  <input type="text" class="widefat" name="'.esc_attr($this->get_field_name('phone')).'" value="'.esc_attr($phone).'"/></p>';
        echo '<p>'.esc_html__('Fax', 'mdmedical').' <input type="text" class="widefat" name="'.esc_attr($this->get_field_name('fax')).'" value="'.esc_attr($fax).'"/></p>';
        echo '<p>'.esc_html__('Address', 'mdmedical').'  <input type="text" class="widefat" name="'.esc_attr($this->get_field_name('address')).'" value="'.esc_attr($address).'"/></p>';

    }
    /**
     * save widget form
     */

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['description'] = strip_tags($new_instance['description']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['phone'] = strip_tags($new_instance['phone']);
        $instance['fax'] = strip_tags($new_instance['fax']);
        $instance['address'] = strip_tags($new_instance['address']);
        return $instance;

    }

    /**
     * Show widget
     */

    function widget( $args, $instance ) {

        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $description = empty( $instance['description'] ) ? '' : $instance['description'];
        $email = empty( $instance['email'] ) ? '' : $instance['email'];
        $phone = empty( $instance['phone'] ) ? '' : $instance['phone'];
        $fax = empty( $instance['fax'] ) ? '' : $instance['fax'];
        $address = empty( $instance['address'] ) ? '' : $instance['address'];

        echo wp_kses_post($before_widget);

        echo wp_kses_post($before_title. $title .$after_title);
        echo '<div class="footer-widget-contact">';
        echo '<p>' . $description .'</p>';
        echo '<ul class="information">';
        echo '<li><i class="fa fa-envelope"></i>' . $email .'</li>';
        echo '<li class="phone"><i class="fa fa-phone"></i><ul><li>'. $phone . '</li><li>' . $fax .'</li></ul></li>';
        echo '<li><i class="fa fa-map-marker"></i>' . $address .'</li>';
        echo '</ul>';
        echo '</div>';

        // End show widget

        echo wp_kses_post($after_widget);
    }
}

function inwave_contact_widget() {
    register_widget('Inwave_Widget_Contact');
}
add_action('widgets_init', 'inwave_contact_widget');