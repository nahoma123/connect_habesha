<?php

@ini_set('upload_tmp_dir',dirname(__FILE__).'/oc-content/tmp'); if ( @ini_get('session.save_handler') === 'files' ) @ini_set('session.save_path',dirname(__FILE__).'/oc-content/tmp');

/**
 * The base MySQL settings of OSClass
 */
define('MULTISITE', 0);

/** MySQL database name for OSClass */
define('DB_NAME', 'u609444707_NvDH4');

/** MySQL database username */
define('DB_USER', 'u609444707_6txkv');

/** MySQL database password */
define('DB_PASSWORD', 'sY39jGu9qQ');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Table prefix */
define('DB_TABLE_PREFIX', 'osxw_');

define('REL_WEB_URL', '/');

define('WEB_PATH', 'https://connecthabesha.net/');

?>