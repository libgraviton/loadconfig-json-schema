<?php
/**
 * custom factory to inject the event dispatcher into our constraints
 */

namespace Graviton\JsonSchemaBundle\Validator\Constraint;

use JsonSchema\Constraints\Factory as BaseFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author   List of contributors <https://github.com/libgraviton/graviton/graphs/contributors>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://swisscom.ch
 */
class Factory extends BaseFactory
{

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher = null;

    /**
     * Create a constraint instance for the given constraint name.
     *
     * @param string                   $constraintName  constraint name
     * @param EventDispatcherInterface $eventDispatcher dispatcher
     *
     * @throws InvalidArgumentException if is not possible create the constraint instance.
     *
     * @return ConstraintInterface|ObjectConstraint instance
     */
    public function createInstanceFor($constraintName, EventDispatcherInterface $eventDispatcher = null)
    {
        $instance = parent::createInstanceFor($constraintName);

        if (!is_null($eventDispatcher)) {
            $this->dispatcher = $eventDispatcher;
        }

        if (!is_null($this->dispatcher) && is_callable([$instance, 'setEventDispatcher'])) {
            $instance->setEventDispatcher($this->dispatcher);
        }

        return $instance;
    }
}
