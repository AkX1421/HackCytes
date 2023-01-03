<?php

define( 'HVA_WEB_PAGE_TO_ROOT', '' );
require_once HVA_WEB_PAGE_TO_ROOT . 'hva/includes/hackcytesPage.inc.php';

hackcytesPageStartup( array( 'phpids' ) );

$page = hackcytesPageNewGrab();
$page[ 'title' ]   = 'About' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'about';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h2>About</h2>
	<p>Hackcytes Vulnerable Web Application (hackcytes) is a PHP/MySQL web application that is vulnerable. Its main goals are to be an aid for security professionals to test their skills and tools in a legal environment, help web developers better understand the processes of securing web applications and aid teachers/students to teach/learn web application security in a class room environment</p>
    
	<p>Do you want to be a bug bounty hunter? Do you want to learn about web-app pentesting? Are you confused because you don't know where to start? We have designed an extremely vulnerable web-app that will take care of all your worries. 
	Hackcytes aims to provide beginners, students and professionals an environment where they can put their skills to test and learn how to secure a web application.</p>
	<p>Our easy to understand interface and <em> levels based on difficulty</em>,will make sure you <em>dot the i's and cross the t's</em> of web-application penetration testing.</p>

	<h2>Credits</h2>
	<ul>
		<li>Nimisha</li>
		<li>Aakanksha</li>
		<li>Yash</li>
		<li>Abhijeet</li>
		<li>Sameer</li>
	</ul>

</div>\n";

hackcytesHtmlEcho( $page );

exit;

?>
