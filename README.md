# WP Smart Start Theme

Intégration du Smart Theme, excercice WP Media.

+ Author: WP Media
+ Dev: https://hwk.fr
+ Prefix: wpsst
+ Text-domain: wpsst

Plugins requis:

+ Advanced Custom Fields Pro
+ Contact Form 7
+ WP-PageNavi

## Installation

+ Activer le Thème
+ Activer Advanced Custom Fields Pro
+ Activer Contact Form 7
+ Activer WP-PageNavi


+ Créer une nouvelle page "Homepage"
+ Créer une nouvelle page "Blog"
+ Créer une nouvelle page "Contact"
    + Editer la page "Contact", définir en Page Template: Contact & sauvegarder
    + Mettre à jour les champs personnalisés et sauvegarder de nouveau
    
+ Créer une nouvelle page "Projects"
    + Editer la page "Projects". Dans la metabox à droite "Post Type Archive": définir le post type "Project" & sauvegarder
    + Editer les champs personnalisés et sauvegarder de nouveau
+ Créer une nouvelle page "Team"
    + Editer la page "Team". Dans la metabox à droite "Post Type Archive": définir le post type "Team" & sauvegarder
    + Editer les champs personnalisés
    + Définir un contenu de page
    + Sauvegarder la page de nouveau

+ Dans les Réglages > Lecture: Définir une page d'accueil statique: "Homepage"
    + Editer la page "Homepage" et sauvegarder les champs personnalisés.
+ Dans les Réglages > Lecture: Définir une page de blog: "Blog"
    + Editer la page "Blog" et sauvegarder les champs personnalisés.

+ Créer un nouveau Menu & attribuer l'emplacement "Menu Header"
+ Créer un nouveau Menu & attribuer l'emplacement "Footer"
+ Créer un nouveau Menu & attribuer l'emplacement "Sub Footer"

+ Dans l'administration aller dans le menu Options, définir les champs et sauvegarder

+ Créer des nouveaux Projets, Catégories de Projets et Skills de Projets
+ Créer des nouveaux membres de Team

## Post Type Archive

Fonctionnalité personnalisé qui permet d'attribuer des pages en tant que Page d'archive de `post_type`. Les URLs de ces pages définissent l'argument `has_archive` de chaque post type.

Plusieurs avantages:
+ Possibilité de gérer l'URL de l'archive de manière dynamique
+ Possibilité d'ajotuer des champs personnalisés, contenu et de les afficher en front au dessus le boucle de posts

Afin de récupérer le contenu et les champs personnalisés de cette page d'archive, nous utiliserons une boucle personnalisé `have_archive_page()` & `the_archive_page()`. Les permaliens et règles d'écritures ne sont aucunement perturbés, WordPress continue d'utiliser l'archive de post type native, nous y ajoutons simplement une boucle supplémentaire.

## Templating & Section

Chaque gabarit est découpé en différentes `sections` afin de gagner en visibilité.

Article original: https://hwk.fr/blog/wordpress-afficher-des-templates-parts-avec-des-requetes-parametres-integres

Cette fonction `wpsst_section()` est une sorte de `get_template_part()` avancé avec gestion de `WP_Query` et de `query_vars`. Voici les arguments disponibles:

```
array(
    'template'      => 'sections/loop.php', // Fichier de Template par défaut: /wp-content/themes/<theme>/loop.php
    'not_found'     => false,               // Fichier de Template en cas de résultat non trouvé
    'pagination'    => false,               // Paramètre de pagination. Utilisé par le fichier de Template. true | false
    'query'         => array(),             // Arguments de WP_Query. Si vide, alors utiliser la WP_Query globale
    'query_addon'   => false,               // Utiliser l'argument 'query' pour l'ajouter à la WP_Query globale. true | false
    'result'        => array(),             // Injecter directement les résultats d'une Query antérieur. Bypass l'argument 'query'
    'title'         => false,               // Afficher un titre
    'comments'      => false,               // Afficher les commentaires
    'exclude'       => array(
        'add'   => true,                    // Ajouter les résultats dans la liste des posts à exclure pour les prochains appels. true | false
        'get'   => true                     // Utiliser la liste des posts à exclure pour cette Query. true | false
    ),
    'options'       => array(),             // Tableau d'options personnalisés.
    'wrapper'       => array(
        'title'     => false,               // Afficher le titre avant le wrapper au lieu d'être à l'intérieur
        'element'   => 'section',           // Element <div> qui servira de conteneur à notre Template
        'attr'      => array(
            'id'        => '',              // Ajouter un attribut id=""
            'class'     => '',              // Ajouter un attribut class=""
            'style'     => ''               // Ajouter un attribut style=""
        ),                                  // Note: Il est possible d'ajouter son propre attribut personnalisé ici.
    )
);
```

## Requêtes et traitement

La majorité des requêtes vers la base de données sont effectués avant l'affichage front pour optimiser le temps de es dernières. Ainsi, nous stockons les options (adresse, ville, pays, Google Maps API etc...) dans des `query_vars` globales.

pour les posts, nous stockons les données supplémentaires (`terms`, `post_meta` etc...) directement dans l'objet `WP_POST`.
