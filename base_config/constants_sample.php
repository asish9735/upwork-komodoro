<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('PROJECT',						'newflance/');
define('PROJECT_ADMIN',					'hackground/');
define('THEME',							'default/');
/*----------------------------------------------------------------------------*/
define('URL',							'http://'.$_SERVER['HTTP_HOST']."/".PROJECT.PROJECT_ADMIN);
define('SITE_URL',						'http://'.$_SERVER['HTTP_HOST']."/".PROJECT);
define('APS_PATH',						$_SERVER['DOCUMENT_ROOT']."/".PROJECT);
define('VPATH',							'http://'.$_SERVER['HTTP_HOST']."/".PROJECT.PROJECT_ADMIN);
define('APATH',							$_SERVER['DOCUMENT_ROOT']."/".PROJECT.PROJECT_ADMIN);


define('BASE_URL' , 					'http://'.$_SERVER['HTTP_HOST']."/".PROJECT);
define('PROJECT_BASE_URL',				BASE_URL);

/*FRONT END CONSTANTS */

define('WEBSITE_UPLOAD_PATH',			APS_PATH."website_uploads/");
define('WEBSITE_UPLOAD_HTTP_PATH',		SITE_URL."website_uploads/");

define('IMG_ASSETS',					SITE_URL."assets/".THEME."images/");
define('IMAGE_DIR',						APS_PATH."assets/".THEME."images/");

define('TMP_UPLOAD_HTTP_PATH', 			SITE_URL.'tmp_uploads/');
define('TMP_UPLOAD_PATH', 				$_SERVER['DOCUMENT_ROOT']."/".PROJECT.'tmp_uploads/');
define('UPLOAD_PATH', 					$_SERVER['DOCUMENT_ROOT']."/".PROJECT.'user_uploads/');
define('UPLOAD_HTTP_PATH', 				SITE_URL.'user_uploads/');
define('LC_PATH',						UPLOAD_PATH);


define('ASSETS',						BASE_URL."assets/");
define('CSS',							ASSETS.THEME."css/");
define('JS',							ASSETS.THEME."js/");
define('IMAGE',							ASSETS.THEME."images/");
define('PLUGINS',						ASSETS.THEME."plugins/");

/* END OF FRONT END  CONSTANTS */

/*BACK END CONSTANTS */

define('ADMIN_URL',                   	'http://'.$_SERVER['HTTP_HOST'].'/'.PROJECT.'hackground/');
define('ADMIN_BASE_URL',				ADMIN_URL);
define('ADMIN_ASSETS',                  ADMIN_URL.'assets/');
define('ADMIN_THEME',					'admin/'); // active theme
define('ADMIN_APP_ASSETS',              ADMIN_ASSETS.'app_assets/');
define('ADMIN_JS',                   	ADMIN_APP_ASSETS.ADMIN_THEME.'js/');
define('ADMIN_CSS',                   	ADMIN_APP_ASSETS.ADMIN_THEME.'css/');
define('ADMIN_IMAGES',                 	ADMIN_APP_ASSETS.ADMIN_THEME.'images/');
define('ADMIN_COMPONENT',              	ADMIN_APP_ASSETS.ADMIN_THEME.'bower_components/');
define('ADMIN_EXTRA',                  	ADMIN_APP_ASSETS.'extra/');

/* END OF BACK END  CONSTANTS */

/* CUSTOM CONSTANT */
require_once('custom_constants.php');