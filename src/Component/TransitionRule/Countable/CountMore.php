<?php

namespace ChunKwan\WorkflowReviser\Component\TransitionRule\Countable;

use ChunKwan\WorkflowReviser\Component\AbstractReviser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class CountMore extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $condition) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                $checkProperty = $this->entity->$method();

                if ($checkProperty instanceof PersistentCollection) {
                    if ($checkProperty->count() <= $condition[0]) {
                        $this->event->setBlocked(true, $condition[1]);
                    }
                    continue;
                }

                if ($checkProperty instanceof ArrayCollection) {
                    if ($checkProperty->count() <= $condition[0]) {
                        $this->event->setBlocked(true, $condition[1]);
                    }
                    continue;
                }

                if (\is_array($checkProperty)) {
                    if (\count($checkProperty) <= $condition[0]) {
                        $this->event->setBlocked(true, $condition[1]);
                    }
                    continue;
                }
                $this->event->setBlocked(
                    true,
                    \sprintf(
                        'The field "%s" cannot be verified. Check transition rule "%s" in workflow "%s". Make sure the field is PersistentCollection/ArrayCollection/Array type!',
                        $field,
                        $this->event->getTransition()->getName(),
                        $this->event->getWorkflow()->getName()
                    )
                );
            }
        }
    }
}
