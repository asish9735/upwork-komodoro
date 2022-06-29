<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('PDF_ICON',						IMAGE.'pdf_icon.png');
define('DOC_ICON',						IMAGE.'doc_icon.png');
define('TXT_ICON',						IMAGE.'txt_icon.png');
define('COMMON_ICON',					IMAGE.'common_file.png');
define('NO_IMAGE',						IMAGE.'default/noimage.jpg');
define('NO_IMAGE_USER',					IMAGE.'user-avatar-placeholder.png');

/* SITE CONSTANTS */
define('LOGO_FILE_NAME',				'logo.png');
define('FAVICON_FILE_NAME',				'favicon.png');
define('LOGO',							IMG_ASSETS.LOGO_FILE_NAME);
define('FAVICON',						IMG_ASSETS.FAVICON_FILE_NAME);
define('DATE_FORMAT',					'd M, Y');
define('CURRENCY',						'$');
define('SET_EMAIL_CRON',						'0');
/* END OF SITE CONSTANTS */

define('JS_VOID'    ,                   'javascript:void(0)');
define('VZ'    ,                   'javascript:void(0)');

/* Status Constant */
define('STATUS_ACTIVE', 				1);
define('STATUS_SHORTLIST', 				4);
define('STATUS_INACTIVE', 				0);
define('STATUS_PENDING', 				2);
define('STATUS_DELETED', 				-1);
define('STATUS_EXPIRED', 				-2);

/* Price type Constant */
define('PRICE_FIXED', 					1);
define('PRICE_NEGOTIABLE', 				2);
define('PRICE_EXCHANGE', 				3);
define('PRICE_FEE', 					4);

/* Project type Constant */
define('PROJECT_ERROR',				"0");
define('PROJECT_DRAFT',				"1");
define('PROJECT_OPEN',			  	"2");
define('PROJECT_HIRED',				"3");
define('PROJECT_CLOSED',			"4");
define('PROJECT_DELETED',			"6");


/* Proposal type Constant */
define('PROPOSAL_PENDING',						"1"); #proposal 
define('PROPOSAL_ACTIVE',						"2"); #proposal 
define('PROPOSAL_PAUSED',						"3"); #proposal 
define('PROPOSAL_MODIFICATION',					"4"); #proposal 
define('PROPOSAL_DECLINED',						"5"); #proposal 
define('PROPOSAL_DELETED',						"6"); #proposal 

/* Order type Constant */
define('ORDER_PENDING',							"1"); #order 
define('ORDER_PROCESSING',						"2"); #order 
define('ORDER_REVISION',						"3"); #order 
define('ORDER_CANCELLATION',					"4"); #order 
define('ORDER_CANCELLED',						"5"); #order 
define('ORDER_DELIVERED',						"6"); #order 
define('ORDER_COMPLETED',						"7"); #order 



/* API CONSTANTS */
define('API_SUCCESS',				'1');
define('API_FAIL',					'0');

/* APP CONSTANTS */
define('DEFAULT_EXPIRATION_DAYS',	'1');

//define('ATTACHMENT_ALL',	array('jpg'));


/* 
API_SUCCESS = 1 (Operation complete)
API_FAIL = 0 (Operation Fail) 

*/
/* END OF SITE CONSTANTS */