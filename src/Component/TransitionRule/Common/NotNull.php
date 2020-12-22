<?php
<<<<<<< HEAD:src/Component/TransitionRule/Common/NotNull.php
=======

>>>>>>> 01bda66bcc6e2f87691c09d83b5b16ba3e80083c:src/Component/TransitionRule/Common/NotNull.php
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
