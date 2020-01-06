array(
		    'id' => 'logo-gallery',
		    'type'     => 'gallery',
		    'title'    => __('Add/Edit Gallery', 'redux-framework-demo'),
		    'url'      => true,
		    'subtitle' => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'redux-framework-demo'),
		    'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),



  ),

  <!-- custom option -->

   function logo_slider() {

    
global $fdata;
    $html .='<div id="logo-slider" class="logo_slider logo-container">';
            $logo = $fdata['logo-gallery'] ;
            $etc = explode(",", $logo) ;
        foreach($etc as $attachmentId){ 
            $metaAttachment = wp_get_attachment_metadata( $attachmentId );
            $url2 =  $metaAttachment['file'];
                // echo '<pre>';
                    // print_r($metaAttachment['file']);
                // echo '</pre>';
            $url = home_url('wp-content/uploads/');
            // $post_id = get_the_ID();


            $html .='<div class="logo-slider-div">';
                $html .='<img src="'.$url . $url2.'"/>';
            $html .='</div>';
}                
    $html .='</div>';
    return $html;

}
add_shortcode("logo_slider","logo_slider");

<!-- function  -->
[logo_slider]

<!-- -------------------- -->

.logo-slider{
		width: 85% !important;
		margin: 0 auto !important;
	}
	.logo-slider .slick-slide {
		height: 170px;
		/*padding-top: 35px !important;*/
	    line-height: 170px;

	}
	.logo-slider-div{
		vertical-align: middle;
	}
	.logo-slider .slick-dots {
		    display: none !important;
	}
	.logo-slider .slick-active img{
	    vertical-align: middle;
	    max-height: 170px;
	}



	<!-- -------------------- -->