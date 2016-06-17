<?php
/**
 * custom object constraint
 */

namespace Graviton\JsonSchemaBundle\Validator\Constraint;

use JsonSchema\Constraints\ObjectConstraint;

/**
 * @author   List of contributors <https://github.com/libgraviton/graviton/graphs/contributors>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://swisscom.ch
 */
class Object extends ObjectConstraint
{

    /**
     * class of the event
     *
     * @var string
     */
    protected $eventClass = 'Graviton\JsonSchemaBundle\Validator\Constraint\Event\ConstraintEventObject';

    use ConstraintTrait;
}
