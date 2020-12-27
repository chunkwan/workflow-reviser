<?php

namespace Chunkwan\WorkflowReviser\Tests\TransitionRule\CheckBox;

class Entity
{
    private bool $checkbox;

    /**
     * @return bool
     */
    public function getCheckbox(): ?bool
    {
        return $this->checkbox;
    }

    /**
     * @param bool $val
     */
    public function setCheckbox(?bool $val): void
    {
        $this->checkbox = $val;
    }
}
