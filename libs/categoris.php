<?php

  function wpm_custom_estimater()
  {
      // On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
      $labels = array(
          // Le nom au pluriel
          'name'                => _x( 'estimaters', 'Post Type General Name'),
          // Le nom au singulier
          'singular_name'       => _x( 'estimater', 'Post Type Singular Name'),
          // Le libellé affiché dans le menu
          'menu_name'           => __( 'Estimater'),
          // Les différents libellés de l'administration
          'all_items'           => __( 'Toutes les estimaters'),
          'view_item'           => __( 'Voir les estimaters'),
          'add_new_item'        => __( 'Ajouter une categorie'),
      );

// On peut définir ici d'autres options pour notre custom post type

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
          //'rewrite'			    => array( 'slug' => 'estimater'),

      );

// On enregistrement du custom type Estimater
      register_post_type( 'Estimater', $args );
  }



add_action( 'init', 'wpm_custom_estimater', 0 );



add_action( 'init', 'wpm_add_taxonomies', 0 );

//On crée 3 taxonomies personnalisées:

function wpm_add_taxonomies() {

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


    // Taxonomie options

    $labels_options = array(
        'name'              			=> _x( 'Options', 'taxonomy general name'),
        'singular_name'     			=> _x( 'Option', 'taxonomy singular name'),
        'search_items'      			=> __( 'Chercher une option'),
        'all_items'        				=> __( 'Tous les options'),
        'edit_item'         			=> __( 'Editer une option'),
        'update_item'       			=> __( 'Mettre à jour une option'),
        'add_new_item'     				=> __( 'Ajouter une nouvelle option'),
        'new_item_name'     			=> __( 'Valeur de la nouvelle option'),
        'menu_name'         => __( 'options'),
    );

    $args_option = array(
        // Si 'hierarchical' est défini à false, notre taxonomie se comportera comme une étiquette standard
        'hierarchical'      => true,
        'labels'            => $labels_options,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        //'rewrite'           => array( 'slug' => 'annees' ),
    );
    register_taxonomy( 'options', 'estimater', $args_option);
}