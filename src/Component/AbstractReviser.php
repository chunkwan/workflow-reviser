<?php

namespace ChunKwan\WorkflowReviser\Component;

use Symfony\Component\Workflow\Event\GuardEvent;

abstract class AbstractReviser implements ReviserInterface
{
    protected GuardEvent $event;

    protected object $entity;

    protected array $validations;

    /**
     * AbstractReviser constructor.
     *
     * @param GuardEvent $event
     * @param object     $entity
     * @param array      $validations
     */
    public function __construct(GuardEvent $event, object $entity, array $validations)
    {
        $this->event       = $event;
        $this->validations = $validations;
        $this->entity      = $entity;
    }

    /**
     * @param string $field
     *
     * @return null|string
     */
    protected function getMethod(string $field): ?string
    {
        $method = 'get' . \ucfirst($field);

        if (\method_exists($this->entity, $method)) {
            return $method;
        }
        $this->event->setBlocked(
            true,
            \sprintf(
                'Field "%s" can\t be check. Filed not found. Check transition rule "%s" in "%s" workflow',
                $field,
                $this->event->getTransition()->getName(),
                $this->event->getWorkflow()->getName()
            )
        );

        return null;
    }
}
