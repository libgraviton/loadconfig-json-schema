<?php
/**
 * SchemaFactoryTest class file
 */

namespace Graviton\JsonSchemaBundle\Tests\Schema;

use Graviton\JsonSchemaBundle\Schema\SchemaFactory;

/**
 * Test SchemaFactory
 *
 * @author   List of contributors <https://github.com/libgraviton/graviton/graphs/contributors>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://swisscom.ch
 */
class SchemaFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test SchemaFactory::createSchema()
     *
     * @return void
     */
    public function testCreateSchema()
    {
        $uri = __METHOD__;
        $schema = (object) [__METHOD__ => __LINE__];

        $resolver = $this->getMockBuilder('JsonSchema\RefResolver')
            ->disableOriginalConstructor()
            ->getMock();
        $resolver->expects($this->once())
            ->method('resolve')
            ->with($uri)
            ->willReturn($schema);

        $this->assertEquals(
            $schema,
            (new SchemaFactory($resolver))->createSchema($uri)
        );
    }
}
