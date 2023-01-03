<?php

define( 'HVA_WEB_PAGE_TO_ROOT', '../../' );
require_once HVA_WEB_PAGE_TO_ROOT . 'hva/includes/hackcytesPage.inc.php';

hackcytesPageStartup( array( 'authenticated', 'phpids' ) );

$page = hackcytesPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: Stored Cross Site Scripting (XSS)' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'xss_s';
$page[ 'help_button' ]   = 'xss_s';
$page[ 'source_button' ] = 'xss_s';

hackcytesDatabaseConnect();

if (array_key_exists ("btnClear", $_POST)) {
	$query  = "TRUNCATE guestbook;";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );
}

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

require_once HVA_WEB_PAGE_TO_ROOT . "vulnerabilities/xss_s/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerability: Stored Cross Site Scripting (XSS)</h1>

	<div class=\"vulnerable_code_area\">
		<form method=\"post\" name=\"guestform\" \">
			<table width=\"550\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\">
				<tr>
					<td width=\"100\">Name *</td>
					<td><input name=\"txtName\" type=\"text\" size=\"30\" maxlength=\"10\"></td>
				</tr>
				<tr>
					<td width=\"100\">Message *</td>
					<td><textarea name=\"mtxMessage\" cols=\"50\" rows=\"3\" maxlength=\"50\"></textarea></td>
				</tr>
				<tr>
					<td width=\"100\">&nbsp;</td>
					<td>
						<input name=\"btnSign\" type=\"submit\" value=\"Sign Guestbook\" onclick=\"return validateGuestbookForm(this.form);\" />
						<input name=\"btnClear\" type=\"submit\" value=\"Clear Guestbook\" onClick=\"return confirmClearGuestbook();\" />
					</td>
				</tr>
			</table>\n";

if( $vulnerabilityFile == 'impossible.php' )
	$page[ 'body' ] .= "			" . tokenField();

$page[ 'body' ] .= "
		</form>
		{$html}
	</div>
	<br />

	" . hackcytesGuestbook() . "
	<br />

	<h2>More Information</h2>
	<ul>
		<li>" . hackcytesExternalLinkUrlGet( 'https://portswigger.net/web-security/cross-site-scripting/stored' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://blog.sqreen.com/stored-xss-explained/' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://www.geeksforgeeks.org/understanding-stored-xss-in-depth/' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://www.thesslstore.com/blog/the-ultimate-guide-to-stored-xss-attacks/' ) . "</li>
		<li>" . hackcytesExternalLinkUrlGet( 'https://github.com/payloadbox/xss-payload-list' ) . "</li>
	</ul>
</div>\n";

hackcytesHtmlEcho( $page );

?>
