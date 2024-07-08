<?php
require '../vendor/autoload.php'; // Composer autoload

use Dotenv\Dotenv;

// Load .env file
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


require_once "../functions/bist-sql.php";
require_once "../functions/bist-encrypt.php";
require_once "../functions/bist-mail.php";
require_once "../functions/bist-name-values.php";
$bistSql = new bistSql();
$bistCrypt = new bistCrypt();
$bistMailer = new bistMailer();
