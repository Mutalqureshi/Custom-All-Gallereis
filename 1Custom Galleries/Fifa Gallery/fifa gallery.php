FiFA GALLERY ------------------- *


HTML =>
###################

// gallery post type

add_action( 'init', 'create_gallery_post_type' );
function create_gallery_post_type() {
  register_post_type( 'gallries',
    array(
        'labels' => array(
        'name' => __( 'Galleries' ),
        'singular_name' => __( 'Gallery' ),
        'add_new'            => _( 'Add New Gallery'),
        'add_new_item'       => __( 'Add New Gallery'),
        'new_item'           => __( 'New Gallery'),
        'edit_item'          => __( 'Edit Gallery'),
        'view_item'          => __( 'View Gallery'),
        'all_items'          => __( 'All Galleries'),
        'search_items'       => __( 'Search Gallery')
      ),            
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title'),
        'menu_icon' => get_template_directory_uri() . '/img/gallery.png',
        'menu_position' => 52
    )
  );    
  
}

// ---------------------------------------------------------------

add_image_size( 'small-preview', 90, 90, array( 'center', 'center' ) );
add_image_size( 'gallery-square', 360, 363, array( 'center', 'center' ) );
add_image_size( 'gallery-horizontal', 740, 373, array( 'center', 'center' ) );
add_image_size( 'gallery-vertical', 665, 671, array( 'center', 'center' ) );



add_shortcode("home-gallery","home_gallery");
function home_gallery(){
$html .='<section class="single-gallery container-fluid">'; 
               
                    $html .='<div class="row">';
                    $html .='<div class="col-sm-12 p-none">'; 
                        $html .='<div id="myList" class="all-gallery grid owl-carousel ">';
                            $args = array(
                                'post_type' => 'gallries',
                                'numberposts' => -1,
                                'order'    => 'ASC',
                            );
                            $loop = new WP_Query($args);
                            while($loop->have_posts()): $loop->the_post();
                            
                                if( have_rows('gallery_slide') ):
                                $in = 0;
                                while ( have_rows('gallery_slide') ) : the_row(); 
                                $in++;
                        $html .="<div class='slide clearfix'>";
                                /*----for image-------*/
                                $bigimage = get_sub_field('bigimage');
                                $horizontal_image = get_sub_field('horizontal_image');
                                $horizontal_image_2 = get_sub_field('horizontal_image_2');
                                $square_image = get_sub_field('square_image');
                                $square_image_2= get_sub_field('square_image_2');

        if ($in % 2 == 0){
                          
                                $image_list = array(
                                    array($horizontal_image['sizes']['gallery-horizontal'], $horizontal_image['sizes']['large'] , 'hor-40'), 
                                    array($square_image_2['sizes']['gallery-square'], $square_image_2['sizes']['large'] , 'square'),
                                    array($bigimage['sizes']['gallery-vertical'], $bigimage['sizes']['large'] ,'width-75 fl-right'),
                                    array($square_image['sizes']['gallery-square'], $square_image['sizes']['large'] , 'square'), 
                                    array($horizontal_image_2['sizes']['gallery-horizontal'], $horizontal_image_2['sizes']['large'] , 'hor-40'), 
                                );
        }
        else{
              $image_list = array(
                                    array($bigimage['sizes']['gallery-vertical'], $bigimage['sizes']['large'] ,'width-75'),
                                    array($horizontal_image['sizes']['gallery-horizontal'], $horizontal_image['sizes']['large'] , 'hor-40'), 
                                    array($square_image_2['sizes']['gallery-square'], $square_image_2['sizes']['large'] , 'square'), 
                                    array($square_image['sizes']['gallery-square'], $square_image['sizes']['large'] , 'square'), 
                                    array($horizontal_image_2['sizes']['gallery-horizontal'], $horizontal_image_2['sizes']['large'] , 'hor-40'), 
                                );
        }
                                foreach ($image_list as $key => $image_list) {
                                    $html .='<div class="grid-item '.$image_list[2] .' gallery_product gallery-'.get_the_ID().'">';
                                        $html .='<div class="relative-main">';  
                                            $html .='<a class="box" data-fancybox="gallery" href="'.$image_list[1].'">';
                                                 $html .='<img class="" src="'.$image_list[0].'" alt="" />';
                                            $html .='</a>';
                                        $html .='</div>';   
                                    $html .='</div>'; 
                                 }
                                // $html .= "<div>";
                                    $html .="</div>";
                                endwhile;
                            endif;
                            endwhile;                   
                        
                    $html .='</div>';
                $html .='</div>';
                $html .='</div>';
            $html .='</section>';
    return $html;
}
/*end*/


CSS=>
######################################

.hover_head{
    background: rgba(0, 0, 0, 0.5);
    position: absolute;
    border-radius: 5px !important;
    /*width: 350px;*/
    left: 0 ;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    opacity: 0;
}

.row_h .vc_column-inner .wpb_wrapper:hover .hover_head{
    padding-top: 50%;
    cursor: pointer;
    opacity: 1;
    transition: all ease 2s;
}

.row_h .vc_column-inner .wpb_wrapper:hover .angle-icon{
    opacity: 0;
    transition: all ease 2s;
    bottom: 100px;

}

.wd-w {
    margin: 13px auto;
}
.hover_head:after{
    content: " |";
    display: inline-block;
    color: #ff7200;
    margin-left: 7px;
    margin-top: 10px !important;
    /*background: red;*/
}
.hover_head:before{
    display: inline-block;
    color: #ff7200;
    content: "| ";
    margin-right: 7px;
}


.square{
  width: 20% !important;
  float: left;
}

.height-double,.width-75{
    float: left;
    width: 40% !important;
}
.hor-40{
    float: left;
    width: 40% !important;
}
.p-none{
    padding: 0 !important;
}
#myList {
    margin-right: 100px;
    position: relative;
    /*margin-left: -1px;*/
}
.owl-carousel .owl-stage-outer{
    overflow: visible !important;
}

.owl-next {
    background: rgba(0, 0, 0, 0.5)!important;
    width: 100px !important;
    /*height: 263px;*/
    font-size: 100px !important;
    position: absolute;
    z-index: 99;
    top: 2px;
    right: 0;
    bottom: 0;
    color: #fff;
}
.owl-prev {
    background: rgba(0, 0, 0, 0.5)!important;
    width: 100px !important;
    /*height: 263px;*/
    font-size: 100px !important;
    position: absolute;
    z-index: 99;
    top: 2px;
    left: 0;
    bottom: 0;
    color: #fff;
}
.owl-prev span ,.owl-next span{
    color: #fff !important; 
}
.owl-carousel:hover>.owl-nav{
    display: block;
}
.owl-dots{
    display: none;
}
.owl-item{
    /*width: 1600px !important;*/
}
.box{
    display: block;
    overflow: hidden;
}
.box img:hover {
    transition: all ease 2s;
  transform: scale(1.4); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
.owl-stage {
    left: -50px;
}


.grid-item *{
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    
}

.relative-main {
    outline: 3px solid #fff;
}

.fl-right{
        float: right;
}
\
.gallery_product .relative-main a.box {
    display: block;
}


.owl-carousel.owl-loaded{
    display: block !important;
}
.owl-item{
    /*width: 105% !important;*/
}
.owl-stage{
    /*width: 90000px !important;*/
}


js=>
############################################


jQuery(function() {
jQuery('.owl-carousel').owlCarousel({
    center: false,
    // left:true,
	 stagePadding: 50,
    items:1,
    margin:300,
    loop:true,
	nav: false,
	margin: 1,
	responsive: {
            0: {
                stagePadding: 12
            }
            // 1000: {
            //     stagePadding: 50
            // }
        }
	});
});
