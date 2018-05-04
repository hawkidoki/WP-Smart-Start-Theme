<?php
/**
 *********************************************************************
 *********************************************************************
 *  ____  __  __    _    ____ _____   ____ _____  _    ____ _____ 
 * / ___||  \/  |  / \  |  _ \_   _| / ___|_   _|/ \  |  _ \_   _|
 * \___ \| |\/| | / _ \ | |_) || |   \___ \ | | / _ \ | |_) || |  
 *  ___) | |  | |/ ___ \|  _ < | |    ___) || |/ ___ \|  _ < | |  
 * |____/|_|  |_/_/   \_\_| \_\|_|   |____/ |_/_/   \_\_| \_\|_|  
 *  
 *********************************************************************
 *********************************************************************
 *
 * WP Smart Start Theme
 * Author: WP Media
 * Dev: hwk.fr
 * Prefix: wpsst
 * Text-domain: wpsst
 */
 
/** 
 * Constants
 */
define('WPSST_THEME_PATH',  get_template_directory());                          // Constante pour le PATH du thème
define('WPSST_THEME_URL',   get_template_directory_uri());                      // Constante pour l'URL du thème
define('WPSST_STYLE_PATH',  get_stylesheet_directory());                        // Constante pour le PATH du thème (enfant)
define('WPSST_STYLE_URL',   get_stylesheet_directory_uri());                    // Constante pour l'URL du thème (enfant)

/**
 * Core
 */
require_once(WPSST_THEME_PATH . '/includes/core/admin.php');                    // Administration & Gestion ordre du menu
require_once(WPSST_THEME_PATH . '/includes/core/comments.php');                 // Callback des commentaires
require_once(WPSST_THEME_PATH . '/includes/core/enqueue.php');                  // Scripts JS & Styles CSS
require_once(WPSST_THEME_PATH . '/includes/core/excerpt.php');                  // Extraits & fonctions personnalisées
require_once(WPSST_THEME_PATH . '/includes/core/helpers.php');                  // Fonctions d'aides génériques
require_once(WPSST_THEME_PATH . '/includes/core/homepage.php');                 // Gestion de la page d'accueil
require_once(WPSST_THEME_PATH . '/includes/core/login.php');                    // Formulaire de Login / Register
require_once(WPSST_THEME_PATH . '/includes/core/logo.php');                     // Fonctions de gestion du Logo
require_once(WPSST_THEME_PATH . '/includes/core/menu.php');                     // Ajout des menus
require_once(WPSST_THEME_PATH . '/includes/core/query.php');                    // Système de gestion des pre_get_posts pour les posts types & taxonomies
require_once(WPSST_THEME_PATH . '/includes/core/query-vars.php');               // Ajout des Query Vars globales
require_once(WPSST_THEME_PATH . '/includes/core/section.php');                  // Fonction de templating et d'include
require_once(WPSST_THEME_PATH . '/includes/core/setup.php');                    // Paramètrage du thème, images sizes et supports
require_once(WPSST_THEME_PATH . '/includes/core/sidebar.php');                  // Génération des sidebars
require_once(WPSST_THEME_PATH . '/includes/core/template.php');                 // Système de template pour les post types & taxonomies
require_once(WPSST_THEME_PATH . '/includes/core/thumbnail.php');                // Gestion des images de posts
require_once(WPSST_THEME_PATH . '/includes/core/widgets.php');                  // Gestion des widgets

/**
 * Plugins
 */
require_once(WPSST_THEME_PATH . '/includes/plugins/_fallbacks.php');            // Fallbacks des plugins
require_once(WPSST_THEME_PATH . '/includes/plugins/acf-ptap.php');              // Plugin personnalisé pour définir des pages d'archive de post type
require_once(WPSST_THEME_PATH . '/includes/plugins/acf-options.php');           // Page des options ACF (Adresse, Google Maps API ...)
require_once(WPSST_THEME_PATH . '/includes/plugins/acf-register.php');          // Enregistrement des champs ACF
require_once(WPSST_THEME_PATH . '/includes/plugins/contactform-7.php');         // Gestion de Contact Form 7
require_once(WPSST_THEME_PATH . '/includes/plugins/pagenavi.php');              // Gestion de WP-PageNavi

/**
 * Post Types
 */
require_once(WPSST_THEME_PATH . '/includes/post-types/page.php');               // Configuration du post_type: page
require_once(WPSST_THEME_PATH . '/includes/post-types/post.php');               // Configuration du post_type: post
require_once(WPSST_THEME_PATH . '/includes/post-types/project.php');            // Configuration du post_type: project
require_once(WPSST_THEME_PATH . '/includes/post-types/team.php');               // Configuration du post_type: team

/**
 * Taxonomies
 */
require_once(WPSST_THEME_PATH . '/includes/taxonomies/category.php');           // Configuration de la taxonomy: category
require_once(WPSST_THEME_PATH . '/includes/taxonomies/post_tag.php');           // Configuration de la taxonomy: post_tag
require_once(WPSST_THEME_PATH . '/includes/taxonomies/project_category.php');   // Configuration de la taxonomy: project_category
require_once(WPSST_THEME_PATH . '/includes/taxonomies/skill.php');              // Configuration de la taxonomy: skill