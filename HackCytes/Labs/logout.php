<?php

define( 'HVA_WEB_PAGE_TO_ROOT', '' );
require_once HVA_WEB_PAGE_TO_ROOT . 'hva/includes/hackcytesPage.inc.php';

hackcytesPageStartup( array( 'phpids' ) );

if( !hackcytesIsLoggedIn() ) {	// The user shouldn't even be on this page
	// hackcytesMessagePush( "You were not logged in" );
	hackcytesRedirect( 'login.php' );
}

hackcytesLogout();
hackcytesMessagePush( "You have logged out" );
hackcytesRedirect( '../Labs' );

?>
