<?php

define('PARAMAPIURL_URL', plugin_dir_url(__FILE__));
class Estimeter
{
    public static $Session_etape = array();
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        if (!isset($_SESSION))session_start();
        add_action( 'init',array($this,'wpm_custom_estimater'));
        add_action( 'init',array($this,'Generate_taxonomies'));
        //apply_filters( "add_estimater", array("lieu"=>'', "type"=>'', "superficie"=>''));
        add_action('restrict_manage_posts',array($this, 'monsite_restrict_manage_posts'), 1, 2 );
        add_action( 'save_post',  array($this, 'wpt_save_estim_meta'), 1, 2 );
        //$this->new_taxonomie('nombre_piece','argument','estimater','nombre-piece');
        add_filter( 'manage_estimater_posts_columns',array($this,'bbx_columns'));
        add_action( 'manage_estimater_posts_custom_column', array($this,'bbx_rows'), 10, 2 );
    }
    /*
     *
     */
    public static function AutoSession($session_name,$session_value)
    {
        if (!isset($_SESSION))session_start();
        $_SESSION['Stape_'.$session_name]=$session_value;

    }

    public function add_estimater($array)
    {

    }

    /* @Culumn Setter
     * @$column array
     * @return  array
     */
    public function bbx_columns($column){
       unset( $column['author'] );
        unset( $column['date'] );
        $column['lieux'] =  __( 'lieux', 'twentythirteen' );
        $column['auteur'] =  __( 'auteur', 'twentythirteen' );
        return $column;
    }

    /*
     * */
    public function bbx_rows( $column, $post_id ) {
        switch ( $column ):
            case 'auteur':
                //print_r($post_id);
                echo $this->show_get_post($post_id,'email_key');
                break;
            case 'lieux':
                echo $this->show_get_post($post_id,'lieu_key');
                break;
            default:
                break;
        endswitch;
    }






    public static function get_Taxonomie($taxonomie_name)
    {
       return  get_terms($taxonomie_name,'hide_empty=0');
    }



    public function wpm_custom_estimater()
    {
        /*
         * On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
         */
        $labels = array(
                'name'                => _x( 'estimaters', 'Post Type General Name'),
                'singular_name'       => _x( 'estimater', 'Post Type Singular Name'),
                'menu_name'           => __( 'estimater'),
                'all_items'           => __( 'Toutes les estimaters'),
                'view_item'           => __( 'Voir les estimaters'),
                'add_new_item'        => __( 'Ajouter une categorie'),
        );

        /*
         *On peut définir ici d'autres options pour notre custom post type
         *
         */
        $args = array(
                'label'               => __( 'prix'),
                'description'         => __( 'Tous sur les estimations'),
                'labels'              => $labels,
                // On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
                'supports'            => array( 'title','type','caracteristique','author', 'custom-fields', ),
                /*
                * Différentes options supplémentaires
                */
                'hierarchical'        => false,
                'public'              => true,
                'has_archive'         => true,
                'capability_type' => 'page',
                'register_meta_box_cb'=>array($this, "add_attachment_meta"),
                'register_meta_box_cb' =>array($this, 'estimer_add_meta')
                //'rewrite'			    => array( 'slug' => 'estimater'),
        );

        /*
         * Save  a custom type Estimater
         */
            register_post_type( 'estimater', $args );
    }

    function estimater_start_callback_redirect_link($post_id){
        global $post;
        wp_nonce_field( basename( __FILE__ ), 'event_fields' );
        echo '
             <div class="bage-descrip" style="border-bottom: 2px solid #f1f1f1">
                    <label for="">Lieu :</label><br>
                    <input type="text" required name="lieu" value="'.$this->show_get_post($post_id->ID,'lieu_key').'" style="width: 95%;margin: 10px 10px;"><br>
             </div>   
        
        ';
    }

    public function estimater_callback_user_info($post_id)
    {
        global $post;
        echo
        '
                            <label for="">Nom :</label><br>
                            <input type="text" required name="nom" value="'.$this->show_get_post($post_id->ID,'nom_key').'" style="width: 95%;margin: 10px 10px;"><br>
                            <label for="">Prenom :</label><br>
                            <input type="text" required name="prenom" value="'.$this->show_get_post($post_id->ID,'prenom_key').'" style="width: 95%;margin: 10px 10px;"><br>
                            <label for="">email :</label><br>
                            <input type="email" required name="email" value="'.$this->show_get_post($post_id->ID,'email_key').'" style="width: 95%;margin: 10px 10px;"><br>
                           
                            
        ';
    }

    function monsite_restrict_manage_posts(){
        global $post_type_object;
        if($post_type_object->name == 'estimater'){
            ?>
            <select name="etat_bien">
                <option value="all">Tous</option>
                <option value="valeur1" <?php if($_GET['etat_bien'] == $valeur1) $selected = 'selected="selected"';?>>Valeur 1</option>
                <option value="valeur2" <?php if($_GET['etat_bien'] == $valeur2) $selected = 'selected="selected"';?>>Valeur 2</option>
            </select>
            <?php
        }
    }


    function estimater_callback_can_view($args){
        global $post;
        $post_id = $_SESSION['Stape_curent_post_id'];
            $url = get_post_meta($post->ID,'superficie_key',true);
            //print_r($post_id);die();
            echo '
                <div class="">
                    <div>
                        <!--form method="get" action="" class="details-data"-->
                            <label for="">superficie :</label><br>
                            <input type="number" name="super" value="'.$this->show_get_post($post_id,'superficie_key').'" style="width: 95%;margin: 10px 10px;"><br>
                            
                            <label for="">Nombre de pieces :</label><br>
                            <input type="number" name="piece"  value="'.$this->show_get_post($post_id,'piece_key').'" style="width: 95%;margin: 10px 10px;"><br>
                            <label for="">chambre :</label><br>
                            <input type="number" name="chambre"  value="'.$this->show_get_post($post_id,'chambre_key').'" style="width: 95%;margin: 10px 10px;"><br>
                            <label for="">Etage :</label><br>
                            <input type="number"  name="etage"  value="'.$this->show_get_post($post_id,'etage_key').'" style="width: 95%;margin: 10px 10px;"><br>
                            <label for="">Etat du bien :</label><br>
                            <select name="etat_bien" id="" style="width: 95%;margin: 10px 10px;">
                                <option value="Refait a neuf">Refait a neuf</option>
                                <option value="Standard">Standard</option>
                                <option value="necessite des traveaux importants">necessite des traveaux importants</option>
                            </select>
                      
                        <!--/form-->
                    </div>
                </div>
             ';

    }
    public function show_get_post($id,$key)
    {
        return get_post_meta($id,$key,true);
    }

    public function estimer_add_meta()
    {
        add_meta_box(
            'estimater_start_callback_redirect_link',
            'lieu',
            array($this,'estimater_start_callback_redirect_link'),
            'Estimater',
            'aside',
            'high'
        );
        add_meta_box(
            'estimater_callback_can_view',
            'Detail du bien',
            array($this,'estimater_callback_can_view'),
            'Estimater',
            'normal',
            'high'
        );
        add_meta_box(
            'estimater_callback_user_info',
            'User info',
            array($this,'estimater_callback_user_info'),
            'Estimater',
            'normal',
            'high'
        );
    }

    /*save meta from fond end
     * @array_ameta
     * */
    public static function save_post_estimater($array_meta,$array_taxo=null)
    {
        global $post;
        $post_id = $_POST['post_ID'];
        foreach ($array_meta as $key=>$value)
        {
            update_post_meta( $post_id,$key,$value);
        }

    }

    public static function wpt_save_estim_meta( $post_id, $post ) {
        global $wpdb;
        $post_id = $_POST['post_ID'];
        //print_r($_POST['nom']);die();
        self::AutoSession('curent_post_id',$post_id);
        if(isset($_POST['lieu']) && isset( $_POST['super']) && isset($_POST['piece']) && isset($_POST['chambre']) && isset($_POST['etage']) && isset($_POST['etat_bien'])){
           // print_r($_POST['post_ID']);die();
            update_post_meta( $post_id, "superficie_key", $_POST['super'] );
            update_post_meta( $post_id, "etat_bien_key", $_POST['etat_bien'] );
            update_post_meta( $post_id, "chambre_key", $_POST['chambre'] );
            update_post_meta( $post_id, "piece_key", $_POST['piece'] );
            update_post_meta( $post_id, "etage_key", $_POST['etage'] );
            update_post_meta( $post_id, "nom_key", $_POST['nom'] );
            update_post_meta( $post_id, "prenom_key", $_POST['prenom']);
            update_post_meta( $post_id, "email_key", $_POST['email'] );
            update_post_meta( $post_id, "lieu_key", $_POST['lieu'] );
            $val = get_post_meta($post_id,'superficie_key',true);
            //$vals= '';
            //print_r($val);die();

            $sql = "SELECT meta_value FROM {$wpdb->postmeta} where post_id ='1'";
            $results = $wpdb->get_results( $sql);
            //print_r($results);die();
            foreach( $results as $result ){
                $vals[] = $result;
            }


           // print_r($vals);die();
        }
    }




    /*
     * Add a new taxonomi
     * @name=>string (name of new Taxonomie)
     * @object=>string (name of CTP)
     * @Label=>[array]associative array info taxonomie
     * @Argument=>[array]associative array argument taxonomie
    */

    public function Generate_taxonomies()
    {
        // Taxonomie type d'estimation

        $labels_type = array(
            'name'              			=> _x( 'Types', 'taxonomy general name'),
            'singular_name'     			=> _x( 'Types', 'taxonomy singular name'),
            //'search_items'      			=> __( 'Chercher un lieux'),
            'all_items'        				=> __( 'Tous les types'),
            'edit_item'         			=> __( 'Editer un type'),
            'update_item'       			=> __( 'Mettre à jour un type'),
            'add_new_item'     				=> __( 'Ajouter un nouveau type'),
            'new_item_name'     			=> __( 'Valeur du  nouveau type'),
            'menu_name'         => __( 'type'),
        );

        $args_type = array(
            // Si 'hierarchical' est défini à false, notre taxonomie se comportera comme une étiquette standard
            'hierarchical'      => true,
            'labels'            => $labels_type,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            //'rewrite'           => array( 'slug' => '' ),
        );



        register_taxonomy( 'type', 'estimater', $args_type);
        // On déclare ici les différentes dénominations de notre taxonomie qui seront affichées et utilisées dans l'administration de WordPress
        $labels_caracteristique = array(
            'name'              			=> _x( 'Caracteristiques', 'taxonomy general name'),
            'singular_name'     			=> _x( 'Caracteristique', 'taxonomy singular name'),
            'search_items'      			=> __( 'Chercher une caracteristique'),
            'all_items'        				=> __( 'Toutes les caracteristiques'),
            'edit_item'         			=> __( 'Editer une caracteristique'),
            'update_item'       			=> __( 'Mettre à jour une caracteristique'),
            'add_new_item'     				=> __( 'Ajouter une nouvelle caracteristique'),
            'new_item_name'     			=> __( 'Valeur de la  nouvelle caracteristique'),
            'menu_name'         => __( 'caracteristique'),
        );

        $args_caracteristique = array(
            // Si 'hierarchical' est défini à false, notre taxonomie se comportera comme une étiquette standard
            'hierarchical'      => true,
            'labels'            => $labels_caracteristique,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'public'            =>false
            //'rewrite'           => array( 'slug' => 'annees' ),
        );

        register_taxonomy( 'caracteristiques', 'estimater', $args_caracteristique);


        $labels_projet = array(
            'name'              			=> _x( 'projets', 'taxonomy general name'),
            'singular_name'     			=> _x( 'projet', 'taxonomy singular name'),
            'all_items'        				=> __( 'Tous les projets'),
            'edit_item'         			=> __( 'Editer un projet'),
            'update_item'       			=> __( 'Mettre à jour un projet'),
            'add_new_item'     				=> __( 'Ajouter un projet'),
            'new_item_name'     			=> __( 'Valeur du projet'),
            'menu_name'         => __( 'projet'),
        );

        $args_projet = array(
            // Si 'hierarchical' est défini à false, notre taxonomie se comportera comme une étiquette standard
            'hierarchical'      => true,
            'labels'            => $labels_projet,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'public'            =>false
            //'rewrite'           => array( 'slug' => 'annees' ),
        );

        register_taxonomy( 'projet', 'estimater', $args_projet);


        $labels_statut_projet = array(
            'name'              			=> _x( 'statut_projets', 'taxonomy general name'),
            'singular_name'     			=> _x( 'statut_projet', 'taxonomy singular name'),
            'all_items'        				=> __( 'Tous les statut_projets'),
            'edit_item'         			=> __( 'Editer un statut_projet'),
            'update_item'       			=> __( 'Mettre à jour un statut_projet'),
            'add_new_item'     				=> __( 'Ajouter un statut_projet'),
            'new_item_name'     			=> __( 'Valeur du statut_projet'),
            'menu_name'         => __( 'statut_projet'),
        );

        $args_statut_projet = array(
            // Si 'hierarchical' est défini à false, notre taxonomie se comportera comme une étiquette standard
            'hierarchical'      => true,
            'labels'            => $labels_statut_projet,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'public'            =>false
            //'rewrite'           => array( 'slug' => 'annees' ),
        );

        register_taxonomy( 'statut_projet', 'estimater', $args_statut_projet);






    }

    public function new_taxonomie($label,$argument,$ctp_name,$taxo_name)
    {
        $label = array(
            'name'              			=> _x( $label, 'taxonomy general name'),
            'singular_name'     			=> _x( $taxo_name, 'taxonomy singular name'),
            'all_items'        				=> __( 'Tous les '.$taxo_name),
            'edit_item'         			=> __( 'Editer '.$taxo_name),
            'update_item'       			=> __( 'Mettre à jour'.$taxo_name),
            'add_new_item'     				=> __( 'Ajouter'.$taxo_name),
            'new_item_name'     			=> __( 'Valeur'.$taxo_name),
            'menu_name'         => __($taxo_name),
        );

        $argument = array(
            // Si 'hierarchical' est défini à false, notre taxonomie se comportera comme une étiquette standard
            'hierarchical'      => true,
            'labels'            => $label,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'public'            =>false
            //'rewrite'           => array( 'slug' => 'annees' ),
        );

        register_taxonomy( $taxo_name, $ctp_name, $argument);
    }



}
