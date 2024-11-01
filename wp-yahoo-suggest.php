<?php
/**
 * 
 * Plugin Name:	WP Yahoo Suggest
 * Plugin URI:	https://github.com/iwek
 * Description:	Uses the Yahoo Suggest API to suggest related search terms
 * Version:		1.1
 * Author:		Iwo Kadziela
 * Author URI:	https://github.com/iwek
 * Text Domain: wp-yahoo-suggest
 * License:		GPLv2
 */


class Wp_Yahoo_Suggest {
	
	
	///////////////////////////////////////////////////////////////////////////
	// METHODS, PUBLIC
	///////////////////////////////////////////////////////////////////////////
	
	/**
	 * Constructor
	 * 
	 * @author	Iwo Kadziela
	 * @since	1.0 - 01.11.2012
	 * @access	public
	 * 
	 * @return	Wp_Yahoo_Suggest
	 */
	public function __construct($args = array()) {

		$this->textdomain	=	"wp-yahoo-suggest";
		$this->plugin_name	=	plugin_basename(__FILE__);

	
		if ( ! is_admin() ) {
			add_filter( 'init', array(
				&$this,
				'register_scripts_styles'
			), 9); // Set to 9, so they can easily be deregistered
				
			add_filter( 'wp_print_scripts', array(
				&$this,
				'print_scripts'
			));
			
			add_filter( 'wp_print_styles', array(
				&$this,
				'print_styles'
			));
		}		
	}
	
	
	/**
	 * Registers the script and stylesheet
	 * 
	 * The scripts and stylesheets can easilz be deregeistered be calling
	 * <code>wp_deregister_script( 'wp-search-suggest' );</code> or
	 * <code>wp_deregister_style( 'wp-search-suggest' );</code> on the init
	 * hook
	 * 
	 * @author	Iwo Kadziela
	 * @since	1.0 - 01.11.2012
	 * @access	public
	 * 
	 * @return	void
	 */
	public function register_scripts_styles() {

		wp_enqueue_script(
			'jquery-ui',
			'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js', 
			array('jquery'),
			'1.8.6',
			true
		);

		wp_register_script(
			$this->textdomain,
			plugins_url("/js/wp-yahoo-suggest.js", __FILE__),
			array('jquery-ui')
		);
		
		wp_register_style(
			$this->textdomain,
			plugins_url("/css/wp-yahoo-suggest.css", __FILE__),
			array()
		);
	}
	
	
	/**
	 * Enqueues the script
	 * 
	 * @author	Iwo Kadziela
	 * @since	1.0 - 01.11.2012
	 * @access	public
	 * 
	 * @return	void
	 */
	public function print_scripts() {
		wp_enqueue_script( $this->textdomain );
	}
	
	
	/**
	 * Enqueues the stylesheet
	 * 
	 * @author	Iwo Kadziela
	 * @since	1.0 - 01.11.2012
	 * @access	public
	 * 
	 * @return	void
	 */
	public function print_styles() {
		wp_enqueue_style( $this->textdomain );
	}

}  // End of class Wp_Yahoo_Suggest


new Wp_Yahoo_Suggest;