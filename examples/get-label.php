<?php

use Kayue\Postmen\Postmen;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once 'config.php';

$postmen = new Postmen(POSTMEN_API_KEY);

if (!isset($_GET['id'])) {
    exit('Please provide a label ID in URL.');
}

echo "<pre>";
print_r($postmen->getLabel($_GET['id']));
echo "</pre>";
