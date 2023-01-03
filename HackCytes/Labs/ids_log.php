<?php

define( 'HVA_WEB_PAGE_TO_ROOT', '' );
require_once HVA_WEB_PAGE_TO_ROOT . 'hva/includes/hackcytesPage.inc.php';

define( 'hackcytes_WEB_ROOT_TO_PHPIDS_LOG', 'external/phpids/' . hackcytesPhpIdsVersionGet() . '/lib/IDS/tmp/phpids_log.txt' );
define( 'hackcytes_WEB_PAGE_TO_PHPIDS_LOG', HVA_WEB_PAGE_TO_ROOT.hackcytes_WEB_ROOT_TO_PHPIDS_LOG );

hackcytesPageStartup( array( 'authenticated', 'phpids' ) );

$page = hackcytesPageNewGrab();
$page[ 'title' ]   = 'PHPIDS Log' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'log';
// $page[ 'clear_log' ]; <- Was showing error.

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>PHPIDS Log</h1>

	<p>" . hackcytesReadIdsLog() . "</p>
	<br /><br />

	<form action=\"#\" method=\"GET\">
		<input type=\"submit\" value=\"Clear Log\" name=\"clear_log\">
	</form>

	" . hackcytesClearIdsLog() . "
</div>";

hackcytesHtmlEcho( $page );

?>
