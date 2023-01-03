<?php

$html = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$cookie_value = time();
	setcookie("hackcytesSession", $cookie_value);
}
?>
