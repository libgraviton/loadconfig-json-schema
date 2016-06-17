<?php
/**
 * trait for custom constraint classes
 */

namespace Graviton\JsonSchemaBundle\Validator\Constraint;

use JsonSchema\Constraints\Factory as CustomFactory;
use JsonSchema\Uri\UriRetriever;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author   List of contributors <https://github.com/libgraviton/graviton/graphs/contributors>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://swisscom.ch
 */
trait ConstraintTrait
{

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var CustomFactory
     */
    private $factory;

    /**
     * Format constructor.
     *
     * @param int                $checkMode    check mode
     * @param UriRetriever|null  $uriRetriever uri retriever
     * @param CustomFactory|null $factory      factory
     */
    public function __construct(
        $checkMode = self::CHECK_MODE_NORMAL,
        UriRetriever $uriRetriever = null,
        CustomFactory $factory = null
    ) {
        parent::__construct($checkMode, $uriRetriever, $factory);
        $this->factory = $factory;
    }

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
     * @param mixed $element element
     * @param null  $schema  schema
     * @param null  $path    path
     * @param null  $i       iterator value
     *
     * @return void
     */
    public function check($element, $schema = null, $path = null, $i = null)
    {
        parent::check($element, $schema, $path, $i);

        $event = new $this->eventClass($this->factory, $element, $schema, $path);
        $result = $this->dispatcher->dispatch($event::NAME, $event);

        $this->addErrors($result->getErrors());
    }
}
