<?php

namespace ChunKwan\WorkflowReviser\Component\TransitionRule\Common;

use ChunKwan\WorkflowReviser\Component\AbstractReviser;

class PregMatch extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $condition) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                $checkProperty = $this->entity->$method();
                if (!\preg_match($condition[0], $checkProperty)) {
                    $this->event->setBlocked(true, $condition[1]);
                    continue;
                }
            }
        }
    }
}
