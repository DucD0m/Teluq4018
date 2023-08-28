<?php
// Configuration pour la connexion lecture de la BD
define("SERVERNAME", "localhost");
define("LECTEUR", "lecteur");
define("MDPLECTEUR", "Jaimelire8!!");
define("BASEDONNEES", "gym_argente");

// Configuration de la clé pour la vérification d'integrité du processus d'authentification.
define("PEPPER", "9bcf59c3d7751c9d3cdef0c98d32d233146c40819af6df132e28ad7e40c579c1");





// Configuration PHP selon les recommendations OWASP
// Seulement les champs modifiables avec ini_set sont représentés.
// Voir php.ini pour les autres.

// PHP error handling
// expose_php              = Off
ini_set('error_reporting','E_ALL');
ini_set('display_errors','On'); // DEV
// ini_set('display_errors','Off'); // PROD
ini_set('display_startup_errors','On'); // DEV
//ini_set('display_startup_errors','Off'); // PROD
ini_set('log_errors','On');
ini_set('error_log','/var/www/html/PHP-logs/php_error.log');
ini_set('ignore_repeated_errors','Off');


// PHP general settings
// doc_root                       = /path/DocumentRoot/PHP-scripts/
ini_set('open_basedir','/var/www/html/');

// Enlever commentaires et indiquer le path pour activer cette option.
// ini_set('include_path','/path/PHP-pear/');

// include_path            = /path/PHP-pear/
// extension_dir           = /path/PHP-extensions/
// mime_magic.magicfile    = /path/PHP-magic.mime
// allow_url_fopen         = Off
// allow_url_include       = Off
// variables_order         = "GPCS"
// allow_webdav_methods    = Off
ini_set('session.gc_maxlifetime','600');


// PHP file upload handling
// Cette application ne requiert pas de télécharger des fichiers.
ini_set('file_uploads','Off');
// file_uploads            = On
// upload_tmp_dir          = /path/PHP-uploads/
// upload_max_filesize     = 2M
// max_file_uploads        = 2


// PHP executable handling
// enable_dl               = Off
// disable_functions       = system, exec, shell_exec, passthru, phpinfo, show_source, highlight_file, popen, proc_open, fopen_with_path, dbmopen, dbase_open, putenv, move_uploaded_file, chdir, mkdir, rmdir, chmod, rename, filepro, filepro_rowcount, filepro_retrieve, posix_mkfifo
# see also: http://ir.php.net/features.safe-mode
// disable_classes         =


// PHP session handling
//ini_set('session.save_path','/var/www/html/PHP-session/');
ini_set('session.name', 'ab19b0956c3dc02dbca4c1d13ac00cea6b5c7a8f4c9db8ffd99ea5d577063e4a');
//session.auto_start               = Off
//ini_set('session.use_trans_sid','0');

// Configurer lorsque l'application sera en production.
// ini_set('session.cookie_domain','full.qualified.domain.name');

#session.cookie_path             = /application/path/
//ini_set('session.use_strict_mode','1');
//ini_set('session.use_cookies','1');
//ini_set('session.use_only_cookies','1');
//ini_set('session.cookie_lifetime','14400');
//ini_set('session.cookie_secure','1');
//ini_set('session.cookie_httponly','1');
//ini_set('session.cookie_samesite','Strict');
//ini_set('session.cache_expire','30');
//ini_set('session.sid_length','256');
//ini_set('session.sid_bits_per_character','6'); //PHP 7.2+
// session.hash_function            = 1 # PHP 7.0-7.1
// session.hash_bits_per_character  = 6 # PHP 7.0-7.1


// Some more security paranoid checks

// À tester...
//ini_set('session.referer_check','/var/www/html/');

//ini_set('memory_limit','50M');
// post_max_size           = 20M
//ini_set('max_execution_time','60');
//ini_set('report_memleaks','On');
// track_errors            = Off // Removed as of PHP 8.
//ini_set('html_errors','Off');

?>
