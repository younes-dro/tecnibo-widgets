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
        
        $html = '<div class="megamenu-cat">';
        
        $parent_cats = self::get_parent_cat();
        
        foreach ($parent_cats as $parent_cat ) {
            
            $html .= '<div class="parent-cat">';
            $html .=  '<a class="see-more" href="'.get_term_link($parent_cat->slug, 'product_category').'"><h2 class="title-cat">' . $parent_cat->name . '</h2></a>';
            
            $sub_cats = self::get_sub_cat($parent_cat->term_id);
            $number_subcat = self::get_number_subcat($parent_cat->term_id);
            foreach ($sub_cats as $sub_cat) {
                
                $html .= '<div class="sub-cat">';
                $html .= '<a href="'. get_term_link($sub_cat->slug, 'product_category') .'" title="">' . $sub_cat->name . '</a>';
                $html .= '</div>';
            }
            $seemore = ( $number_subcat > 6 ) ? '<a class="see-more" href="'. get_term_link($parent_cat->slug, 'product_category') .'" title="">'.  __( 'All', 'tecnibo-widgets' ).'</a>' : '';
            $html .= '<div class="sub-cat">';
            $html .= $seemore;
            $html .= '</div>';
            
            $html .= '</div>';
        }
        
        $html .= '</div>';
        
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