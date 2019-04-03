 <?php
/*
Plugin Name: estimater
Description: pluging d'estimation
Author: brice eyebe
Version: 0.1.0
*/


define('PARAMAPIURL_URL', plugin_dir_url(__FILE__));
class Estimeter
{

    public static $new_post=array(
            'post_name' => '',
            'post_type' => "estimater" ,
            'post_status' => 'publish',
            'post_content' => "" ,
            'post_title' => "new estimation"
    );
    public static $meta_datas=array(
            'lieu_key'=>'',
            'superficie_key'=>'',
            'piece_key'=>'',
            'chambre_key'=>'',
            'etage_key'=>'',
            'etat_bien_key'=>'',
            'email_key'=>'',
            'nom_key'=>'',
            'prenom_key'=>''
    );
    public static $taxo=array(
        'projet'=>'',
        'type'=>'',
        'caracteristiques'=>'',
        'limite'=>''
    );

    public static $Session_etape = array();
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        if (!isset($_SESSION))session_start();
        //$this->array_of_taxonomy();
        add_action( 'init',array($this,'wpm_custom_estimater'));
        add_action( 'init',array($this,'Generate_taxonomies'));
        add_action( 'pre_get_posts',array($this,'estimater_in_main_query'));
        //add_action('pre_get_posts','estimater_in_main_query');
        //add_filter( 'add_estmater', array($this, 'add_estmater_callback'));

        apply_filters( 'add_estmater',
            array(
                "post"=> array(
                    'ID' => "" ,
                    'post_name' => "post_date" ,
                    'post_type' => "estimater" ,
                    'post_status' => "" ,
                    'post_content' => "" ,
                    'post_title' => "" ,
                ),

                "post_mate"=> array(
                    'lieu' => "Cameroun" ,
                    'vente_loyer' => "" ,
                    'Appartement_maison' => "" ,
                    'surface' => "" ,
                    'nbre_chambres' => "" ,
                    'nbre_pieces' => "" ,
                    'etat' => "" ,
                    'etages' => "" ,
                    'nbre_etages' => "" ,
                ),

                "taxonomy"=> array(
                    "taxonomy"=>array(
                        'ID' => "caracteristique" ,
                        'post_name' => "post_date" ,
                        'post_type' => "estimater" ,
                        'post_status' => "" ,
                        'post_content' => "" ,
                        'post_title' => "" ,
                    )
                ),
            )
        );

        add_action( 'save_post',  array($this, 'wpt_save_estim_meta'), 1, 2 );
        add_filter( 'manage_estimater_posts_columns',array($this,'bbx_columns'));
        add_action( 'manage_estimater_posts_custom_column', array($this,'bbx_rows'), 10, 2 );
    }
    public static function array_of_taxonomy()
    {
        global $post;
        $all_taxo=array();
        $outpout='';
        $term ='';
        $tab = get_object_taxonomies('estimater',$outpout);
        foreach ($tab AS $keys=>$value){
            $term = get_terms($keys);
            //print_r($term);
            $all_taxo[$keys]=array();
            for ($k=0;$k<count($term);$k++)
            {
                ///$all_taxo[$keys]=array(
                    //$term[0]->term_id=>''
                //);
                print_r($term[$k]);
                array_push($all_taxo[$keys],$term[$k]->term_id);
                //print_r($term[$k]->term_id),taxonomy,parent;
            }
            ///print_r($all_taxo[$keys]);
        }
         //var_dump($all_taxo);

        //print_r($tab['type']->name);
        ;die();
        $taxo_list= ['projet','type','caracteristiques'];
        for ($i=0;$i<count($taxo_list);$i++)
        {
            $recov=self::get_Taxonomie($taxo_list[$i]);
            for ($k=0;$k<count($recov);$k++)
            {
                //$all_taxo[]
            }
        }
       ;die();

        //$taxonomies = wp_get();
        //print_r($taxonomies);die();
    }

    /*
     *@Filter Callback function
    */
    public function add_estmater_callback( $param )
    {
        return $param;
        //print_r($param);die();
    }



    /*
     *Auto create Session
     * @session_name string is the name of session
     * @$session_value string id the session value
     * the final name of session name => Stape$session_name
    */
    public static function AutoSession($session_name,$session_value)
    {
        if (!isset($_SESSION))session_start();
        $_SESSION['Stape_'.$session_name]=$session_value;

    }

    /*
     * not using
    */
    public static function save_taxonomy_terms($post_id,$taxo_name) {
        $meta = self::get_list_taxo($taxo_name);
        print_r($meta);die();
        wp_set_post_terms($post_id, $meta, $taxo_name, FALSE);

    }


    /*
     * show the view of creation of new estimation
    */
    public function estimater_in_main_query($query)
    {
        global $query;
        if(is_tax())
        {
            $query->set('post_type',array('post','page','estimater'));
        }
    }

    public function add_estimater($array)
    {

    }
    /*
     * To get the last post id
     * @return $id
     */
    public static function GetLastPostId()
    {
        global $wpdb;

        $query = "SELECT ID FROM $wpdb->posts ORDER BY ID DESC LIMIT 0,1";

        $result = $wpdb->get_results($query);
        $row = $result[0];
        $id = $row->ID;
        return $id;
    }

    /*
     * @Return the name of Taxonomy in array
     * @$taxo_name String is a name of taxonomy
     * @return array
    */
    private static function GEt_Taxo_name_In_array($taxo_name)
    {
        $array_taxo_name=[];
        $taxo = self::get_Taxonomie($taxo_name);
        for($i=0;$i<count($taxo);$i++){
            array_push($array_taxo_name,$taxo[$i]->name);
        }
        return $array_taxo_name;
    }


    /*
     * Creation of a new post of Custom post type estimater
     * @$array is associative array of post_content
     * 'post_name' => '',
     * 'post_type' => "estimater" ,
     * 'post_status' => 'publish',
     * 'post_content' => "" ,
     *  'post_title' => "new estimation"
    */
    public static function new_post_estimater($array)
    {
        /* Load taxonomy in array */
        $projet_array=self::GEt_Taxo_name_In_array('projet');
        $type_array=self::GEt_Taxo_name_In_array('type');
        $caracteristiques_array=self::GEt_Taxo_name_In_array('caracteristiques');
        $caracteristiques_array=self::GEt_Taxo_name_In_array('caracteristiques');
        $limite_array=self::GEt_Taxo_name_In_array('limite');
        if (empty(self::$taxo['projet'] ) && (!in_array(self::$taxo, $projet_array) ) ) {
             return;
        }
        wp_insert_post($array);
        $last_post_id=self::GetLastPostId();
        if (!empty(self::$new_post['post_type'])) {
            // Get the title of the post
            $title = self::$new_post['post_title'];
        }

        // Selected the different Taxonomy value
        wp_set_object_terms( $last_post_id, self::$taxo['projet'], 'projet');
        wp_set_object_terms( $last_post_id, self::$taxo['type'], 'type' );
        wp_set_object_terms( $last_post_id, self::$taxo['caracteristiques'], 'caracteristiques' );
        wp_set_object_terms( $last_post_id, self::$taxo['limite'], 'limite' );

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){return;}

        update_post_meta( $last_post_id, "superficie_key", self::$meta_datas['superficie_key'] );
        update_post_meta( $last_post_id, "etat_bien_key", self::$meta_datas['etat_bien_key']);
        update_post_meta( $last_post_id, "chambre_key", self::$meta_datas['chambre_key']);
        update_post_meta( $last_post_id, "piece_key", self::$meta_datas['piece_key'] );
        update_post_meta( $last_post_id, "etage_key", self::$meta_datas['etage_key'] );
        update_post_meta( $last_post_id, "nom_key", self::$meta_datas['nom_key'] );
        update_post_meta( $last_post_id, "prenom_key", self::$meta_datas['prenom_key']);
        update_post_meta( $last_post_id, "email_key", self::$meta_datas['email_key'] );
        update_post_meta( $last_post_id, "lieu_key", self::$meta_datas['lieu_key'] );

    }

    /* @Culumn Setter
     * @$column array
     * @return  array
     */
    public function bbx_columns($column){
        unset( $column['author'] );
        unset( $column['date'] );
        unset( $column['Titre'] );
        $column['lieux'] =  __( 'lieux', 'twentythirteen' );
        $column['auteur'] =  __( 'auteur', 'twentythirteen' );
        return $column;
    }

    /*
     * Get the new Collum in admin table estimater
    */
    public function bbx_rows( $column, $post_id )
    {
        switch ( $column ):
            case 'auteur':
                echo
                    '
                      <div style="padding: 1%;color:#0083c5" class="">
                           <span> Nom : '.$this->show_get_post($post_id,"nom_key").'</span>
                           <span>'.$this->show_get_post($post_id,"email_key").'</span><br>                      
                      </div>                
                    ';
                break;
            case 'lieux':
                echo
                    '
                      <div style="padding: 1%;color:#0083c5" class="">
                           <span>'.$this->show_get_post($post_id,'lieu_key').'</span><br>
                      </div>                
                    ';
                break;
            default:
                break;
        endswitch;
    }


    public static function get_Taxonomie($taxonomie_name)
    {
        return  get_terms($taxonomie_name,'hide_empty=0');
    }

    public  function get_list_taxo($taxonomie_name)
    {
        return  get_terms($taxonomie_name,'hide_empty=0');
    }


    /*
     * Generation of Taxonomie "estimater"
    */
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

    /*
    * Meta_box location select  Template
    */
    public function estimater_start_callback_redirect_link($post_id)
    {
        global $post;
        wp_nonce_field( basename( __FILE__ ), 'event_fields' );
        echo '
             <div class="bage-descrip" style="border-bottom: 2px solid #f1f1f1">
                  <label for="">Lieu :</label><br>
                  <input type="text" required name="lieu" value="'.$this->show_get_post($post_id->ID,'lieu_key').'" style="width: 95%;margin: 10px 10px;"><br>
             </div>   
        ';
    }

    /*
     * Meta_box User information  Template
    */
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


    /*
     * Meta_box Detail Template
    */
    public function estimater_callback_can_view($post_id){
        global $post;
        $url = get_post_meta($post->ID,'superficie_key',true);

        wp_nonce_field('controle_action_make_detail','controle_action_make0001');
        echo '
                <div class="">
                    <div>
                        <label for="">superficie :</label><br>
                        <input type="number" name="super" value="'.$this->show_get_post($post->ID,'superficie_key').'" style="width: 95%;margin: 10px 10px;"><br>
                        <label for="">Nombre de piece(s) :</label><br>  
                        <input type="number" name="piece" value="'.$this->show_get_post($post->ID,'piece_key').'" style="width: 95%;margin: 10px 10px;"><br>
                        <label for="">chambre :</label><br>
                        <input type="number" name="chambre"  value="'.$this->show_get_post($post->ID,'chambre_key').'" style="width: 95%;margin: 10px 10px;"><br>
                        <label for="">Etage :</label><br>
                        <input type="number"  name="etage"  value="'.$this->show_get_post($post->ID,'etage_key').'" style="width: 95%;margin: 10px 10px;"><br>
                        <label for="">Etat du bien :</label><br>
                        <select name="etat_bien" id="" style="width: 95%;margin: 10px 10px;">
                           
                             <option value="Refait a neuf">Refait a neuf</option>
                             <option value="Standard">Standard</option>
                             <option value="necessite des traveaux importants">necessite des traveaux importants</option>
                        </select>
                    </div>
                </div>
             ';
    }

    /*
     *Get meta_box_element
     * @$id int id of meta_post
     * @$key String key of meta_post
     * @EXP : show_get_post(118,'lieu_key')
    */
    public function show_get_post($id,$key)
    {
        return get_post_meta($id,$key,true);
    }

    /*
     * Add A new meta_bon on the View
    */
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
     *
    */
    public static function save_post_estimater($array_meta,$array_taxo=null)
    {
        global $post;
        $post_id = $post->ID;
        foreach ($array_meta as $key=>$value)
        {
            //update_post_meta( $post_id,$key,$value);
            echo $key.' '.$value.' Post ID '.$post_id.'<br>';
        }

    }


    /*
     *Save Meta_box values
    */
    public static function wpt_save_estim_meta( $post_id, $post ) {
        global $wpdb;
        self::AutoSession('curent_post_id',$post_id);
        if(isset($_POST['lieu']) && isset( $_POST['super']) && isset($_POST['piece']) && isset($_POST['chambre']) && isset($_POST['etage']) && isset($_POST['etat_bien']) && isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom'])){
            check_admin_referer('controle_action_make_detail','controle_action_make0001');
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){return;}
            update_post_meta( $post_id, "superficie_key", $_POST['super'] );
            update_post_meta( $post_id, "etat_bien_key", $_POST['etat_bien'] );
            update_post_meta( $post_id, "chambre_key", $_POST['chambre'] );
            update_post_meta( $post_id, "piece_key", $_POST['piece'] );
            update_post_meta( $post_id, "etage_key", $_POST['etage'] );
            update_post_meta( $post_id, "nom_key", $_POST['nom'] );
            update_post_meta( $post_id, "prenom_key", $_POST['prenom']);
            update_post_meta( $post_id, "email_key", $_POST['email'] );
            update_post_meta( $post_id, "lieu_key", $_POST['lieu'] );
        }
    }




    /*
     * Gerate Taxonomi of CTP
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
            'hierarchical'      => true,
            'labels'            => $labels_type,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
        );
        register_taxonomy( 'type', 'estimater', $args_type);


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
            'name'              			=> _x( 'Limite projets', 'taxonomy general name'),
            'singular_name'     			=> _x( 'Limite projet', 'taxonomy singular name'),
            'all_items'        				=> __( 'Toutes les limites projets'),
            'edit_item'         			=> __( 'Editer une limite projet'),
            'update_item'       			=> __( 'Mettre à jour une Limte projet'),
            'add_new_item'     				=> __( 'Ajouter une limite projet'),
            'new_item_name'     			=> __( 'Valeur de la limite projet'),
            'menu_name'         => __('Limite projets'),
        );

        $args_statut_projet = array(
            'hierarchical'      => true,
            'labels'            => $labels_statut_projet,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'public'            =>false
            //'rewrite'           => array( 'slug' => 'annees' ),
        );
        register_taxonomy( 'limite', 'estimater', $args_statut_projet);
    }

    public static function Instance() {
        static $inst = null;
        if ($inst == null) {
            $inst = new Estimeter();
        }
        return $inst;
    }

}

Estimeter::Instance();
