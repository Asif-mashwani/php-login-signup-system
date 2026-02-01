<?php
// config.php
session_start();
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'login_system';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
    die('DB connection failed: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>