# WP Smart Start Theme

Bienvenue sur ma version d'intégration du Smart Theme, excercice WP Media. Dans un souci d'efficacité je vais tâcher de me concentrer sur la description des différents fichiers qui composent le thème.

## Description des fichiers

### Includes: Core

##### /includes/core/admin.php
_Administration & Gestion de l'ordre du menu_
Petit hook simple pour simplement afficher le `post_type` `page` en premier dans le menu, et ajout d'un séparateur avec les autres post types.

##### /includes/core/comments.php
_Callback des commentaires_
Définition d'une fonction afin d'afficher les templates de commentaires confofément à la maquette HTML.

##### /includes/core/enqueue.php
_Scripts JS & Styles CSS_
Ici, nous allons ajouter tous nos scripts et feuilles de styles css. A noter que nous allons enqueue des scripts en footer pour encore une fois coller au maximum à la maquette fournie. Afin de correctement enqueue jQuery en footer, nous utiliserons `wp_scripts()->add_date('jquery', 'group', 1)`. Les variables Javascript seront ajouté via le fameux `wp_localize_script()`.

Cerise sur le gateau, nous ajoutons une variable pour la géolocalisation de l'adresse définie dans le back office.

##### /includes/core/excerpt.php
_Fonctions d'extraits personnalisés_
Pour plus facilement gérer les extraits WordPress, nous allons définir nos propres fonctions avec un argument `$length`. Ainsi nous pourrons dynamiquement afficher des extraits de taille différente, suivant la partie du thème.

##### /includes/core/helpers.php
_Fonctions d'aides génériques_
Le classique `helpers.php` avec deux fonctions simples:
+ `wpsst_has_plugin()` pour vérifier si un plugin est un actif lorsqu'on en a beoin
+ `wp_parse_args_recursive()` pour attribuer des valeurs par défaut à certains de tableaux associatifs

##### /includes/core/homepage.php
_Gestion de la page d'accueil_
Nous ajoutons ici un hook sur `template_include` afin de forcer l'utilisation de notre fichier `/templates/homepage.php`. Nous rajouter aussi l'éditeur WordPress qui est supprimé par défaut lorsqu'une page est définie en tant que page d'accueil.

##### /includes/core/login.php
_Formulaire de Login / Register_
Ajout du Logo et de l'URL du site sur les pages de connexion & enregistrement en utilisant notre propre version du `custom_logo()` (voir ci-après).

##### /includes/core/logo.php
_Fonctions de gestion du Logo_
Nous utilisons la fonction native de logo WordPress. néanmoins afin de définir un placeholder, nous allons passer nos propres fonctions `wpsst_get_the_logo()`, `wpsst_get_logo_url()`, `wpsst_get_logo_alt()`. Ainsi nous pouvons garantir que dans tous les cas le logo par défaut "SmartStart" s'affichera.

##### /includes/core/menu.php
_Ajout des menus_
Ici nous ajoutons les 3 menus du thème: `menu-header`, `menu-footer` & `menu-sub-footer`. Pour coller à 100% à la maquette, nous passons le filtre `nav_menu_css_class` afin d'ajouter une class `current`.

##### /includes/core/query.php
_Système de gestion des `pre_get_posts` pour les posts types & taxonomies_
Nous rentrons ici dans le vif du sujet avec une fonction maison afin de facilement gérer le nombre de posts_per_page pour les archives de `post_types` et les termes de `taxonomies`.

##### /includes/core/section.php
_Fonction de templating et d'include_
Notre thème va se découper en plusieurs gabarits (Page d'accueil, archive de post types, single de post type etc...). Mais surtout, nous allons découper leur contenu en `section`. Cette fonction `wpsst_section()` est une sorte de `get_template_part()` avancé avec gestion de `WP_Query` et de `query_vars`. Voici les arguments disponibles:

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
