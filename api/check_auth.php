<?php
$base = isset($isHomePage) ? '.' : '..';
if (!isset($_SESSION['id'])) {
    header("Location: $base/search/");
}
