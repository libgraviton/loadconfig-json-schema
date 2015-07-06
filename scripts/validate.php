<?php

require_once dirname(__FILE__).'/../vendor/autoload.php';

use \Graviton\JsonSchema\Validator;

// array of files to validate
$validateFiles = array(
    dirname(__FILE__).'/../schema/loadconfig/v1.0/schema.json'
);

$validator = new Validator();
$exitStatus = 0;

foreach ($validateFiles as $validateFile) {

    echo str_repeat('-', 50).PHP_EOL;
    echo 'checking "'.$validateFile.'"'.PHP_EOL;

    $data = file_get_contents($validateFile);

    if (!$validator->isValid(Validator::TYPE_SCHEMA_DRAFT_4, $data)) {
        echo "JSON does not validate. Violations:\n";
        foreach ($validator->getLastErrors() as $error) {
            echo sprintf("[%s] %s\n", $error['property'], $error['message']).PHP_EOL;;
        }
        $exitStatus = -1;
    } else {
        echo "VALID!".PHP_EOL;
    }
}

exit($exitStatus);
