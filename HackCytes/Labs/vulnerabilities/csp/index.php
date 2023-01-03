<?php

define( 'HVA_WEB_PAGE_TO_ROOT', '../../' );
require_once HVA_WEB_PAGE_TO_ROOT . 'hva/includes/hackcytesPage.inc.php';

hackcytesPageStartup( array( 'authenticated', 'phpids' ) );

$page = hackcytesPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: Content Security Policy (CSP) Bypass' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'csp';
$page[ 'help_button' ]   = 'csp';
$page[ 'source_button' ] = 'csp';

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

$page[ 'body' ] = <<<EOF
<div class="body_padded">
	<h1>Vulnerability: Content Security Policy (CSP) Bypass</h1>

	<div class="vulnerable_code_area">
EOF;
 
require_once HVA_WEB_PAGE_TO_ROOT . "vulnerabilities/csp/source/{$vulnerabilityFile}";

$page[ 'body' ] .= <<<EOF
	</div>
EOF;

$page[ 'body' ] .= "
	<h2>More Information</h2>
	<ul>
		<li>" . hackcytesExternalLinkUrlGet( 'https://content-security-policy.com/', "Content Security Policy Reference" ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP', "Mozilla Developer Network - CSP: script-src") . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://blog.mozilla.org/security/2014/10/04/csp-for-the-web-we-have/', "Mozilla Security Blog - CSP for the web we have" ) . "</li>
	</ul>
	
</div>\n";

hackcytesHtmlEcho( $page );

?>
