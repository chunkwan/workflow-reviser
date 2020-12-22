<?php

namespace Chunkwan\WorkflowReviser\Component\TransitionRule\CheckBox;

use Chunkwan\WorkflowReviser\Component\AbstractReviser;

class IsNotCheck extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $message) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                if (\is_bool($this->entity->$method())) {
                    if (!$this->entity->$method()) {
                        $this->event->setBlocked(true, $message);
                    }
                    continue;
                }
                $this->event->setBlocked(
                    true,
                    \sprintf(
                        'The field "%s" cannot be verified. Check transition rule "%s" in workflow "%s". Make sure the field is checkbox!',
                        $field,
                        $this->event->getTransition()->getName(),
                        $this->event->getWorkflow()->getName()
                    )
                );
            }
        }
    }
}
