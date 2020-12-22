<?php

<<<<<<< HEAD

namespace Chunkwan\WorkflowReviser\Component\TransitionRule\Numerical;

use DateTimeInterface;
=======
namespace Chunkwan\WorkflowReviser\Component\TransitionRule\Numerical;

>>>>>>> 01bda66bcc6e2f87691c09d83b5b16ba3e80083c
use Chunkwan\WorkflowReviser\Component\AbstractReviser;

class NumberEqual extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $condition) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                $checkProperty = $this->entity->$method();

<<<<<<< HEAD
                if (is_numeric($checkProperty)  and is_numeric($condition[0])) {
=======
                if (\is_numeric($checkProperty)  and \is_numeric($condition[0])) {
>>>>>>> 01bda66bcc6e2f87691c09d83b5b16ba3e80083c
                    if ($checkProperty !== $condition[0]) {
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
                        'The field "%s" cannot be verified. Check transition rule "%s" in workflow "%s". Make sure the field is Numeric!',
                        $field,
                        $this->event->getTransition()->getName(),
                        $this->event->getWorkflow()->getName()
                    )
                );
            }
        }
    }
}
