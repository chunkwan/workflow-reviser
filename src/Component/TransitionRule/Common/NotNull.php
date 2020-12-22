<?php

namespace Chunkwan\WorkflowReviser\Component\TransitionRule\Common;

use Chunkwan\WorkflowReviser\Component\AbstractReviser;

class NotNull extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $message) {
            $method = $this->getMethod($field);

            if (null !== $method) {
                if (empty($this->entity->$method())) {
                    $this->event->setBlocked(true, $message);
                }
            }
        }
    }
}
