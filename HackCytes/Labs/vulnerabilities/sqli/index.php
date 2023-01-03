<?php

define( 'HVA_WEB_PAGE_TO_ROOT', '../../' );
require_once HVA_WEB_PAGE_TO_ROOT . 'hva/includes/hackcytesPage.inc.php';

hackcytesPageStartup( array( 'authenticated', 'phpids' ) );

$page = hackcytesPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: SQL Injection' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'sqli';
$page[ 'help_button' ]   = 'sqli';
$page[ 'source_button' ] = 'sqli';

hackcytesDatabaseConnect();

$method            = 'GET';
$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;
	case 'medium':
		$vulnerabilityFile = 'medium.php';
		$method = 'POST';
		break;
	case 'high':
		$vulnerabilityFile = 'high.php';
		break;
	default:
		$vulnerabilityFile = 'low.php';
		break;
}

require_once HVA_WEB_PAGE_TO_ROOT . "vulnerabilities/sqli/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerability: SQL Injection</h1>
	<p><b>SQL Injection</b> is a code injection technique used to attack data-driven applications, in which malicious SQL statements are inserted into an entry field for execution (e.g. to dump the database contents to the attacker). SQL injection must exploit a security vulnerability in an application's software, for example, when user input is either incorrectly filtered for string literal escape characters embedded in SQL statements or user input is not strongly typed and unexpectedly executed. SQL injection is mostly known as an attack vector for websites but can be used to attack any type of SQL database.</p>
	<div class=\"vulnerable_code_area\">";
if( $vulnerabilityFile == 'high.php' ) {
	$page[ 'body' ] .= "Click <a href=\"#\" onclick=\"javascript:popUp('session-input.php');return false;\">here to change your ID</a>.";
}
else {
	$page[ 'body' ] .= "
		<form action=\"#\" method=\"{$method}\">
			<p>
				User ID:";
	if( $vulnerabilityFile == 'medium.php' ) {
		$page[ 'body' ] .= "\n				<select name=\"id\">";

		for( $i = 1; $i < $number_of_rows + 1 ; $i++ ) { $page[ 'body' ] .= "<option value=\"{$i}\">{$i}</option>"; }
		$page[ 'body' ] .= "</select>";
	}
	else
		$page[ 'body' ] .= "\n				<input type=\"text\" size=\"15\" name=\"id\">";

	$page[ 'body' ] .= "\n				<input type=\"submit\" name=\"Submit\" value=\"Submit\">
			</p>\n";

	if( $vulnerabilityFile == 'impossible.php' )
		$page[ 'body' ] .= "			" . tokenField();

	$page[ 'body' ] .= "
		</form>";
}
$page[ 'body' ] .= "
		{$html}
	</div>

	<h2>More Information</h2>
	<ul>
		<li>" . hackcytesExternalLinkUrlGet( 'https://en.wikipedia.org/wiki/SQL_injection' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://www.netsparker.com/blog/web-security/sql-injection-cheat-sheet/' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://owasp.org/www-community/attacks/SQL_Injection' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://bobby-tables.com/' ) . "</li>
	</ul>
</div>\n";

hackcytesHtmlEcho( $page );

?>
