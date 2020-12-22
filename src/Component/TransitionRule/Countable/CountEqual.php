<?php

namespace Chunkwan\WorkflowReviser\Component\TransitionRule\Countable;

<<<<<<< HEAD:src/Component/TransitionRule/Countable/CountEqual.php
namespace Chunkwan\WorkflowReviser\Component\TransitionRule\Countable;

=======
>>>>>>> 01bda66bcc6e2f87691c09d83b5b16ba3e80083c:src/Component/TransitionRule/Countable/CountEqual.php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Chunkwan\WorkflowReviser\Component\AbstractReviser;

class CountEqual extends AbstractReviser
{
    public function lookup(): void
    {
        foreach ($this->validations as $field => $condition) {
            $method = $this->getMethod($field);
            if (null !== $method) {
                $checkProperty = $this->entity->$method();

                if ($checkProperty instanceof PersistentCollection) {
                    if ($checkProperty->count() !== $condition[0]) {
                        $this->event->setBlocked(true, $condition[1]);
                    }
                    continue;
                }
                if ($checkProperty instanceof ArrayCollection) {
                    if ($checkProperty->count() !== $condition[0]) {
                        $this->event->setBlocked(true, $condition[1]);
                    }
                    continue;
                }
                if (\is_array($checkProperty)) {
                    if (\count($checkProperty) !== $condition[0]) {
                        $this->event->setBlocked(true, $condition[1]);
                    }
                    continue;
                }
                $this->event->setBlocked(
                    true,
<<<<<<< HEAD:src/Component/TransitionRule/Countable/CountEqual.php
                    sprintf(
=======
                    \sprintf(
>>>>>>> 01bda66bcc6e2f87691c09d83b5b16ba3e80083c:src/Component/TransitionRule/Countable/CountEqual.php
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
