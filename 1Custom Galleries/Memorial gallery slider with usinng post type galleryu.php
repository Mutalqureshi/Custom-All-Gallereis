
function recent_gallery($atts) {
		$html = '';
		
		$args = array(
					'post_type'              => array( 'gallery' ),
					'post_status'            => array( 'publish' ),
					'posts_per_page'         => 1,
				);
				
				// The Query
				$query = new WP_Query( $args );
				
				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$field_data = get_field( "gallery_recent" );
						$myarr = preg_split ("/\,/", $field_data);  
						//echo "<pre>"; print_r($myarr);
						
						
						if(count($myarr)%2){
							array_pop($myarr);
						}
						$pieces = array_chunk($myarr, ceil(count($myarr) / 2));
						//echo "<pre>"; print_r($pieces);echo "</pre>"; 
						
						$html .= '<div class="row1 c_slider">';
						foreach($pieces[0] as $p1) {
							// print_r( $p1);
							$imgp = wp_get_attachment_image_src($p1, 'recent_gallery');
							 // echo "<pre>";
							 // print_r($imgp[0]);
							$html .= '<img src="'.$imgp[0].'">';
                             // $html .='<img class="'.$img_size.'" src="'. $imgp .'"  />';

						}
						
						$html .= '</div><div class="row2 c_slider">';
						foreach($pieces[1] as $p2) {
							$imgp = wp_get_attachment_image_src($p2, 'recent_gallery');
							 // echo $imgp;
							$html .= '<img src="'.$imgp[0].'">';
						}
						$html .= '</div>';
					}
				}
				
				// Restore original Post Data
				wp_reset_postdata();
		return $html;
}
add_shortcode( 'recent_gallery', 'recent_gallery' );

add_image_size( 'recent_gallery', 352, 352, array( 'center', 'center' ));

--------------------------------------------------------------------------------