<?php

define( 'HVA_WEB_PAGE_TO_ROOT', '../../' );
require_once HVA_WEB_PAGE_TO_ROOT . 'hva/includes/hackcytesPage.inc.php';

hackcytesPageStartup( array( 'authenticated', 'phpids' ) );

$page = hackcytesPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: File Inclusion' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'fi';
$page[ 'help_button' ]   = 'fi';
$page[ 'source_button' ] = 'fi';

hackcytesDatabaseConnect();

$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;
	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;
	case 'high':
		$vulnerabilityFile = 'high.php';
		break;
	default:
		$vulnerabilityFile = 'impossible.php';
		break;
}

require_once HVA_WEB_PAGE_TO_ROOT . "vulnerabilities/fi/source/{$vulnerabilityFile}";

// if( count( $_GET ) )
if( isset( $file ) )
	include( $file );
else {
	header( 'Location:?page=include.php' );
	exit;
}

hackcytesHtmlEcho( $page );

?>
