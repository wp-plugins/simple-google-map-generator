<?php


function rtltheme_gmap_action_links( $links ) {
	$mylinks = array(
		'<a href="' . admin_url( 'options-general.php?page=rtltheme-gmap' ) . '">'.__('Settings','rtltheme-gmap').'</a>',
	);
	return array_merge( $links, $mylinks );
}

function rtl_theme_gmap_options() {
    add_options_page(__('Google Maps','rtltheme-gmap'), __('Google Maps','rtltheme-gmap'), 'manage_options', 'rtltheme-gmap', 'rtl_theme_gmap_options_page');
}

function rtl_theme_gmap_options_page() {
	?>
	
	<link rel='stylesheet' href='<?php echo RT_PLUGIN_URL; ?>/css/admin_css.css' type='text/css' media='all' />
	<?php if(is_rtl()) { ?>
	<link rel='stylesheet' href='<?php echo RT_PLUGIN_URL; ?>/css/admin_rtl.css' type='text/css' media='all' />
	<?php } ?>

    <h2><?php _e( 'Google Maps', 'rtltheme-gmap' ); ?></h2>

    <div id="error_msg"><?php _e( '<strong>Note:</strong> if your theme orginally support google maps, this plugin will influence it, and maybe make it broken. if it happens, you should deactivate one of them.', 'rtltheme-gmap' ); ?>
    </div>
    <br>

    <a href="http://themeforest.net/search?utf8=%E2%9C%93&term=&view=list&sort=sales&date=&category=wordpress&price_min=&price_max=&sales=&rating_min=&ref=RtlTheme"><img src="<?php echo RT_PLUGIN_URL; ?>/img/theme_forest_728x90.jpg" alt="Wordperss Themes from 3$"></a>
    
    <br>
    
	<input type="submit" id="make_shortcode" class="button button-primary" value="<?php _e( 'Build Google Map', 'rtltheme-gmap' ); ?>" onclick="make_shortcode();">
	<span id="success_msg" class="hidden"><?php _e( 'Map successfully build!', 'rtltheme-gmap' ); ?></span>
	<br><br>

	<ul class='tabs'>
		<li><a href='#basic'><?php _e( 'Options', 'rtltheme-gmap' ); ?></a></li>
		<li id="hidden" class="hidden"><a href='#map_code' class="success"><?php _e( 'Get the map code', 'rtltheme-gmap' ); ?></a></li>
		<li><a href='#about'><?php _e( 'About', 'rtltheme-gmap' ); ?></a></li>
	</ul>
	<div id='basic' class="tab-section">
		<div class="first_col">
		<br>
			<input type="hidden" id="lat" value="35.65729649334313" />
			<input type="hidden" id="lng" value="'51.41601575000004" />
			<p>
				<?php _e( 'Zoom', 'rtltheme-gmap' ); ?>: <input id="map_zoom" type="number" max="18" min="1" value="15" style="width:50px;">
				<small>(min: 1 , Max: 18)</small>
			</p>
			<p>
				<?php _e( 'Map type', 'rtltheme-gmap' ); ?>:
				<select name="map_type" id="map_type">
					<option value="roadmap">roadmap</option>
					<option value="hybrid">hybrid</option>
					<option value="satellite">satellite</option>
					<option value="terain">terain</option>
				</select>
			</p>
			<p>
				<?php _e( 'Map width', 'rtltheme-gmap' ); ?>: <input type="text" id="map_width" value="100%" /> <?php _e( 'Map height', 'rtltheme-gmap' ); ?>: <input type="text" id="map_height" value="300px" />
				<br>
				<small>(These values could be in % - px - em)</small>
			</p>
			<p>
				<?php _e( 'Custom Text (will shown in popup)', 'rtltheme-gmap' ); ?>:
				<br />
				<textarea id="map_content" style="width: 90%;min-width: 300px;height: 150px; resize: none;"></textarea>
			</p>
			<p>
				<label for="upload_image">
				<?php _e( 'Upload custom icon', 'rtltheme-gmap' ); ?>:
				    <input id="upload_image" type="text" size="36" name="ad_image" value="<?php echo RT_PLUGIN_URL; ?>/img/default.png" style="display: none;" /> 
				    <input id="upload_image_button" class="button" type="button" value="<?php _e('Upload Image','rtltheme-gmap'); ?>" />
				</label>
			</p>
			<p>
				<?php _e( 'Icon animation', 'rtltheme-gmap' ); ?>:
				<select name="map_animation" id="map_animation">
					<option value="">none</option>
					<option value="bounce">bounce</option>
					<option value="drop">drop</option>
				</select>
			</p>
		</div>
		<div class="second_col">
			<?php _e( 'Address (Just Drag &amp; Drop)', 'rtltheme-gmap' ); ?>:
			<br><br>
			<div id="map_canvas" style="width:100%;height:400px;"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div id='map_code' class="tab-section">
		<p>
			<?php _e( 'Map\'s code:', 'rtltheme-gmap' ); ?>
			<br>
			<small>(<?php _e( 'Copy this code and paste it into your post, page or text widget content.', 'rtltheme-gmap' ); ?>)</small>
			<br />
			<textarea id="map_shortcode" style="width: 90%;min-width: 300px;direction: ltr;height: 150px; resize: none;"></textarea><br />
		</p>
	</div>
	<div id='about' class="tab-section">
		<p>
			This plugin developed by: <a href="http://piman.ir">Peyman Naeimi</a>
		</p>
	</div>



<div style="display:none;">
<img src="<?php echo RT_PLUGIN_URL; ?>/img/default.png" />
<img src="<?php echo RT_PLUGIN_URL; ?>/img/icon-shadow.png" />
<img src="<?php echo RT_PLUGIN_URL; ?>/img/rtltheme.png" />
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
  function initialize() {
    var myLatlng = new google.maps.LatLng(0,0);
    var myOptions = {
      zoom: 2,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	var icon1 = "<?php echo RT_PLUGIN_URL; ?>/img/default.png";
	var icon2 = "<?php echo RT_PLUGIN_URL; ?>/img/rtltheme.png";
	var shadow = "<?php echo RT_PLUGIN_URL; ?>/img/icon-shadow.png";
    var marker = new google.maps.Marker({
        position: myLatlng, 
        map: map,
		icon: icon1,
		shadow: shadow,
        draggable:true
    });
	
	google.maps.event.addListener(marker, 'mouseover', function() {
		marker.setIcon(icon2);
	});
	google.maps.event.addListener(marker, 'mouseout', function() {
		marker.setIcon(icon1);
	});
    google.maps.event.addListener(
        marker,
        'drag',
        function() {
        	document.getElementById('lat').value = marker.position.lat();
        	document.getElementById('lng').value = marker.position.lng();
        }
    );
  }

  initialize();

  function make_shortcode() {
  	document.getElementById('map_shortcode').value = '[gmap lat="' +document.getElementById('lat').value+'" lng="'+ document.getElementById('lng').value +'" zoom="' +document.getElementById('map_zoom').value+'" marker="' +document.getElementById('upload_image').value+'" type="' +document.getElementById('map_type').value+'" width="' +document.getElementById('map_width').value+'" height="' +document.getElementById('map_height').value+'" animation="' +document.getElementById('map_animation').value+'"]' +document.getElementById('map_content').value+'[/gmap]';

  	document.getElementById('hidden').className = "show";
  	document.getElementById('success_msg').className = "show";
  	document.getElementById('make_shortcode').value = "<?php _e( 'Update Map\'s Code', 'rtltheme-gmap' ); ?>";
  }

jQuery(document).ready(function($){

 $('ul.tabs').each(function(){
    // For each set of tabs, we want to keep track of
    // which tab is active and it's associated content
    var $active, $content, $links = $(this).find('a');

    // If the location.hash matches one of the links, use that as the active tab.
    // If no match is found, use the first link as the initial active tab.
    $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
    $active.addClass('active');

    $content = $($active[0].hash);

    // Hide the remaining content
    $links.not($active).each(function () {
      $(this.hash).hide();
    });

    // Bind the click event handler
    $(this).on('click', 'a', function(e){
      // Make the old tab inactive.
      $active.removeClass('active');
      $content.hide();

      // Update the variables with the new link and content
      $active = $(this);
      $content = $(this.hash);

      // Make the tab active.
      $active.addClass('active');
      $content.show();

      // Prevent the anchor's default click action
      e.preventDefault();
    });
  });
 
 
    var custom_uploader;
 
 
    $('#upload_image_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: '<?php _e('Choose Image','rtltheme-gmap'); ?>',
            button: {
                text: '<?php _e('Choose Image','rtltheme-gmap'); ?>'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#upload_image').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
 
});
</script>
<?php
}
?>