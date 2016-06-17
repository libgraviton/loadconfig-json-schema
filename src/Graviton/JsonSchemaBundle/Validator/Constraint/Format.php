<?php
/**
 * custom format constraint
 */

namespace Graviton\JsonSchemaBundle\Validator\Constraint;

use JsonSchema\Constraints\FormatConstraint;

/**
 * @author   List of contributors <https://github.com/libgraviton/graviton/graphs/contributors>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://swisscom.ch
 */
class Format extends FormatConstraint
{

    /**
     * class of the event
     *
     * @var string
     */
    protected $eventClass = 'Graviton\JsonSchemaBundle\Validator\Constraint\Event\ConstraintEventFormat';

    use ConstraintTrait;
}