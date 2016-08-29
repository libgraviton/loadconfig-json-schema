<?php
namespace Graviton\JsonSchemaBin;

use Graviton\JsonSchemaBundle\Validator\Validator;

if (!ini_get('date.timezone')) {
    ini_set('date.timezone', 'UTC');
}

function getAutoloadFile()
{
    $files = [
        __DIR__.'/../../../autoload.php',
        __DIR__.'/../../autoload.php',
        __DIR__.'/../vendor/autoload.php',
        __DIR__.'/vendor/autoload.php',
    ];
    foreach ($files as $file) {
        if (file_exists($file)) {
            return $file;
        }
    }

    return null;
}
function getJsonValidator($uri)
{
    return new Validator(
        new \JsonSchema\Validator(),
        (object) ['$ref' => $uri]
    );
}

$autoload = getAutoloadFile();
if ($autoload === null) {
    fwrite(STDERR,
        'You need to set up the project dependencies using the following commands:'.PHP_EOL.
        'wget http://getcomposer.org/composer.phar'.PHP_EOL.
        'php composer.phar install'.PHP_EOL
    );

    die(1);
}
require $autoload;
