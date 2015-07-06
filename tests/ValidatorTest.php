<?php
/**
 * Validator test
 */

use Graviton\JsonSchema\Validator;

/**
 * ValidatorTest
 *
 * @author   List of contributors <https://github.com/libgraviton/json-schema/graphs/contributors>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://swisscom.ch
 */
class ValidatorTest extends PHPUnit_Framework_TestCase {

    /**
     * Tests schema validation
     *
     * @param string $schemaPath         schema path
     * @param bool   $expectedValidation expected result
     * @param int    $errorCount         error count
     *
     * @dataProvider schemaTestDataProvider
     */
    public function testValidSchema($schemaPath, $expectedValidation, $errorCount)
    {
        $this->assertTrue(true);
        $v = new Validator();

        $this->assertEquals(
            $expectedValidation,
            $v->isValid(Validator::TYPE_SCHEMA_DRAFT_4, file_get_contents($schemaPath))
        );

        $this->assertEquals(
            $errorCount,
            count($v->getLastErrors())
        );
    }

    /**
     * Data provider for schema test
     *
     * @return array test data
     */
    public function schemaTestDataProvider()
    {
        $fileBase = dirname(__FILE__).'/resources/';
        return array(
            array(
                $fileBase . 'schema-good.json',
                true,
                0
            ),
            array(
                $fileBase . 'schema-empty.json',
                false,
                1
            ),
            array(
                $fileBase . 'schema-wrong.json',
                false,
                1
            )
        );
    }

}
