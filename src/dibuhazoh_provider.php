<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Dibuhazoh\DibuhazohProvider;
use Exception;

try {
    echo DibuhazohProvider::getDibuhazohAsJson($_REQUEST);
} catch (Exception $exception) {
    echo json_encode(array('exception' => $exception->getMessage()));
}
