<?php

namespace Chunkwan\WorkflowReviser\Component\TransitionRule\DateTime;

<<<<<<< HEAD:src/Component/TransitionRule/DateTime/DateTimeBefore.php
namespace Chunkwan\WorkflowReviser\Component\TransitionRule\DateTime;

=======
>>>>>>> 01bda66bcc6e2f87691c09d83b5b16ba3e80083c:src/Component/TransitionRule/DateTime/DateTimeBefore.php
use DateTimeInterface;
use Chunkwan\WorkflowReviser\Component\AbstractReviser;

class DateTimeBefore extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $condition) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                $checkProperty = $this->entity->$method();

                if ($checkProperty instanceof DateTimeInterface and $condition[0] instanceof DateTimeInterface) {
                    if ($checkProperty->getTimestamp() > $condition[0]->getTimestamp()) {
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
