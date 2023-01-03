<?php

define( 'HVA_WEB_PAGE_TO_ROOT', '' );
require_once HVA_WEB_PAGE_TO_ROOT . 'hva/includes/hackcytesPage.inc.php';

hackcytesPageStartup( array( 'authenticated', 'phpids' ) );

$page = hackcytesPageNewGrab();
$page[ 'title' ]   = 'Welcome' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'home';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Welcome to Hackcytes Vulnerable Web Application!</h1>
	<p>Do you want to be a bug bounty hunter? Do you want to learn about web-app pentesting? Are you confused because you don't know where to start? We have designed an extremely vulnerable web-app that will take care of all your worries. 
	Hackcytes aims to provide beginners, students and professionals an environment where they can put their skills to test and learn how to secure a web application.</p>
	<p>Our easy to understand interface and <em> levels based on difficulty</em>,will make sure you <em>dot the i's and cross the t's</em> of web-application penetration testing.</p>
	<hr />
	<br />

	<h2>General Instructions</h2>
	<p>There is no learning path to follow through. If you see a vulnerabilty and you find it interesting, that is all you need to know to start learning.Work through all the levels of vulnerability in a subsequent manner to get the most out of HackCytes.</p>
	<p>In here, you will find many surprises, both intentionally and unintentionally placed vulnerability.<em>You are expected to look for vulnerabilities where you least expect to find them.</em>.</p>
	<p>Hackcytes Vulnerable Web Application also includes a Web Application Firewall (WAF), PHPIDS, which can be enabled at any stage to further increase the difficulty. This will demonstrate how adding another layer of security may block certain malicious actions. Note, there are also various public methods at bypassing these protections (so this can be seen as an extension for more advanced users)!</p>
	
</div>";

hackcytesHtmlEcho( $page );

?>
