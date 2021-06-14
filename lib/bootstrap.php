<?php
require __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

use SAMinfo\QRCode\Database;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!function_exists ('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'Sorry PHP mysqli extension is missing.';
    exit;
}

$env = new DotEnv (__DIR__ . '/..');
$env ->load ();
$db  = (new Database()) ->connect ();
