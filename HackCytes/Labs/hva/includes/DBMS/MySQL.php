<?php

/*

This file contains all of the code to setup the initial MySQL database. (setup.php)

*/

if( !defined( 'HVA_WEB_PAGE_TO_ROOT' ) ) {
	define( 'HVA_WEB_PAGE_TO_ROOT', '../../../' );
}

if( !@($GLOBALS["___mysqli_ston"] = mysqli_connect( $_hackcytes[ 'db_server' ],  $_hackcytes[ 'db_user' ],  $_hackcytes[ 'db_password' ], "", $_hackcytes[ 'db_port' ] )) ) {
	hackcytesMessagePush( "Could not connect to the database service.<br />Please check the config file.<br />Database Error #" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "." );
	if ($_hackcytes[ 'db_user' ] == "root") {
		hackcytesMessagePush( 'Your database user is root, if you are using MariaDB, this will not work, please read the README.md file.' );
	}
	hackcytesPageReload();
}

// Create database
$drop_db = "DROP DATABASE IF EXISTS {$_hackcytes[ 'db_database' ]};";
if( !@mysqli_query($GLOBALS["___mysqli_ston"],  $drop_db ) ) {
	hackcytesMessagePush( "Could not drop existing database<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	hackcytesPageReload();
}

$create_db = "CREATE DATABASE {$_hackcytes[ 'db_database' ]};";
if( !@mysqli_query($GLOBALS["___mysqli_ston"],  $create_db ) ) {
	hackcytesMessagePush( "Could not create database<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	hackcytesPageReload();
}
hackcytesMessagePush( "Database has been created." );


// Create table 'users'
if( !@((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $_hackcytes[ 'db_database' ])) ) {
	hackcytesMessagePush( 'Could not connect to database.' );
	hackcytesPageReload();
}

$create_tb = "CREATE TABLE users (user_id int(6),first_name varchar(15),last_name varchar(15), user varchar(15), password varchar(32),avatar varchar(70), last_login TIMESTAMP, failed_login INT(3), PRIMARY KEY (user_id));";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $create_tb ) ) {
	hackcytesMessagePush( "Table could not be created<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	hackcytesPageReload();
}
hackcytesMessagePush( "'users' table was created." );


// Insert some data into users
$base_dir= str_replace ("setup.php", "", $_SERVER['SCRIPT_NAME']);
$avatarUrl  = $base_dir . 'hackable/users/';

$insert = "INSERT INTO users VALUES
	('1','admin','admin','admin',MD5('password'),'{$avatarUrl}admin.jpg', NOW(), '0'),
	('2','Gordon','Brown','gordonb',MD5('abc123'),'{$avatarUrl}gordonb.jpg', NOW(), '0'),
	('3','Hack','Me','1337',MD5('charley'),'{$avatarUrl}1337.jpg', NOW(), '0'),
	('4','Pablo','Picasso','pablo',MD5('letmein'),'{$avatarUrl}pablo.jpg', NOW(), '0'),
	('5','Bob','Smith','smithy',MD5('password'),'{$avatarUrl}smithy.jpg', NOW(), '0');";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $insert ) ) {
	hackcytesMessagePush( "Data could not be inserted into 'users' table<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	hackcytesPageReload();
}
hackcytesMessagePush( "Data inserted into 'users' table." );


// Create guestbook table
$create_tb_guestbook = "CREATE TABLE guestbook (comment_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, comment varchar(300), name varchar(100), PRIMARY KEY (comment_id));";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $create_tb_guestbook ) ) {
	hackcytesMessagePush( "Table could not be created<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	hackcytesPageReload();
}
hackcytesMessagePush( "'guestbook' table was created." );


// Insert data into 'guestbook'
$insert = "INSERT INTO guestbook VALUES ('1','This is a test comment.','test');";
if( !mysqli_query($GLOBALS["___mysqli_ston"],  $insert ) ) {
	hackcytesMessagePush( "Data could not be inserted into 'guestbook' table<br />SQL: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) );
	hackcytesPageReload();
}
hackcytesMessagePush( "Data inserted into 'guestbook' table." );




// Copy .bak for a fun directory listing vuln
$conf = HVA_WEB_PAGE_TO_ROOT . 'config/config.inc.php';
$bakconf = HVA_WEB_PAGE_TO_ROOT . 'config/config.inc.php.bak';
if (file_exists($conf)) {
	// Who cares if it fails. Suppress.
	@copy($conf, $bakconf);
}

hackcytesMessagePush( "Backup file /config/config.inc.php.bak automatically created" );

// Done
hackcytesMessagePush( "<em>Setup successful</em>!" );

if( !hackcytesIsLoggedIn())
	hackcytesMessagePush( "Please <a href='login.php'>login</a>.<script>setTimeout(function(){window.location.href='login.php'},5000);</script>" );
hackcytesPageReload();

?>
