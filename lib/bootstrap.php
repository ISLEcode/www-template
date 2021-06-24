<?php
require __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

use SAM\Database\MySQL;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!function_exists ('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'Sorry PHP mysqli extension is missing.';
    exit;
}

error_reporting (E_ALL);
date_default_timezone_set ('Europe/Zurich');

$logfile = __DIR__ . 'backend.log';

$env    = new DotEnv (__DIR__ . '/..');
$env    ->load ();
$db     = (new MySQL ()) ->connect ();
