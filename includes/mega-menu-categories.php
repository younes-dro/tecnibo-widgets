<?php

/**
 * 
 */
class Mega_Menu_Categories extends WP_Widget {

    function __construct() {
        
        

        $params = array(
            'description' => __( 'Displays the categories in the main menu', 'tecnibo-widgets' ),
            'name' => __( 'Tecnibo Mega Menu Categories', 'tecnibo-widgets' )
        );
        parent::__construct('Mega_Menu_Categories', '', $params);
        

    }

    function form($instance) {
        //
    }

    function widget($args, $instance) {
//        extract($args);
//        extract($instance);
        
        $html = '<ul class="megamenu-cat sub-menu">';
        
        $parent_cats = self::get_parent_cat();
        
        foreach ($parent_cats as $parent_cat ) {
            
            $html .= '<li class="parent-cat menu-item menu-item-has-children">';
            $html .=  '<a class="see-more" href="'.get_term_link($parent_cat->slug, 'product_category').'"><h2 class="title-cat">' . $parent_cat->name . '</h2></a>';
            $html.= '<ul class="sub-menu">';
            
            // Final Proudcts
            $html .= self::get_final_products($parent_cat->term_id);
            $sub_cats = self::get_sub_cat($parent_cat->term_id);
            $number_subcat = self::get_number_subcat($parent_cat->term_id);
            foreach ($sub_cats as $sub_cat) {
                
                $html .= '<li class="sub-cat menu-item">';
                $html .= '<a href="'. get_term_link($sub_cat->slug, 'product_category') .'" title="'.  $sub_cat->name .'">' . $sub_cat->name . '</a>';
                $html .= '</li>';
            }
            $seeall = '';
            if( $number_subcat > 6){
                $seeall .= '<li class="sub-cat menu-item">';
                $seeall .= '<a class="see-more" href="'. get_term_link($parent_cat->slug, 'product_category') .'" title="">'.  __( 'See All', 'tecnibo-widgets' ).'</a>';
                $seeall .= '</li>';
            }
            $html .= $seeall;
            $html .='</ul>';
            $html .= '</li>';
        }
        
        $html .= '</ul>';
        
        echo $html;
        
    }
    public static function get_parent_cat (){
        $terms = get_terms( array(
                            'taxonomy' => 'product_category',
                            'hide_empty' => false,
                            'parent' => 0
            ) );
        return $terms;
    }
    public static function get_final_products( $cat_id){
        $html = '';
        $args = array(
            'post_type' => 'tecnibo_product',
            'orderby' => 'title',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'tax_query' => array(
                array('taxonomy' => 'product_category',
                    'field' => 'term_id',
                    'terms' => $cat_id 
                )
                ),
            'meta_key' => '_display_mainmenu',
            'meta_value' => 'yes'
            );  
        $query = new WP_Query($args);
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            $html .= '<li class="sub-cat menu-item">';
            $html .= '<a title="'. get_the_title() . '" href="'.get_the_permalink().'" >'. get_the_title() .'</a>';
            $html .= '</li>';
        endwhile;
        endif;
        wp_reset_query();
        
        return $html;
    }

    public static function get_sub_cat( $parent_id ){
        $terms = get_terms( array(
                            'taxonomy' => 'product_category',
                            'hide_empty' => false,
                            'parent' => $parent_id,
                            'number' => 6
            ) );
        return $terms;        
    }
    public static function get_number_subcat( $parent_id ){
        $terms = get_terms( array(
                            'taxonomy' => 'product_category',
                            'hide_empty' => false,
                            'parent' => $parent_id,
            ) );
        return count( $terms );        
    }
    
}