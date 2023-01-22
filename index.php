<?php
require('./api/database/param.inc.php');
if(!isset($_GET['p'])) header("Location: ./?p=orders");
else if(!file_exists('./' . $_GET['p'] . '.php')) require('404.php');
else require('./'. $_GET['p'] .'.php');
