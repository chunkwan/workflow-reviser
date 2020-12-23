<?php

namespace Chunkwan\WorkflowReviser\Component\TransitionRule\Date;

use Chunkwan\WorkflowReviser\Component\AbstractReviser;
use DateTimeInterface;

class DateUntil extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $condition) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                $checkProperty = $this->entity->$method();

                if ($checkProperty instanceof DateTimeInterface and $condition[0] instanceof DateTimeInterface) {
                    if ($checkProperty > $condition[0]) {
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
