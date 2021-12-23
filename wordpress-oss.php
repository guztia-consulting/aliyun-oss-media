<?php
/*
Plugin Name: Aliyun OSS for WP Media
Plugin URI: https://guztia.com/accelerate-site-china
Description: Uses Aliyun OSS to offload media
Author: Guztia Consulting
Version: 1.0.3
Author URI: https://guztia.com/
Domain Path: /languages/

// Copyright (c) 2021 Guztia Consulting. All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************
//
// Forked WP Offload Media Lite (https://wordpress.org/plugins/amazon-s3-and-cloudfront/)
// which is a fork of Amazon S3 for WordPress with CloudFront (http://wordpress.org/extend/plugins/tantan-s3-cloudfront/)
// which is a fork of Amazon S3 for WordPress (http://wordpress.org/extend/plugins/tantan-s3/).
// Then partially rewritten to make it work for Aliyun OSS.
*/

$GLOBALS['aws_meta']['amazon-s3-and-cloudfront']['version'] = '1.0.3';

require_once dirname( __FILE__ ) . '/classes/as3cf-compatibility-check.php';

add_action( 'activated_plugin', array( 'AS3CF_Compatibility_Check', 'deactivate_other_instances' ) );

global $as3cf_compat_check;
$as3cf_compat_check = new AS3CF_Compatibility_Check(
	'Aliyun OSS for WP Media',
	'aliyun-oss-media',
	__FILE__
);

/**
 * @throws Exception
 */
function as3cf_init() {
	if ( class_exists( 'Amazon_S3_And_CloudFront' ) ) {
		return;
	}

	global $as3cf_compat_check;

	if ( ! $as3cf_compat_check->is_compatible() ) {
		return;
	}

	global $as3cf;
	$abspath = dirname( __FILE__ );

	// Autoloader.
	require_once $abspath . '/aliyun-oss-media-autoloader.php';

	require_once $abspath . '/include/functions.php';
	require_once $abspath . '/classes/as3cf-utils.php';
	require_once $abspath . '/classes/as3cf-error.php';
	require_once $abspath . '/classes/as3cf-filter.php';
	require_once $abspath . '/classes/filters/as3cf-local-to-s3.php';
	require_once $abspath . '/classes/filters/as3cf-s3-to-local.php';
	require_once $abspath . '/classes/as3cf-notices.php';
	require_once $abspath . '/classes/as3cf-plugin-base.php';
	require_once $abspath . '/classes/as3cf-plugin-compatibility.php';
	require_once $abspath . '/classes/amazon-s3-and-cloudfront.php';

	new Aliyun_OSS_Media_Autoloader( 'Aliyun_OSS_Media', $abspath );

	$as3cf = new Amazon_S3_And_CloudFront( __FILE__ );

	do_action( 'as3cf_init', $as3cf );
}

add_action( 'init', 'as3cf_init' );

// If AWS still active need to be around to satisfy addon version checks until upgraded.
add_action( 'aws_init', 'as3cf_init', 11 );
