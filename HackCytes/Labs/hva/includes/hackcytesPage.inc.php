<?php

if( !defined( 'HVA_WEB_PAGE_TO_ROOT' ) ) {
	die( 'hackcytes System error- WEB_PAGE_TO_ROOT undefined' );
	exit;
}

session_start(); // Creates a 'Full Path Disclosure' vuln.

if (!file_exists(HVA_WEB_PAGE_TO_ROOT . 'config/config.inc.php')) {
	die ("hackcytes System error - config file not found. Copy config/config.inc.php.dist to config/config.inc.php and configure to your environment.");
}

// Include configs
require_once HVA_WEB_PAGE_TO_ROOT . 'config/config.inc.php';
require_once( 'hackcytesPhpIds.inc.php' );

// Declare the $html variable
if( !isset( $html ) ) {
	$html = "";
}

// Valid security levels
$security_levels = array('low', 'medium', 'high', 'impossible');
if( !isset( $_COOKIE[ 'security' ] ) || !in_array( $_COOKIE[ 'security' ], $security_levels ) ) {
	// Set security cookie to impossible if no cookie exists
	if( in_array( $_hackcytes[ 'default_security_level' ], $security_levels) ) {
		hackcytesSecurityLevelSet( $_hackcytes[ 'default_security_level' ] );
	}
	else {
		hackcytesSecurityLevelSet( 'low' );
	}

	if( $_hackcytes[ 'default_phpids_level' ] == 'enabled' )
		hackcytesPhpIdsEnabledSet( true );
	else
		hackcytesPhpIdsEnabledSet( false );
}

if (!array_key_exists ("default_locale", $_hackcytes)) {
	$_hackcytes[ 'default_locale' ] = "en";
}

hackcytesLocaleSet( $_hackcytes[ 'default_locale' ] );

// hackcytes version
function hackcytesVersionGet() {
	return '1.10 *Development*';
}

// hackcytes release date
function hackcytesReleaseDateGet() {
	return '2022-12-06';
}


// Start session functions --

function &hackcytesSessionGrab() {
	if( !isset( $_SESSION[ 'hackcytes' ] ) ) {
		$_SESSION[ 'hackcytes' ] = array();
	}
	return $_SESSION[ 'hackcytes' ];
}


function hackcytesPageStartup( $pActions ) {
	if( in_array( 'authenticated', $pActions ) ) {
		if( !hackcytesIsLoggedIn()) {
			hackcytesRedirect( HVA_WEB_PAGE_TO_ROOT . 'login.php' );
		}
	}

	if( in_array( 'phpids', $pActions ) ) {
		if( hackcytesPhpIdsIsEnabled() ) {
			hackcytesPhpIdsTrap();
		}
	}
}


function hackcytesPhpIdsEnabledSet( $pEnabled ) {
	$hackcytesSession =& hackcytesSessionGrab();
	if( $pEnabled ) {
		$hackcytesSession[ 'php_ids' ] = 'enabled';
	}
	else {
		unset( $hackcytesSession[ 'php_ids' ] );
	}
}


function hackcytesPhpIdsIsEnabled() {
	$hackcytesSession =& hackcytesSessionGrab();
	return isset( $hackcytesSession[ 'php_ids' ] );
}


function hackcytesLogin( $pUsername ) {
	$hackcytesSession =& hackcytesSessionGrab();
	$hackcytesSession[ 'username' ] = $pUsername;
}


function hackcytesIsLoggedIn() {
	$hackcytesSession =& hackcytesSessionGrab();
	return isset( $hackcytesSession[ 'username' ] );
}


function hackcytesLogout() {
	$hackcytesSession =& hackcytesSessionGrab();
	unset( $hackcytesSession[ 'username' ] );
}


function hackcytesPageReload() {
	hackcytesRedirect( $_SERVER[ 'PHP_SELF' ] );
}

function hackcytesCurrentUser() {
	$hackcytesSession =& hackcytesSessionGrab();
	return ( isset( $hackcytesSession[ 'username' ]) ? $hackcytesSession[ 'username' ] : '') ;
}

// -- END (Session functions)

function &hackcytesPageNewGrab() {
	$returnArray = array(
		'title'           => 'HackCytes',
		'title_separator' => ' :: ',
		'body'            => '',
		'page_id'         => '',
		'help_button'     => '',
		'source_button'   => '',
	);
	return $returnArray;
}


function hackcytesSecurityLevelGet() {
	return isset( $_COOKIE[ 'security' ] ) ? $_COOKIE[ 'security' ] : 'low';
}


function hackcytesSecurityLevelSet( $pSecurityLevel ) {
	if( $pSecurityLevel == 'low' ) {
		$httponly = true;
	}
	else {
		$httponly = false;
	}
	setcookie( session_name(), session_id(), 0, '/', "", false, $httponly );
	setcookie( 'security', $pSecurityLevel, 0, "/", "", false, $httponly );
}

function hackcytesLocaleGet() {	
	$hackcytesSession =& hackcytesSessionGrab();
	return $hackcytesSession[ 'locale' ];
}

function hackcytesSQLiDBGet() {
	global $_hackcytes;
	return $_hackcytes['SQLI_DB'];
}

function hackcytesLocaleSet( $pLocale ) {
	$hackcytesSession =& hackcytesSessionGrab();
	$locales = array('en', 'zh');
	if( in_array( $pLocale, $locales) ) {
		$hackcytesSession[ 'locale' ] = $pLocale;
	} else {
		$hackcytesSession[ 'locale' ] = 'en';
	}
}

// Start message functions --

function hackcytesMessagePush( $pMessage ) {
	$hackcytesSession =& hackcytesSessionGrab();
	if( !isset( $hackcytesSession[ 'messages' ] ) ) {
		$hackcytesSession[ 'messages' ] = array();
	}
	$hackcytesSession[ 'messages' ][] = $pMessage;
}


function hackcytesMessagePop() {
	$hackcytesSession =& hackcytesSessionGrab();
	if( !isset( $hackcytesSession[ 'messages' ] ) || count( $hackcytesSession[ 'messages' ] ) == 0 ) {
		return false;
	}
	return array_shift( $hackcytesSession[ 'messages' ] );
}


function messagesPopAllToHtml() {
	$messagesHtml = '';
	while( $message = hackcytesMessagePop() ) {   // TODO- sharpen!
		$messagesHtml .= "<div class=\"message\">{$message}</div>";
	}

	return $messagesHtml;
}

// --END (message functions)

function hackcytesHtmlEcho( $pPage ) {
	$menuBlocks = array();

	$menuBlocks[ 'home' ] = array();
	if( hackcytesIsLoggedIn() ) {
		$menuBlocks[ 'home' ][] = array( 'id' => 'home', 'name' => 'Home', 'url' => '.' );
		/*$menuBlocks[ 'home' ][] = array( 'id' => 'instructions', 'name' => 'Instructions', 'url' => 'instructions.php' );*/
	}
	else {
		/*$menuBlocks[ 'home' ][] = array( 'id' => 'setup', 'name' => 'Setup hackcytes', 'url' => 'setup.php' );
		$menuBlocks[ 'home' ][] = array( 'id' => 'instructions', 'name' => 'Instructions', 'url' => 'instructions.php' );*/
	}

	if( hackcytesIsLoggedIn() ) {
		$menuBlocks[ 'vulnerabilities' ] = array();
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'upload', 'name' => 'File Upload', 'url' => 'vulnerabilities/upload/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'sqli', 'name' => 'SQL Injection', 'url' => 'vulnerabilities/sqli/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'html_r', 'name' => 'HTML (Reflected)', 'url' => 'vulnerabilities/html_r/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'xss_r', 'name' => 'XSS (Reflected)', 'url' => 'vulnerabilities/xss_r/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'xss_s', 'name' => 'XSS (Stored)', 'url' => 'vulnerabilities/xss_s/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'xss_d', 'name' => 'XSS (DOM)', 'url' => 'vulnerabilities/xss_d/' );

		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'brute', 'name' => 'Brute Force', 'url' => 'vulnerabilities/brute/' );
		// $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'exec', 'name' => 'Command Injection', 'url' => 'vulnerabilities/exec/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'csrf', 'name' => 'CSRF', 'url' => 'vulnerabilities/csrf/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'fi', 'name' => 'File Inclusion', 'url' => 'vulnerabilities/fi/.?page=include.php' );
		// $menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'captcha', 'name' => 'Insecure CAPTCHA', 'url' => 'vulnerabilities/captcha/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'sqli_blind', 'name' => 'SQL Injection (Blind)', 'url' => 'vulnerabilities/sqli_blind/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'weak_id', 'name' => 'Weak Session IDs', 'url' => 'vulnerabilities/weak_id/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'csp', 'name' => 'CSP Bypass', 'url' => 'vulnerabilities/csp/' );
		$menuBlocks[ 'vulnerabilities' ][] = array( 'id' => 'javascript', 'name' => 'JavaScript', 'url' => 'vulnerabilities/javascript/' );
	}

	$menuBlocks[ 'meta' ] = array();
	// if( hackcytesIsLoggedIn() ) {
	// 	$menuBlocks[ 'meta' ][] = array( 'id' => 'security', 'name' => 'Security', 'url' => 'security.php' );
	// }
	$menuBlocks[ 'meta' ][] = array( 'id' => 'about', 'name' => 'About', 'url' => 'about.php' );

	if( hackcytesIsLoggedIn() ) {
		$menuBlocks[ 'logout' ] = array();
		$menuBlocks[ 'logout' ][] = array( 'id' => 'logout', 'name' => 'Logout', 'url' => 'logout.php' );
	}

	$menuBlocks[ 'forum' ] = array();
	$menuBlocks[ 'forum' ][] = array('id' => 'forum', 'name'=> 'Forum', 'url' => '../forum');

	$menuHtml = '';

	foreach( $menuBlocks as $menuBlock ) {
		$menuBlockHtml = '';
		if (($menuBlock[0]['id'] == 'logout') || ($menuBlock[0]['id'] == 'about') || ($menuBlock[0]['id'] == 'forum') ) {
			# code...
			$menuBlockHtml = '';
		}
		else {
			foreach( $menuBlock as $menuItem ) {
				$selectedClass = ( $menuItem[ 'id' ] == $pPage[ 'page_id' ] ) ? 'selected' : '';
				$fixedUrl = HVA_WEB_PAGE_TO_ROOT.$menuItem[ 'url' ];
				$menuBlockHtml .= "<li class=\"{$selectedClass}\"><a href=\"{$fixedUrl}\">{$menuItem[ 'name' ]}</a></li>\n";
			}
		}
		$menuHtml .= "<ul class=\"menuBlocks\">{$menuBlockHtml}</ul>";
		
	}

	$menu2Html = '';

	foreach( $menuBlocks as $menuBlock ) {
		$menuBlockHtml = '';
		if (($menuBlock[0]['id'] == 'logout') || ($menuBlock[0]['id'] == 'about')|| ($menuBlock[0]['id'] == 'forum') ) {
			foreach( $menuBlock as $menuItem ) {
				$selectedClass = ( $menuItem[ 'id' ] == $pPage[ 'page_id' ] ) ? 'selected' : '';
				$fixedUrl = HVA_WEB_PAGE_TO_ROOT.$menuItem[ 'url' ];
				$menuBlockHtml .= "<li class=\"{$selectedClass}\"><a href=\"{$fixedUrl}\">{$menuItem[ 'name' ]}</a></li>\n";
			}
			$menu2Html .= "<ul class=\"menuBlocks\">{$menuBlockHtml}</ul>";
		}
		else {
			$menuBlockHtml = "";
		}
		
	}

	// Get security cookie --
	$securityLevelHtml = '';
	switch( hackcytesSecurityLevelGet() ) {
		case 'low':
			$securityLevelHtml = 'low';
			break;
		case 'medium':
			$securityLevelHtml = 'medium';
			break;
		case 'high':
			$securityLevelHtml = 'high';
			break;
		default:
			$securityLevelHtml = 'impossible';
			break;
	}
	// -- END (security cookie)

	$phpIdsHtml   = '<em>PHPIDS:</em> ' . ( hackcytesPhpIdsIsEnabled() ? 'enabled' : 'disabled' );
	$userInfoHtml = '<em>Username:</em> ' . ( hackcytesCurrentUser() );
	$securityLevelHtml = "<em>Security Level:</em> {$securityLevelHtml}";
	$localeHtml = '<em>Locale:</em> ' . ( hackcytesLocaleGet() );
	$sqliDbHtml = '<em>SQLi DB:</em> ' . ( hackcytesSQLiDBGet() );
	

	$messagesHtml = messagesPopAllToHtml();
	if( $messagesHtml ) {
		$messagesHtml = "<div class=\"body_padded\">{$messagesHtml}</div>";
	}

	$systemInfoHtml = "";
	

	// Send Headers + main HTML code
	Header( 'Cache-Control: no-cache, must-revalidate');   // HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );     // TODO- proper XHTML headers...
	Header( 'Expires: Tue, 23 Jun 2009 12:00:00 GMT' );    // Date in the past

	echo "<!DOCTYPE html>

<html lang=\"en-GB\">

	<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage[ 'title' ]}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"" . HVA_WEB_PAGE_TO_ROOT . "hva/css/main.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"" . HVA_WEB_PAGE_TO_ROOT . "favicon.ico\" />

		<script type=\"text/javascript\" src=\"" . HVA_WEB_PAGE_TO_ROOT . "hva/js/hackcytesPage.js\"></script>

	</head>

	<body class=\"home\">
		<div id=\"container\">

			<div id=\"header\">

				<img src=\"" . HVA_WEB_PAGE_TO_ROOT . "hva/images/logo.png\" width=\"380\" alt=\"HackCytes\" />

				<div id=\"main_menu2\">
				{$menu2Html}
				</div>

			</div>

			<div id=\"main_menu\">

				<div id=\"main_menu_padded\">
				{$menuHtml}
				</div>

			</div>
			<div id=\"center\" >
				<div id=\"main_body\">

					{$pPage[ 'body' ]}
					<br /><br />
					{$messagesHtml}
					";
					if ($pPage['page_id']!='home' && $pPage['page_id']!='about') {
					  echo "<button style=\"width: 95px;float: right;margin: 10px 20px; padding: 10px 10px 10px 10px;\"><a href=\"../solution.php?v={$pPage['page_id']}\" style=\"text-decoration: none; color: black; \">Hint</a></button>";
						# code...
					}
				echo "</div>
			</div>
			

			

			<footer id=\"footer\">

				<p>HackCytes</p>
				<script src='" . HVA_WEB_PAGE_TO_ROOT . "/hva/js/add_event_listeners.js'></script>

			</footer>

		</div>

	</body>

</html>";
}


function hackcytesHelpHtmlEcho( $pPage ) {
	// Send Headers
	Header( 'Cache-Control: no-cache, must-revalidate');   // HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );     // TODO- proper XHTML headers...
	Header( 'Expires: Tue, 23 Jun 2009 12:00:00 GMT' );    // Date in the past

	echo "<!DOCTYPE html>

<html lang=\"en-GB\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage[ 'title' ]}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"" . HVA_WEB_PAGE_TO_ROOT . "hva/css/help.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"" . HVA_WEB_PAGE_TO_ROOT . "favicon.ico\" />

	</head>

	<body>

	<div id=\"container\">

			{$pPage[ 'body' ]}

		</div>

	</body>

</html>";
}


function hackcytesSourceHtmlEcho( $pPage ) {
	// Send Headers
	Header( 'Cache-Control: no-cache, must-revalidate');   // HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );     // TODO- proper XHTML headers...
	Header( 'Expires: Tue, 23 Jun 2009 12:00:00 GMT' );    // Date in the past

	echo "<!DOCTYPE html>

<html lang=\"en-GB\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage[ 'title' ]}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"" . HVA_WEB_PAGE_TO_ROOT . "hva/css/source.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"" . HVA_WEB_PAGE_TO_ROOT . "favicon.ico\" />

	</head>

	<body>

		<div id=\"container\">

			{$pPage[ 'body' ]}

		</div>

	</body>

</html>";
}

// To be used on all external links --
function hackcytesExternalLinkUrlGet( $pLink,$text=null ) {
	if(is_null( $text )) {
		return '<a href="' . $pLink . '" target="_blank">' . $pLink . '</a>';
	}
	else {
		return '<a href="' . $pLink . '" target="_blank">' . $text . '</a>';
	}
}
// -- END ( external links)

function hackcytesButtonHelpHtmlGet( $pId ) {
	$security = hackcytesSecurityLevelGet();
	$locale = hackcytesLocaleGet();
	return "<input type=\"button\" value=\"View Help\" class=\"popup_button\" id='help_button' data-help-url='" . HVA_WEB_PAGE_TO_ROOT . "vulnerabilities/view_help.php?id={$pId}&security={$security}&locale={$locale}' )\">";
}


function hackcytesButtonSourceHtmlGet( $pId ) {
	$security = hackcytesSecurityLevelGet();
	return "<input type=\"button\" value=\"View Source\" class=\"popup_button\" id='source_button' data-source-url='" . HVA_WEB_PAGE_TO_ROOT . "vulnerabilities/view_source.php?id={$pId}&security={$security}' )\">";
}


// Database Management --

if( $DBMS == 'MySQL' ) {
	$DBMS = htmlspecialchars(strip_tags( $DBMS ));
	$DBMS_errorFunc = 'mysqli_error()';
}
elseif( $DBMS == 'PGSQL' ) {
	$DBMS = htmlspecialchars(strip_tags( $DBMS ));
	$DBMS_errorFunc = 'pg_last_error()';
}
else {
	$DBMS = "No DBMS selected.";
	$DBMS_errorFunc = '';
}

//$DBMS_connError = '
//	<div align="center">
//		<img src="' . HVA_WEB_PAGE_TO_ROOT . 'hva/images/logo.png" />
//		<pre>Unable to connect to the database.<br />' . $DBMS_errorFunc . '<br /><br /></pre>
//		Click <a href="' . HVA_WEB_PAGE_TO_ROOT . 'setup.php">here</a> to setup the database.
//	</div>';

function hackcytesDatabaseConnect() {
	global $_hackcytes;
	global $DBMS;
	//global $DBMS_connError;
	global $db;
	global $sqlite_db_connection;

	if( $DBMS == 'MySQL' ) {
		if( !@($GLOBALS["___mysqli_ston"] = mysqli_connect( $_hackcytes[ 'db_server' ],  $_hackcytes[ 'db_user' ],  $_hackcytes[ 'db_password' ], "", $_hackcytes[ 'db_port' ] ))
		|| !@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $_hackcytes[ 'db_database' ])) ) {
			//die( $DBMS_connError );
			hackcytesLogout();
			hackcytesMessagePush( 'Unable to connect to the database.<br />' );
			hackcytesRedirect( HVA_WEB_PAGE_TO_ROOT . 'setup.php' );
		}
		// MySQL PDO Prepared Statements (for impossible levels)
		$db = new PDO('mysql:host=' . $_hackcytes[ 'db_server' ].';dbname=' . $_hackcytes[ 'db_database' ].';port=' . $_hackcytes['db_port'] . ';charset=utf8', $_hackcytes[ 'db_user' ], $_hackcytes[ 'db_password' ]);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
	elseif( $DBMS == 'PGSQL' ) {
		//$dbconn = pg_connect("host={$_hackcytes[ 'db_server' ]} dbname={$_hackcytes[ 'db_database' ]} user={$_hackcytes[ 'db_user' ]} password={$_hackcytes[ 'db_password' ])}"
		//or die( $DBMS_connError );
		hackcytesMessagePush( 'PostgreSQL is not currently supported.' );
		hackcytesPageReload();
	}
	else {
		die ( "Unknown {$DBMS} selected." );
	}

	if ($_hackcytes['SQLI_DB'] == SQLITE) {
		$location = HVA_WEB_PAGE_TO_ROOT . "database/" . $_hackcytes['SQLITE_DB'];
		$sqlite_db_connection = new SQLite3($location);
		$sqlite_db_connection->enableExceptions(true);
	#	print "sqlite db setup";
	}
}

// -- END (Database Management)


function hackcytesRedirect( $pLocation ) {
	session_commit();
	header( "Location: {$pLocation}" );
	exit;
}

// XSS Stored guestbook function --
function hackcytesGuestbook() {
	$query  = "SELECT name, comment FROM guestbook";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query );

	$guestbook = '';

	while( $row = mysqli_fetch_row( $result ) ) {
		if( hackcytesSecurityLevelGet() == 'impossible' ) {
			$name    = htmlspecialchars( $row[0] );
			$comment = htmlspecialchars( $row[1] );
		}
		else {
			$name    = $row[0];
			$comment = $row[1];
		}

		$guestbook .= "<div id=\"guestbook_comments\">Name: {$name}<br />" . "Message: {$comment}<br /></div>\n";
	}
	return $guestbook;
}
// -- END (XSS Stored guestbook)


// Token functions --
function checkToken( $user_token, $session_token, $returnURL ) {  # Validate the given (CSRF) token
	if( $user_token !== $session_token || !isset( $session_token ) ) {
		hackcytesMessagePush( 'CSRF token is incorrect' );
		hackcytesRedirect( $returnURL );
	}
}

function generateSessionToken() {  # Generate a brand new (CSRF) token
	if( isset( $_SESSION[ 'session_token' ] ) ) {
		destroySessionToken();
	}
	$_SESSION[ 'session_token' ] = md5( uniqid() );
}

function destroySessionToken() {  # Destroy any session with the name 'session_token'
	unset( $_SESSION[ 'session_token' ] );
}

function tokenField() {  # Return a field for the (CSRF) token
	return "<input type='hidden' name='user_token' value='{$_SESSION[ 'session_token' ]}' />";
}
// -- END (Token functions)


// Setup Functions --
$PHPUploadPath    = realpath( getcwd() . DIRECTORY_SEPARATOR . HVA_WEB_PAGE_TO_ROOT . "hackable" . DIRECTORY_SEPARATOR . "uploads" ) . DIRECTORY_SEPARATOR;
$PHPIDSPath       = realpath( getcwd() . DIRECTORY_SEPARATOR . HVA_WEB_PAGE_TO_ROOT . "external" . DIRECTORY_SEPARATOR . "phpids" . DIRECTORY_SEPARATOR . hackcytesPhpIdsVersionGet() . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "IDS" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . "phpids_log.txt" );
$PHPCONFIGPath       = realpath( getcwd() . DIRECTORY_SEPARATOR . HVA_WEB_PAGE_TO_ROOT . "config");


$phpDisplayErrors = 'PHP function display_errors: <em>' . ( ini_get( 'display_errors' ) ? 'Enabled</em> <i>(Easy Mode!)</i>' : 'Disabled</em>' );                                                  // Verbose error messages (e.g. full path disclosure)
$phpSafeMode      = 'PHP function safe_mode: <span class="' . ( ini_get( 'safe_mode' ) ? 'failure">Enabled' : 'success">Disabled' ) . '</span>';                                                   // DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0
$phpMagicQuotes   = 'PHP function magic_quotes_gpc: <span class="' . ( ini_get( 'magic_quotes_gpc' ) ? 'failure">Enabled' : 'success">Disabled' ) . '</span>';                                     // DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0
$phpURLInclude    = 'PHP function allow_url_include: <span class="' . ( ini_get( 'allow_url_include' ) ? 'success">Enabled' : 'failure">Disabled' ) . '</span>';                                   // RFI
$phpURLFopen      = 'PHP function allow_url_fopen: <span class="' . ( ini_get( 'allow_url_fopen' ) ? 'success">Enabled' : 'failure">Disabled' ) . '</span>';                                       // RFI
$phpGD            = 'PHP module gd: <span class="' . ( ( extension_loaded( 'gd' ) && function_exists( 'gd_info' ) ) ? 'success">Installed' : 'failure">Missing - Only an issue if you want to play with captchas' ) . '</span>';                    // File Upload
$phpMySQL         = 'PHP module mysql: <span class="' . ( ( extension_loaded( 'mysqli' ) && function_exists( 'mysqli_query' ) ) ? 'success">Installed' : 'failure">Missing' ) . '</span>';                // Core hackcytes
$phpPDO           = 'PHP module pdo_mysql: <span class="' . ( extension_loaded( 'pdo_mysql' ) ? 'success">Installed' : 'failure">Missing' ) . '</span>';                // SQLi
$hackcytesRecaptcha    = 'reCAPTCHA key: <span class="' . ( ( isset( $_hackcytes[ 'recaptcha_public_key' ] ) && $_hackcytes[ 'recaptcha_public_key' ] != '' ) ? 'success">' . $_hackcytes[ 'recaptcha_public_key' ] : 'failure">Missing' ) . '</span>';

$hackcytesUploadsWrite = '[User: ' . get_current_user() . '] Writable folder ' . $PHPUploadPath . ': <span class="' . ( is_writable( $PHPUploadPath ) ? 'success">Yes' : 'failure">No' ) . '</span>';                                     // File Upload
$bakWritable = '[User: ' . get_current_user() . '] Writable folder ' . $PHPCONFIGPath . ': <span class="' . ( is_writable( $PHPCONFIGPath ) ? 'success">Yes' : 'failure">No' ) . '</span>';   // config.php.bak check                                  // File Upload
$hackcytesPHPWrite     = '[User: ' . get_current_user() . '] Writable file ' . $PHPIDSPath . ': <span class="' . ( is_writable( $PHPIDSPath ) ? 'success">Yes' : 'failure">No' ) . '</span>';                                              // PHPIDS

$hackcytesOS           = 'Operating system: <em>' . ( strtoupper( substr (PHP_OS, 0, 3)) === 'WIN' ? 'Windows' : '*nix' ) . '</em>';
$SERVER_NAME      = 'Web Server SERVER_NAME: <em>' . $_SERVER[ 'SERVER_NAME' ] . '</em>';                                                                                                          // CSRF

$MYSQL_USER       = 'Database username: <em>' . $_hackcytes[ 'db_user' ] . '</em>';
$MYSQL_PASS       = 'Database password: <em>' . ( ('admin' != "" ) ? '******' : '*blank*' ) . '</em>';
$MYSQL_DB         = 'Database database: <em>' . $_hackcytes[ 'db_database' ] . '</em>';
$MYSQL_SERVER     = 'Database host: <em>' . $_hackcytes[ 'db_server' ] . '</em>';
$MYSQL_PORT       = 'Database port: <em>' . $_hackcytes[ 'db_port' ] . '</em>';
// -- END (Setup Functions)
