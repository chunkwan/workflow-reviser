<?php

<<<<<<< HEAD

=======
>>>>>>> 01bda66bcc6e2f87691c09d83b5b16ba3e80083c
namespace Chunkwan\WorkflowReviser\Component\TransitionRule\Date;

use DateTimeInterface;
use Chunkwan\WorkflowReviser\Component\AbstractReviser;

class DateEqual extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $condition) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                $checkProperty = $this->entity->$method();

                if ($checkProperty instanceof DateTimeInterface and $condition[0] instanceof DateTimeInterface) {
<<<<<<< HEAD
                    if ($checkProperty != $condition[0]) {
=======
                    if ($checkProperty !== $condition[0]) {
>>>>>>> 01bda66bcc6e2f87691c09d83b5b16ba3e80083c
                        $this->event->setBlocked(true, $condition[1]);
                    }
                    continue;
                }
                $this->event->setBlocked(
                    true,
<<<<<<< HEAD
                    sprintf(
=======
                    \sprintf(
>>>>>>> 01bda66bcc6e2f87691c09d83b5b16ba3e80083c
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
