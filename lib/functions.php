<?php

if (!class_exists("AllGoogleMaps")) {
    class AllGoogleMaps {
        function AllGoogleMaps() { 

			function rtlgmap($atts, $content = null) {
			    extract(shortcode_atts(array(
			        "lat" => '35',
			        "lng" => '51',
			        "marker" => 'http://',
			        "animation" => '',
			        "type" => 'roadmap',
			        "zoom" => '14',
			        "width" => '100%',
			        "height" => '300px'

			    ), $atts));

			if($content != null) {
				$content_echo = '

				info_window : { 
					                content :\'<span style="color: #000;font-family: Tahoma;">'.$content.'</span>\',
					                maxWidth: 150
					            },';
			}
			elseif($content == null){
				$content_echo = '';
			}

			    $map_shortcode_output = '
				<div id="rtl_map_convas" style="width:'.$width.'; height:'.$height.'"></div>



				<script type="text/javascript">
				$(function() { 
					$(\'#rtl_map_convas\').initMap({ 

						center : [ '.$lat.','.$lng.' ] ,
						type : \''.$type.'\', 
						
						markers : {
							marker : {
								position: [ '.$lat.','.$lng.' ], 
								animation: \''.$animation.'\',
								'.$content_echo.'
								options : {
									icon: \''.$marker.'\'
								}					
					        },
						},

						options : {
							disableDefaultUI: true,
							zoom: '.$zoom.'
						}
					});
				});
				</script>
			    ';

			    return $map_shortcode_output;
			}



			/*function rtl_gmap_head_script() {
				echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>';
			}
			add_action('wp_head', 'rtl_gmap_head_script');*/

			
			function my_jquery_enqueue() {
			   wp_deregister_script('jquery');
			   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
			   wp_enqueue_script('jquery');
			}

			function rtl_gmap_footer_script() {
				echo '
				<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
				<script type="text/javascript" src="'.RT_PLUGIN_URL.'/js/initmap.min.js"></script>';
			}


        }
 
    }
 
} //End Class AllGoogleMaps

if (class_exists("AllGoogleMaps")) {
    $rtl_theme_gmap = new AllGoogleMaps();
}

//Actions and Filters
if (isset($rtl_theme_gmap)) {
    
	add_action( 'admin_menu', 'rtl_theme_gmap_options' ); //Add Plugin Options Admin Menu
	add_filter( 'plugin_action_links_' . RT_PLUGIN_BASENAME, 'rtltheme_gmap_action_links' );
	add_action('wp_footer', 'rtl_gmap_footer_script');
	if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
	add_shortcode('gmap', 'rtlgmap');


}




?>