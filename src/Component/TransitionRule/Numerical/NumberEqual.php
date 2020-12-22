<?php

namespace Chunkwan\WorkflowReviser\Component\TransitionRule\Numerical;

use Chunkwan\WorkflowReviser\Component\AbstractReviser;

class NumberEqual extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $condition) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                $checkProperty = $this->entity->$method();

                if (\is_numeric($checkProperty)  and \is_numeric($condition[0])) {
                    if ($checkProperty !== $condition[0]) {
                        $this->event->setBlocked(true, $condition[1]);
                    }
                    continue;
                }
                $this->event->setBlocked(
                    true,
                    \sprintf(
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
