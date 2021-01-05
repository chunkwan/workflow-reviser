<?php

namespace ChunKwan\WorkflowReviser\Component\TransitionRule\Common;

use ChunKwan\WorkflowReviser\Component\AbstractReviser;

class TextContains extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $condition) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                $checkProperty = $this->entity->$method();
                if (false === \mb_strripos($checkProperty, $condition[0])) {
                    $this->event->setBlocked(true, $condition[1]);
                }
                continue;
            }
            $this->event->setBlocked(
                true,
                \sprintf(
                    'The field "%s" cannot be verified. Check transition rule "%s" in workflow "%s". Make sure the field have is text type!',
                    $field,
                    $this->event->getTransition()->getName(),
                    $this->event->getWorkflow()->getName()
                )
            );
        }
    }
}
