<?php

namespace Chunkwan\WorkflowReviser\Component;

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
                'Поле "%s" не может быть проверено на заполнение. Данное поле отсувствует. Проверте правило перехода "%s" в маршруте "%s"',
                $field,
                $this->event->getTransition()->getName(),
                $this->event->getWorkflow()->getName()
            )
        );

        return null;
    }
}
