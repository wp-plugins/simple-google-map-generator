<?php
/*
Plugin Name: Simple Google Map Generator
Plugin URI: http://wordpress.org/plugins/simple-google-map-generator/
Description: A plugin for build your own google maps, just with Drag and Drop
Author: Peyman Naeimi
Author URI: http://www.piman.ir/
Text Domain: rtltheme-gmap
Domain Path: /lang/
Version: 1.1.1
*/


/////////define textdomain for language/////////////
load_plugin_textdomain('rtltheme-gmap',  false, dirname( plugin_basename( __FILE__ ) ) . '/lang/');



if ( ! defined( 'RT_PLUGIN_BASENAME' ) )
	define( 'RT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

if ( ! defined( 'RT_PLUGIN_NAME' ) )
	define( 'RT_PLUGIN_NAME', trim( dirname( RT_PLUGIN_BASENAME ), '/' ) );

if ( ! defined( 'RT_PLUGIN_DIR' ) )
	define( 'RT_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

if ( ! defined( 'RT_PLUGIN_URL' ) )
	define( 'RT_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );

require_once RT_PLUGIN_DIR . '/settings.php';




?>