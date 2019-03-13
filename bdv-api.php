<?php
/**

 * @package EnablonCommunity

 */
/*
  Plugin Name: Vendmy Bon de Visite API
  Plugin URI: https://www.vendmy.com
  Description: Integration des DE BON DE PRIX API
  Version: 1.0
  Author: BabySitter
  Author URI: http://tutor.com

 */

define('WPBDVAPI_PLUGIN_FILE',__FILE__);
define('WPBDVAPI_DIR', plugin_dir_path(__FILE__));
 
define('WPBDVAPI_URL', plugin_dir_url(__FILE__));

define('BonDeVisiteAPI_URL_SITE', get_site_url() . "/");


class BonDeVisiteAPI {
    function __construct() {
        add_shortcode('WIDGET_BON_DE_VISITE', array($this, 'get_form_bdv'));   
        add_action( 'plugins_loaded', array($this, 'vc_mapping') );
        
    }   
    /*
     * INit LINKS
     */
    
    /*
     * ADD ACTION
     */


    /*
     * VISUAL COMPOSER INTEGRATION
     */

    function vc_mapping(){
        if(function_exists ('vc_map')){
            vc_map( 
                 array(
                    'base' => 'WIDGET_BON_DE_VISITE',
                    'name' =>__(  "VENDMY BON DE VISITE", 'js_composer'  ),
                    'class' => '',
                    'icon' =>'iw-default',// 'icon-heart',
                    'params' => array(
                        array(
                            'type' => 'textfield',                                
                            'param_name' =>'key',
                            'heading' => __(  'Key', 'js_composer'  ),
                            'description' =>  __(  "KEY OF API OF BON DE VISITE", 'js_composer'  )
                        )
                    ),
                ) 
            );
        }
    }
    /*
     * SHORCODE INTEGRATION
     */
    function get_form_bdv($atts = [], $content = null, $tag = ''){
        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array)$atts, CASE_LOWER);

            // override default attributes with user attributes
         $wporg_atts = shortcode_atts(
            [
                'key'=>  $this->maxItemsList
            ], $atts, $tag);
         $key = $wporg_atts['key'];
        if ( is_admin() ) {
                echo "Integration Bon de visite ";
        } else {
          if(isset($_GET['result_estimation'])){
           if (file_exists(WPBDVAPI_DIR . '/template/html/result.php')) 
                 require_once(WPBDVAPI_DIR . '/template/html/result.php');
          }else{

           if (file_exists(WPBDVAPI_DIR . '/template/html/home.php')) 
                 require_once(WPBDVAPI_DIR . '/template/html/home.php');
          }
        }
    }
    /**
     * POST ACTIONS
     */
    public static function Instance() {
        static $inst = null;
        if ($inst == null) {
            $inst = new BonDeVisiteAPI();
        }
        return $inst;
    }

}

BonDeVisiteAPI::Instance();