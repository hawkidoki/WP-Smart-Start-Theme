# ![](https://i.imgur.com/d4EobC1.png)

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
    + Editer la page "Contact", définir en Page Template: "Contact" & sauvegarder
    + Mettre à jour les champs personnalisés, choisir un formulaire Contact Form 7 et sauvegarder de nouveau
    
+ Créer une nouvelle page "Projects"
    + Editer la page "Projects". Dans la metabox à droite "Post Type Archive", définir le post type "Project" & sauvegarder
    + Editer les champs personnalisés et sauvegarder de nouveau
+ Créer une nouvelle page "Team"
    + Editer la page "Team". Dans la metabox à droite "Post Type Archive", définir le post type "Team" & sauvegarder
    + Editer les champs personnalisés et sauvegarder de nouveau

+ Dans Réglages > Lecture: Définir une page d'accueil statique: "Homepage"
    + Editer la page "Homepage" et sauvegarder les champs personnalisés.
+ Dans Réglages > Lecture: Définir une page de blog: "Blog"
    + Editer la page "Blog" et modifier les champs personnalisés.
    + Définir un contenu de page
    + Sauvegarder la page

+ Créer un nouveau Menu & attribuer l'emplacement "Menu Header"
+ Créer un nouveau Menu & attribuer l'emplacement "Footer"
+ Créer un nouveau Menu & attribuer l'emplacement "Sub Footer"

+ Aller dans le menu Options, définir les champs personnalisés et sauvegarder

+ Aller dans Apprence > Widgets & Ajouter des Widgets

+ Créer de nouveaux Projets, Catégories et Skills
+ Créer de nouveaux membres de Team

## Post Type Archive Page

Fonctionnalité personnalisée qui permet d'attribuer des pages en tant que Page d'archive de `post_type`. Les slugs de ces pages définissent l'argument `has_archive` de chaque post type.

Plusieurs avantages:
+ Possibilité de gérer l'URL de l'archive de manière dynamique
+ Possibilité d'ajouter des champs personnalisés et du contenu afin de les afficher en front au dessus le boucle de posts principale

Les permaliens et règles d'écritures ne sont pas perturbés, WordPress continue d'utiliser l'archive de post type native. Nous y ajoutons simplement les données récupérées de la "page d'archive". Pour cela nous utiliserons notre propre boucle `have_archive_page()` & `the_archive_page()`. 

## Templating & Section

Les gabarits de posts et taxonomies (archive/single/term etc...) ont été placés dans le dossier `/templates` afin de gagner en visibilité. Ceux-ci sont découpés en différentes sections, stockés dans le dossier `/sections` afin d'être facilement ré-utilisables. A noter qu'il est toujours possible de ré-écrire par dessus ces templates en créant un fichier `archive-project.php` à la racine du thème.

Pour inclure les sections, nous allons passer par une fonction personnalisée: `wpsst_section()`. C'est une sorte de fonction `get_template_part()` avancée avec gestion de `WP_Query` et de `query_vars`.

Article original: https://hwk.fr/blog/wordpress-afficher-des-templates-parts-avec-des-requetes-parametres-integres

Voici les arguments disponibles:

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

## Flexibilité du Templating

En plus de gérer les pages d'archive dans le back office, nous pouvons définir des arguments personnalisés lors de la déclaration des `post_types` et `taxonomies`.

Par exemple pour le `post_type` `project`, nous ajoutons les arguments `wpsst_template_archive`, `wpsst_template_single` & `wpsst_posts_per_page` directement dans le hook `init` afin de définir des templates spécifiques et une valeur `posts_per_page` en `pre_get_posts` de l'archive. (Voir fichier `/includes/post_type/project.php`).

## Requêtes et traitements

La majorité des requêtes vers la base de données sont effectués avant l'affichage HTML pour optimiser le temps de traitement. Ainsi, nous stockons les options (Adresse, Ville, Pays, Google Maps API etc...) dans des `query_vars` globales.

Pour les posts, nous stockons les données supplémentaires (`terms`, `post_meta` etc...) directement dans l'objet `WP_POST`.

## Contact Form 7

Si Contact Form 7 est activé après l'activation du thème, alors les champs seront automatiquement mis à jour. Néanmoins, si l'installation est antérieure à l'activation du thème, alors il faudra intégrer le formulaire manuellement:

```
<p class="input-block">
    <label for="contact-name"><strong>Name</strong> (required)</label>
    [text* contact-name id:contact-name]
</p>
<p class="input-block">
    <label for="contact-email"><strong>Email</strong> (required)</label>
    [email* contact-email id:contact-email]
</p>
<p class="input-block">
    <label for="contact-subject"><strong>Subject</strong></label>
    [text contact-subject id:contact-subject]
</p>
<p class="textarea-block">
    <label for="contact-message"><strong>Your Message</strong> (required)</label>
    [textarea* contact-message id:contact-message 88x6]
</p>
<div class="hidden">
    <label for="contact-spam-check">Do not fill out this field:</label>
    [text contact-spam-check id:contact-spam-check]
</div>
<div class="clear"></div>
[submit "Submit"]
```

## Bonus

+ Géolocalisation Google Maps de l'adresse entré dans les options.
+ Les commentaires sont fonctionnels
+ Les medias sociaux en pied de page sont paramètrables via les options
+ Et d'autres petites surprises :)

## Note

Ne connaissant pas votre processus de vérfication de thème, j'ai préféré ne pas faire de script d'installation (Création des pages, ajout des contenus etc...). Ainsi, il est nécessaire de créer et mettre à jour toutes les Pages & Options afin de correctement sauvegarder les données des champs personnalisés.
