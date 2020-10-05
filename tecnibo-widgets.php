<?php
/*
 * Plugin Name: Tecnibo Widgets
 * Plugin URI: https://github.com/younes-dro
 * Description: Custom Widgets for tecnibo
 * Author: Younes DRO
 * Author URI: https://github.com/younes-dro
 * Version: 1.0
 * Text Domain: tecbnibo-widgets
 */

class DRO_WIDGET extends WP_Widget {

    function __construct() {
        
        add_action( 'init' , array( $this , 'widget_textdomain') );

        $params = array(
            'description' => __( 'Displays the 3 Column in the sub menu', 'tecbnibo-widgets' ),
            'name' => __( 'Tecnibo Widgets 3 Col', 'tecbnibo-widgets' )
        );
        parent::__construct('dro_widget', '', $params);
        add_action( 'wp_enqueue_scripts' , array( $this , 'register_widget_styles' ));

    }

    function form($instance) {

        extract($instance);
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('projectid') ?>"><?php esc_html_e('ID(Product/Project)', 'tecbnibo-widgets' )?></label>
            <input type="text" 
                   class="widefat"
                   id="<?php echo $this->get_field_id('projectid') ?>"
                   name="<?php echo $this->get_field_name('projectid') ?>"
                   value="<?php if (isset($projectid)) echo esc_attr($projectid) ?>"
                   />
        </p>
        <?php
    }

    function widget($args, $instance) {
        extract($args);
        extract($instance);
        
        $the_post = get_post( $projectid );
        $post_thumbnail_url = get_the_post_thumbnail_url($the_post->ID);
        
        $content .= '<div class="tecnibo-widget-submenu">';
        $content .= '<a href="'. get_permalink( $the_post->ID ) .'" title="'.  esc_html__( $the_post->post_title , 'tecnibo-widgets').'">';
        $content .= '<h1 class="title-tecnibo-widgets">'.  esc_attr__( 'You might also be interested in', 'tecnibo-widgets' ).'</h1>';
        $content .= '<img src ="'.$post_thumbnail_url.'" />';        
        $content .= '<h2>'.$the_post->post_title.'</h2>';
        $content .= '</a>';
        $content .= '</div>';
               
        
        echo $content;
        
    }
    function register_widget_styles(){
    wp_enqueue_style( 'tecnibo-widgets-css', $this->plugin_url() . '/assets/tecnibo-widgets.css' );         
    }
    function widget_textdomain(){
        load_plugin_textdomain('tecnibo-widgets', false, $this->plugin_path() . '/lang/' );
    }
    function plugin_url(){
        return untrailingslashit( plugins_url( '/', __FILE__ ) );
    }
    public function plugin_path(){
        
        return untrailingslashit( plugin_dir_path( __FILE__ ) );
    
    }    

}

add_action('widgets_init', 'register_dro_widget');

function register_dro_widget() {
    register_widget('DRO_WIDGET');
}
