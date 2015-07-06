<?php

require_once dirname(__FILE__).'/../vendor/autoload.php';

// array of files to validate
$validateFiles = array(
    dirname(__FILE__).'/../schema/loadconfig/v1.0/schema.json'
);

// define schema and
$schemaUrl = 'http://json-schema.org/draft-04/schema#';

$retriever = new JsonSchema\Uri\Retrievers\FileGetContents();
$schema = json_decode($retriever->retrieve($schemaUrl));
$validator = new JsonSchema\Validator();
$exit = 0;

foreach ($validateFiles as $validateFile) {

    echo str_repeat('-', 50).PHP_EOL;
    echo 'checking "'.$validateFile.'"'.PHP_EOL;

    $data = json_decode(file_get_contents($validateFile));

    $validator->check($data, $schema);

    if ($validator->isValid()) {
        echo "The supplied JSON validates against the schema.\n";
    } else {
        echo "JSON does not validate. Violations:\n";
        foreach ($validator->getErrors() as $error) {
            echo sprintf("[%s] %s\n", $error['property'], $error['message']);
        }
        $exit = -1;
    }
}

exit($exit);
