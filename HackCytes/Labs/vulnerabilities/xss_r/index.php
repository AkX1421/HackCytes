<?php

define( 'HVA_WEB_PAGE_TO_ROOT', '../../' );
require_once HVA_WEB_PAGE_TO_ROOT . 'hva/includes/hackcytesPage.inc.php';

hackcytesPageStartup( array( 'authenticated', 'phpids' ) );

$page = hackcytesPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: Reflected Cross Site Scripting (XSS)' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'xss_r';
$page[ 'help_button' ]   = 'xss_r';
$page[ 'source_button' ] = 'xss_r';

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

require_once HVA_WEB_PAGE_TO_ROOT . "vulnerabilities/xss_r/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerability: Reflected Cross Site Scripting (XSS)</h1>

	<div class=\"vulnerable_code_area\">
		<form name=\"XSS\" action=\"#\" method=\"GET\">
			<p>
				What's your name?
				<input type=\"text\" name=\"name\">
				<input type=\"submit\" value=\"Submit\">
			</p>\n";

if( $vulnerabilityFile == 'impossible.php' )
	$page[ 'body' ] .= "			" . tokenField();

$page[ 'body' ] .= "
		</form>
		{$html}
	</div>

	<h2>More Information</h2>
	<ul>
		<li>" . hackcytesExternalLinkUrlGet( 'https://owasp.org/www-community/attacks/xss/' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://portswigger.net/web-security/cross-site-scripting/reflected' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://academy.hackthebox.com/course/preview/cross-site-scripting-xss' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://infosecwriteups.com/tagged/xss-attack' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://www.bugcrowd.com/blog/the-ultimate-guide-to-finding-and-escalating-xss-bugs/' ) . "</li>
	</ul>
</div>\n";

hackcytesHtmlEcho( $page );

?>
