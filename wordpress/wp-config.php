<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'utf8_general_ci');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'OZ>E[{DOv4BE`5u{d-3e##N0<m{LfLzvN+9rVYH-Ml3AyQ?7b-Z,):G#K-*v,O}?');
define('SECURE_AUTH_KEY',  '2@CsW8Q?RLCWI6D]Pw,*|IfC3fUt|2x= vj4^D.{-g{3]~}:HW+7aPJ5X<TbBXH|');
define('LOGGED_IN_KEY',    'C;$Ee>-j2`m&;8@hg:HSc- I2SmZmdv8UgPbqBHJ!36sr!0;-x7T/CK?Q-lPyV<y');
define('NONCE_KEY',        'BZ9iD{8S+&I-o1;Mh_|-Z.6m7ppKz2S`O=w6@/))dmNU 8-|hDJ5w$=p%ewf)&2#');
define('AUTH_SALT',        '0(oV3fqc5.Xn)Ag=m#j/{0LK 6,p,N9<s:p!@+ nq ]?NwEtrA-{KvxT,8G+F:d}');
define('SECURE_AUTH_SALT', 'aIgn`_u+e@x#][4q|:0m(Bex_IWIn+{1.,EL0dC1-@2U`,~_jPV95%qZ{ytsPxV=');
define('LOGGED_IN_SALT',   'O}~>H8QWjb=bmvto>N`|y!qC@IPM_fh$Raj25h#lUT,Tb6T{tXywwo-nK=:.Xobq');
define('NONCE_SALT',       '-xNX=$dAx<5)HW2.}yS:+2;QeDT<]A1me E/Wn88?&@SKTK4J~6LXJA6beKC^=RA');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 */
define('WP_DEBUG', false);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');