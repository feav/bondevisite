<?php
/**

 * @package EnablonCommunity

 */
/*
  Plugin Name: Vendmy Bon de Visite API
  Plugin URI: https://www.vendmy.com
  Description: Integration des DE BON DE PRIX API
  Version: 1.0
  Author: Vendmy
  Author URI: http://Vendmy.com

 */

define('WPBDVAPI_PLUGIN_FILE',__FILE__);
define('WPBDVAPI_DIR', plugin_dir_path(__FILE__));
 
define('WPBDVAPI_URL', plugin_dir_url(__FILE__));

define('BonDeVisiteAPI_URL_SITE', get_site_url() . "/");


class BonDeVisiteAPI {
    function __construct() {
        add_shortcode('WIDGET_BON_DE_VISITE', array($this, 'get_form_bdv'));   
        add_action( 'plugins_loaded', array($this, 'vc_mapping') );
        add_filter( 'add_estmater', array($this, 'add_estmater_callback'));
        
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

    function add_estmater_callback( $example ) {
        // Maybe modify $example in some way.
        return $example;
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
          if(isset($_GET['filter'])){
            var_dump( );
          }else if(isset($_GET['result_estimation'])){
           if (file_exists(WPBDVAPI_DIR . '/template/html/result.php')) 
                 require_once(WPBDVAPI_DIR . '/template/html/result.php');
           

 ob_start();
            ?>
                <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
                <div style='padding: 3% 20%;background: #ececec'>
                    <div style='background: white'>
                        <div style='background: #426390;color: white;font-size: x-large;font-weight: bold;text-align: center;padding: 4%;'>Une nouvelle estimation depuis votre site</div>
                        <div style='padding: 1% 6%;'>
                            <p>Bonjour, <b>Vendmy</b></p>
                            <p>Un visiteur de votre site vient d'effectuer une estimation sur le widget Bon de Visite.</p>
                            <p style='color: #42638f;'>Adresse du bien : <b>
                                <?php echo (isset($_GET['lieu'])?$_GET['lieu']:'');?></b></p>
                            <!-- <p style='color: #42638f;'>Montant de l'estimation : <b>737239.8 €</b></p> -->
                            <div style='text-align: center;    padding: 10px;'>
                                <a href="<?php echo "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."&share=on" ?>" target='blank' style='text-align: center;background: #42638f;color: white;text-decoration: none;padding: 10px;'>OUVRIR L'ESTIMATION</a>
                            </div>
                            <br>
                            <p><b>Voici les informations :</b></p>
                            <p>Type du bien  :<b>
                                <?php echo ( isset($_GET['type']) ? ( ( ((int)$_GET['type']) == 0 )?'Appartement':'Maison'):'Non defini');?>
                                
                            </b></p>
                            <p>Surface  :<b>
                                <?php echo ( isset($_GET['surface']) ?$_GET['surface'] : 'Non defini') ; ?> m²</b></p>
                            <!-- <p>Surface du terrain  :<b> 0 m²</b></p> -->
                            <p>Nombre de pièces  :<b> <?php echo ( isset($_GET['pieces']) ?$_GET['pieces'] : 'Non defini') ; ?> </b></p>
                            <p>Nombre de chambres  :<b>  <?php echo ( isset($_GET['chambres']) ?$_GET['chambres'] : 'Non defini') ; ?>  </b></p>

                            <p>Numero de l'étage  :<b>  <?php echo ( isset($_GET['etages']) ?$_GET['etages'] : 'Non defini') ; ?>  </b></p>
                            <p>Nombre d'étages  :<b>  <?php echo ( isset( $_GET['etage_im'] ) ? $_GET['etage_im']:'Non defini' );?> </b></p>
                            <br>
                            <p>Annexes : <b>
                                <?php echo ( isset( $_GET['Balcon'] ) ? ( ( ((int)$_GET['Balcon'])==1 )? 'Balcon, ':''):'');?>
                                <?php echo (isset($_GET['Concierge'])?((((int)$_GET['Concierge'])==1)?'Concierge, ':''):'');?>
                                <?php echo (isset($_GET['Cuisine'])?((((int)$_GET['Cuisine'])==1)?'Cuisine, ':''):'');?>
                                <?php echo (isset($_GET['Piscine'])?((((int)$_GET['Piscine'])==1)?'Piscine, ':''):'');?>
                                <?php echo (isset($_GET['Chauffage'])?((((int)$_GET['Chauffage'])==1)?'Chauffage, ':''):'');?>
                                <?php echo (isset($_GET['Garage'])?((((int)$_GET['Garage'])==1)?'Garage, ':''):'');?>
                                <?php echo (isset($_GET['Terrasse'])?((((int)$_GET['Terrasse'])==1)?'Terrasse, ':''):'');?>
                                <?php echo (isset($_GET['Ascenseur'])?((((int)$_GET['Ascenseur'])==1)?'Ascenseur, ':''):'');?>
                                <?php echo (isset($_GET['Parking'])?((((int)$_GET['Parking'])==1)?'Parking, ':''):'');?>
                                <?php echo (isset($_GET['Cave'])?((((int)$_GET['Cave'])==1)?'Cave ':''):'');?>


                            </b></p>
                            <br>
                            <p><b>Etat du bâtiment et des parties  :</b></p>
                            <p>Global  :<b>
                                <?php echo (isset($_GET['etat'])?((((int)$_GET['etat'])==0)?'Refait à neuf ':''):'');?>
                                <?php echo (isset($_GET['etat'])?((((int)$_GET['etat'])==1)?'Standard ':''):'');?>
                                <?php echo (isset($_GET['etat'])?((((int)$_GET['etat'])==2)?'Nécessite un rafraichissement':''):'');?>
                                <?php echo (isset($_GET['etat'])?((((int)$_GET['etat'])==3)?'Nécessite des travaux importants':''):'');?>
                            </b></p>
                            <br>
                            <p><b>Coordonnées  :</b></p>
                            <p>Souhaite  :<b>
                                <?php echo (isset($_GET['souhait'])?((((int)$_GET['souhait'])==0)?'Je suis propriétaire bailleur':'Je suis locataire'):'');?>
                            </b></p>
                            <p>Adresse email  :<b>
                                <?php echo (isset($_GET['email'])?$_GET['email']:'Non definie');?>
                                </b></p>
                            <p>Téléphone  :<b> 
                                <?php echo (isset($_GET['phone'])?$_GET['phone']:'Non defini');?>
                                </b></p>
                            <br>
                            <p>N'attendez pas pour entrer en contact avec contact@vendmy.com! </p>
                            <br>
                            <p>Message destiné à <?php echo (isset($_GET['prenom'])?$_GET['prenom']:'');?> <?php echo (isset($_GET['names'])?$_GET['names']:'');?></p>
                            <br>
                            <p style='text-align: center;'> Merci de votre confiance,</p>
                            <p style='text-align: center;'>L'équipe <b>Vendmy</b></p>
                        </div>
                    </div>
                </div>
                <style type='text/css'>
                    *{font-family: Raleway,sans-serif;font-size: 103%;}
                </style>
            <?php
            $message =  ob_get_contents() ;
            ob_end_clean();
            $to = "contact@vendmy.com";
            $subject = "Estimation Vendmy";

            $headers  = array( );
            $headers[] = "MIME-Version: 1.0 \r\n";
            $headers[] = "Content-Type: text/html; charset=ISO-8859-1 \r\n"; 
            $time = time();
            $show = (isset($_GET['share'])?false:true);
            $oldtime = (int)(isset($_GET['time'])?$_GET['time']:0);
            if($oldtime - $time > 600)
                $show = false;
            if($show){
                // wp_mail("contact@vendmy.com",$subject,$message,$headers);
               // wp_mail("contact@vendmy.com",$subject,$message,$headers);
                //wp_mail($_GET['email'],$subject,$message,$headers);
            }



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