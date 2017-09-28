<?php
/** Widget contact in footer  */

class Inwave_Widget_Subscribe extends WP_Widget {

    /**
     * Construct
     */
    function __construct() {
        parent::__construct(
            'inwave-subscribe',
            esc_html__('Inwave Subscribe', 'mdmedical'),
            array( 'description'  =>  esc_html__('Widget display subscribe.', 'mdmedical') )
        );
    }

    /**
     * Tạo form option cho widget
     */
    function form( $instance ) {
        $default = array(
            'title'         => 'Title',
            'description'   => '',
            'action'       => ''
        );

        $instance = wp_parse_args( (array) $instance, $default );
        $title = esc_attr($instance['title']);
        $description = esc_attr($instance['description']);
        $action = esc_attr($instance['action']);

        echo '<p>'.esc_html__('Title', 'mdmedical').'<input type="text" class="widefat" id="'. esc_attr($this->get_field_id('title')) . '" name="'.esc_attr($this->get_field_name('title')).'" value="'.esc_attr($title).'"/></p>';
        echo '<p>'.esc_html__('Description', 'mdmedical').'<textarea class="widefat" rows="5" cols="10" class="widefat" id="'. esc_attr($this->get_field_id('description')) . '" name="'.esc_attr($this->get_field_name('description')).'">' . $description .'</textarea></p>';
        echo '<p>'.esc_html__('Action Url', 'mdmedical').'<input type="text" class="widefat" name="'.esc_attr($this->get_field_name('action')).'" value="'.esc_attr($action).'"/></p>';
    }
    /**
     * save widget form
     */

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['description'] = strip_tags($new_instance['description']);
        $instance['action'] = strip_tags($new_instance['action']);

        return $instance;
    }

    /**
     * Show widget
     */
    function widget( $args, $instance ) {
        wp_enqueue_script('mailchimp');
        $output = '';
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $description = empty($instance['description'] ) ? '' : $instance['description'];
        $action = empty( $instance['action'] ) ? '' : $instance['action'];

        echo wp_kses_post($before_widget);

        echo wp_kses_post($before_title. $title .$after_title);
        $response['submit'] = esc_html__('Submitting...','mdmedical');
        $response[0] = esc_html__('We have sent you a confirmation email','mdmedical');
        $response[1] = esc_html__('Please enter a value','mdmedical');
        $response[2] = esc_html__('An email address must contain a single @','mdmedical');
        $response[3] = esc_html__('The domain portion of the email address is invalid (the portion after the @: )','mdmedical');
        $response[4] = esc_html__('The username portion of the email address is invalid (the portion before the @: )','mdmedical');
        $response[5] = esc_html__('This email address looks fake or invalid. Please enter a real email address','mdmedical');

        $response = json_encode($response);

        $output .= '<div class="iw-mailchimp-form "><form class="iw-email-notifications" action="' . $action . '" data-response="' . htmlentities($response) . '">';
        if($description){
            $output .= '<div class="malchimp-desc">'.$description.'</div>';
        }
        $output .= '<div class="ajax-overlay"><span class="ajax-loading"><i class="fa fa-spinner fa-spin fa-2x"></i></span></div>';
        $output .= '<input class="mc-email" type="email"  placeholder="' .esc_attr(esc_html__('Email address', 'mdmedical')) .'">';
        $output .= '<button type="submit">' .esc_html__('DONE', 'mdmedical') .'</button>';
        $output .= '<span class="response"><label></label></span>';

        $output .= '</form></div>';

        echo (string)$output;

        // End show widget
        echo wp_kses_post($after_widget);
    }
}

function inwave_subscribe_widget() {
    register_widget('Inwave_Widget_Subscribe');
}
add_action('widgets_init', 'inwave_subscribe_widget');