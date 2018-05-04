<?php
/**
 * Sections & Templating
 * https://hwk.fr/blog/wordpress-afficher-des-templates-parts-avec-des-requetes-parametres-integres
 */
function wpsst_section($args = array()){
    
    // Arguments par défaut
    $args = wp_parse_args_recursive($args, array(
        'template'      => 'sections/loop.php', // Fichier de Template par défaut: /wp-content/themes/<theme>/loop.php
        'not_found'     => false, 	            // Fichier de Template en cas de résultat non trouvé
        'pagination'    => false, 	            // Paramètre de pagination. Utilisé par le fichier de Template. true | false
        'query'         => array(), 	        // Arguments de WP_Query. Si vide, alors utiliser la WP_Query globale
        'query_addon'   => false, 	            // Utiliser l'argument 'query' pour l'ajouter à la WP_Query globale. true | false
        'result'        => array(), 	        // Injecter directement les résultats d'une Query antérieur. Bypass l'argument 'query'
        'title'         => false, 	            // Afficher un titre
        'comments'      => false, 	            // Afficher les commentaires
        'exclude'       => array(
            'add'   => true, 		            // Ajouter les résultats dans la liste des posts à exclure pour les prochains appels. true | false
            'get'   => true 		            // Utiliser la liste des posts à exclure pour cette Query. true | false
        ),
        'options'       => array(), 	        // Tableau d'options personnalisés.
        'wrapper'       => array(
            'title'     => false, 	            // Afficher le titre avant le wrapper au lieu d'être à l'intérieur
            'element'   => 'section', 	        // Element <div> qui servira de conteneur à notre Template
            'attr'      => array(
                'id'        => '', 	            // Ajouter un attribut id=""
                'class'     => '', 	            // Ajouter un attribut class=""
                'style'     => '' 	            // Ajouter un attribut style=""
            ), 				                    // Note: Il est possible d'ajouter son propre attribut personnalisé ici.
        )
    ));
	
    // Get Global WP_Query
    global $wp_query;
    
    // Exclude: GET query_var
    $exclude = get_query_var('wpsst_section_exclude', array());
    
    // Result: si existe, pas de WP_Query
    if(empty($args['result'])){
        
        // Query: Executer une nouvelle WP_Query
        if(!empty($args['query'])){
            
            // Query Addon: Utiliser les arguments de la WP_Query globale pour créer une nouvelle Query
            if($args['query_addon'] && isset($wp_query->query) && !empty($wp_query->query))
                $args['query'] = $wp_query->query;
            
            // Exclude: Ajouter 'post__not_in' à la WP_Query
            if($args['exclude']['get'] && !empty($exclude))
                $args['query']['post__not_in'] = $exclude;
            
            // New WP_Query
            $args['result'] = new WP_Query($args['query']);
            
        }else{
            
            // Utiliser la WP_Query globale
            $args['result'] = $wp_query;
            
            // Récupération des arguments de la WP_Query globale
            if(isset($wp_query->query) && !empty($wp_query->query))
                $args['query'] = $wp_query->query;
            
        }
        
    }
    
    // Not Found: Inclure le fichier 'not_found' si défini
    if(!$args['result']->have_posts() && $args['not_found'])
        return locate_template(array($args['not_found']), true, false);
        
    // Exclude: SET query_var
    if($args['exclude']['add']){
        foreach($args['result']->posts as $p){
            if(in_array($p->ID, $exclude))
                continue;
        
            $exclude[] = $p->ID;
        }
    
        set_query_var('wpsst_section_exclude', $exclude);
    }
    
    // Ajout de tous les paramètres dans une query_var
    set_query_var('wpsst_section', $args);
    
    if($args['title'] && $args['wrapper']['title'])
        echo $args['title'];
    
    // Début du Wrapper. Si défini
    wpsst_section_wrapper('start', $args);
		
	// Affichage du Template
        locate_template(array($args['template']), true, false);
	
    // Fin du Wrapper. Si défini
    wpsst_section_wrapper('end', $args);
    
    return;
}

function wpsst_section_wrapper($type = 'start', $args = false){
    if(!$args)
        $args = get_query_var('wpsst_section');
    
    if(!$args)
        return;
    
    if($type == 'start' && $args['wrapper']['element'])
        echo '<' . $args['wrapper']['element'] . wpsst_section_attr($args) . '>';
    
    elseif($type == 'end' && $args['wrapper']['element'])
        echo '</' . $args['wrapper']['element'] . wpsst_section_attr($args) . '>';
        
    return;
}

function wpsst_section_attr($args = false){
    if(!$args)
        $args = get_query_var('wpsst_section');
    
    if(!$args)
        return;
    
    if(!isset($args['wrapper']['attr']) || empty($args['wrapper']['attr']))
        return;
    
    $return = '';
    foreach($args['wrapper']['attr'] as $attr => $value){
        if(empty($value))
            continue;
        
        $return .= ' ' . $attr . '="' . $value . '"';
    }
    
    return $return;
}