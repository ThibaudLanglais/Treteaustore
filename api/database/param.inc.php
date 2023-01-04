<?php
$localhost = false;
$base = isset($isHomePage) ? '.' : '..';

if ($localhost === true) {
	if (!defined("MYHOST"))
		define("MYHOST", "localhost");
	if (!defined("MYUSER"))
		define("MYUSER", "root");
	if (!defined("MYPASS"))
		define("MYPASS", "");
	if (!defined("MYDB"))
		define("MYDB", "Ludotheque");
} else {
	if (!defined("MYHOST"))
		define("MYHOST", "e-srv-lamp.univ-lemans.fr");
	if (!defined("MYUSER"))
		define("MYUSER", "i190488");
	if (!defined("MYPASS"))
		define("MYPASS", "Mxd221hh");
	if (!defined("MYDB"))
		define("MYDB", "i190488");
}

$bdd = new PDO("mysql:host=" . MYHOST . ";dbname=" . MYDB, MYUSER, MYPASS);

require("$base/api/functions.php");


