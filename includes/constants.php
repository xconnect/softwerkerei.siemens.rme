<?php

// root folder as absolute path
define ('ROOTPATH', __DIR__.'/..');

// other folders as absolute path
define('CONFIG_DIR', ROOTPATH.'/config');
define('INCLUDE_DIR', ROOTPATH.'/includes');
define('AUTH_DIR', ROOTPATH.'/includes/auth');
define('DB_DIR', ROOTPATH.'/includes/db');
define('MODEL_DIR', ROOTPATH.'/includes/db/models');

// root folder as relative path for usage in websites
define ('WEB_ROOTPATH', '/');

// other folders as relative path for usage in websites
define('WEB_CONFIG_DIR', WEB_ROOTPATH.'config');
define('WEB_INCLUDE_DIR', WEB_ROOTPATH.'includes');
define('WEB_AUTH_DIR', WEB_ROOTPATH.'includes/auth');
define('WEB_DB_DIR', WEB_ROOTPATH.'includes/db');
define('WEB_MODEL_DIR', WEB_ROOTPATH.'includes/db/models');
