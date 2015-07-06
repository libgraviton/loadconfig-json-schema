<?php
/**
 * Validates JSON data against a schema
 */

namespace Graviton\JsonSchema;

use \JsonSchema\Uri\Retrievers\FileGetContents;
use \JsonSchema\Validator as SchemaValidator;

/**
 * Validator
 *
 * A wrapper around justinrainbow/json-schema for our purposes of validating JSON schemas
 *
 * @author   List of contributors <https://github.com/libgraviton/json-schema/graphs/contributors>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://swisscom.ch
 */
class Validator
{
    const TYPE_SCHEMA_DRAFT_4 = 'http://json-schema.org/draft-04/schema#';

    private $errors = [];

    /**
     * Validates the string $data against the schema as defined in url $schemaUrl
     *
     * @param string $schemaUrl URL to schema
     * @param string $data      Data as string
     *
     * @return bool
     */
    public function isValid($schemaUrl, $data)
    {
        $retriever = new FileGetContents();
        $schema = $retriever->retrieve($schemaUrl);
        return $this->isValidWithSchemaData($schema, $data);
    }

    /**
     * Validates the string $data agains the schema as defined in url $schemaUrl
     *
     * @param string $schema Schema as string
     * @param string $data   Data as string
     *
     * @return bool
     */
    public function isValidWithSchemaData($schema, $data)
    {
        $validator = new SchemaValidator();
        $validator->check(json_decode($data), json_decode($schema));

        $result = true;
        if (!$validator->isValid()) {
            $result = false;
            $this->errors = $validator->getErrors();
        }

        return $result;
    }

    /**
     * Returns the last errors
     *
     * @return array
     */
    public function getLastErrors()
    {
        return $this->errors;
    }
}
