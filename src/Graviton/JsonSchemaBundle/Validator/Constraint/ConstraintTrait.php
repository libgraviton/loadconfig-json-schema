<?php
/**
 * trait for custom constraint classes
 */

namespace Graviton\JsonSchemaBundle\Validator\Constraint;

use JsonSchema\Entity\JsonPointer;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author   List of contributors <https://github.com/libgraviton/graviton/graphs/contributors>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://swisscom.ch
 */
trait ConstraintTrait
{

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * sets the event dispatcher
     *
     * @param EventDispatcherInterface $dispatcher dispatcher
     *
     * @return void
     */
    public function setEventDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * checks the input
     *
     * @param mixed       $element           element
     * @param null        $definition        definition
     * @param JsonPointer $path              path
     * @param null        $additionalProp    added props
     * @param null        $patternProperties pattern props
     *
     * @return void
     */
    public function check(
        &$element,
        $definition = null,
        JsonPointer $path = null,
        $additionalProp = null,
        $patternProperties = null
    ) {
        $eventClass = $this->getEventClass();

        $event = new $eventClass($this->factory, $element, $definition, $path);
        $result = $this->dispatcher->dispatch($event::NAME, $event);

        $this->addErrors($result->getErrors());

        parent::check($element, $definition, $path, $additionalProp, $patternProperties);
    }

    /**
     * Returns the name of the Event class for this event
     *
     * @return string event class name
     */
    abstract public function getEventClass();

    /**
     * Adds errors
     *
     * @param array $errors errors
     *
     * @return void
     */
    abstract public function addErrors(array $errors);
}
