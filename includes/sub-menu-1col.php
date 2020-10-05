<?php

/**
 * 
 */
class Sub_Menu_1Col extends WP_Widget {

    function __construct() {
        
        

        $params = array(
            'description' => __( 'Displays the 1 Column in the SubMenu', 'tecnibo-widgets' ),
            'name' => __( 'Tecnibo SubMenu 1 Column', 'tecnibo-widgets' )
        );
        parent::__construct('Sub_Menu_1Col', '', $params);
        

    }

    function form($instance) {

        extract($instance);
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title_1col')?>"><?php esc_html_e('Title', 'tecnibo-widgets' )?></label>
            <input type="text" 
                   class="widefat"
                   id="<?php echo $this->get_field_id('title_1col') ?>"
                   name="<?php echo $this->get_field_name('title_1col') ?>"
                   value="<?php if (isset($title_1col)) echo esc_attr($title_1col) ?>"
                   />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text_1col')?>"><?php esc_html_e('Text', 'tecnibo-widgets' )?></label>
            <textarea class="widefat"
                      id="<?php echo $this->get_field_id('text_1col')?>"
                      name="<?php echo $this->get_field_name('text_1col') ?>"><?php if (isset($text_1col)) echo esc_attr($text_1col) ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_1col')?>"><?php esc_html_e('Link text', 'tecnibo-widgets' )?></label>
            <input type="text" 
                   class="widefat"
                   id="<?php echo $this->get_field_id('button_1col') ?>"
                   name="<?php echo $this->get_field_name('button_1col') ?>"
                   value="<?php if (isset($button_1col)) echo esc_attr($button_1col) ?>"
                   />            
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_to_1col')?>"><?php esc_html_e('Link to (ID page)', 'tecnibo-widgets' )?></label>
            <input type="text" 
                   class="widefat"
                   id="<?php echo $this->get_field_id('link_to_1col') ?>"
                   name="<?php echo $this->get_field_name('link_to_1col') ?>"
                   value="<?php if (isset($link_to_1col)) echo esc_attr($link_to_1col) ?>"
                   />            
        </p>        
        <?php
    }

    function widget($args, $instance) {
        extract($args);
        extract($instance);
        
        $the_post = get_post( $link_to_1col );
        
        $content .= '<div class="tecnibo-widget-submenu-1col">';
        $content .= '<h1>'. $title_1col.'</h2>';
        $content .= '<p>'. $text_1col.'</p>';
        $content .= '<a href="'. get_permalink( $the_post->ID ) .'" title="">'.$button_1col.'</a>';
        $content .= '</div>';
               
        
        echo $content;
        
    }
  

}