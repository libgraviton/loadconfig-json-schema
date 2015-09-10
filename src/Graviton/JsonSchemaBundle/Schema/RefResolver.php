<?php
/**
 * RefResolver class file
 */

namespace Graviton\JsonSchemaBundle\Schema;

use JsonSchema\RefResolver as BaseRefResolver;
use JsonSchema\Uri\UriResolver;
use JsonSchema\Uri\UriRetriever;

/**
 * $ref resolver
 *
 * @author   List of contributors <https://github.com/libgraviton/graviton/graphs/contributors>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://swisscom.ch
 */
class RefResolver extends BaseRefResolver
{
    /**
     * @var \SplObjectStorage
     */
    private $resolved;
    /**
     * @var array
     */
    private $loaded;

    /**
     * Constructor
     *
     * @param UriRetriever $retriever URI retriever
     */
    public function __construct($retriever = null)
    {
        $this->resolved = new \SplObjectStorage();
        $this->loaded = [];

        parent::__construct($retriever);
    }

    /**
     * Clear schema cache
     *
     * @return void
     */
    private function clearCache()
    {
        foreach ($this->resolved as $schema) {
            unset($this->resolved[$schema]);
        }
        foreach (array_keys($this->loaded) as $schema) {
            unset($this->loaded[$schema]);
        }
    }

    /**
     * Retrieves a given schema given a ref and a source URI
     *
     * @param  string $ref       Reference from schema
     * @param  string $sourceUri URI where original schema was located
     * @return object            Schema
     */
    public function fetchRef($ref, $sourceUri)
    {
        $uri = (new UriResolver())->resolve($ref, $sourceUri);
        if (isset($this->loaded[$uri])) {
            return $this->loaded[$uri];
        }

        return $this->loaded[$uri] = parent::fetchRef($ref, $sourceUri);
    }

    /**
     * Resolves all $ref references for a given schema
     *
     * @param object $schema    JSON Schema to resolve
     * @param string $sourceUri URI where this schema was located
     * @return void
     */
    public function resolve($schema, $sourceUri = null)
    {
        if (self::$depth === 0) {
            $this->clearCache();
        }

        // save cache
        if (is_object($schema)) {
            if ($this->resolved->contains($schema)) {
                return;
            }
            $this->resolved->attach($schema);
        }

        parent::resolve($schema, $sourceUri);

        if (self::$depth === 0) {
            $this->clearCache();
        }
    }
}
