<?php

namespace ChunKwan\WorkflowReviser\Component\TransitionRule\DateTime;

use ChunKwan\WorkflowReviser\Component\AbstractReviser;
use DateTimeInterface;

class DateTimeEqual extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $condition) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                $checkProperty = $this->entity->$method();

                if ($checkProperty instanceof DateTimeInterface and $condition[0] instanceof DateTimeInterface) {
                    if ($checkProperty->getTimestamp() !== $condition[0]->getTimestamp()) {
                        $this->event->setBlocked(true, $condition[1]);
                    }
                    continue;
                }
                $this->event->setBlocked(
                    true,
                    \sprintf(
                        'The field "%s" cannot be verified. Check transition rule "%s" in workflow "%s". Make sure the field is DateTimeInterface!',
                        $field,
                        $this->event->getTransition()->getName(),
                        $this->event->getWorkflow()->getName()
                    )
                );
            }
        }
    }
}
