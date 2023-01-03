<?php

define( 'HVA_WEB_PAGE_TO_ROOT', '../../' );
require_once HVA_WEB_PAGE_TO_ROOT . 'hva/includes/hackcytesPage.inc.php';

hackcytesPageStartup( array( 'authenticated', 'phpids' ) );

$page = hackcytesPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: Reflected HTML' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'html_r';
$page[ 'help_button' ]   = 'html_r';
$page[ 'source_button' ] = 'html_r';

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

require_once HVA_WEB_PAGE_TO_ROOT . "vulnerabilities/html_r/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerability: HTML Injection</h1>

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
		<li>" . hackcytesExternalLinkUrlGet( 'https://owasp.org/www-project-web-security-testing-guide/latest/4-Web_Application_Security_Testing/11-Client-side_Testing/03-Testing_for_HTML_Injection' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://www.imperva.com/learn/application-security/html-injection/' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://blog.qualys.com/product-tech/2013/05/30/finding-html-injection-vulns-part-i' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'http://www.cgisecurity.com/xss-faq.html' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://0xn3va.gitbook.io/cheat-sheets/web-application/html-injection' ) . "</li>
	</ul>
</div>\n";

hackcytesHtmlEcho( $page );

?>
