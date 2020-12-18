<?php

/**
 * 
 */
class Sub_Menu_3Col extends WP_Widget {

    function __construct() {
        
        

        $params = array(
            'description' => __( 'Displays the 3 Column in the SubMenu', 'tecnibo-widgets' ),
            'name' => __( 'Sous-Menu 3 Colonne', 'tecnibo-widgets' )
        );
        parent::__construct('Sub_Menu_3Col', '', $params);
        

    }

    function form($instance) {

        extract($instance);
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('projectid') ?>"><?php esc_html_e('ID(Product/Project)', 'tecnibo-widgets' )?></label>
            <input type="text" 
                   class="widefat"
                   id="<?php echo $this->get_field_id('projectid') ?>"
                   name="<?php echo $this->get_field_name('projectid') ?>"
                   value="<?php if (isset($projectid)) echo esc_attr($projectid) ?>"
                   />
        </p>
        <p>
            <label for=""><?php esc_h?></label>
        </p>
        <?php
    }

    function widget($args, $instance) {
        extract($args);
        extract($instance);
//        var_dump($instance);
        if( $projectid ) {
            
            $the_post = get_post( $projectid );
                  
            $post_thumbnail_url = get_the_post_thumbnail_url($the_post->ID);

            $content .= '<div class="tecnibo-widget-submenu-3col">';
            $content .= '<a href="'. get_permalink( $the_post->ID ) .'" title="'.  esc_html__( $the_post->post_title , 'tecnibo-widgets').'">';
            $content .= '<h1>'. $acf['field_5fd9d461a38c3'].'</h1>';
            $content .= '<img src ="'.$post_thumbnail_url.'" />';        
            $content .= '<h2>'.$the_post->post_title.'</h2>';
            $content .= '</a>';
            $content .= '</div>';

            echo $content;
        }
        
    }
  

}