<?php

namespace Chunkwan\WorkflowReviser\Tests\TransitionRule\CheckBox;


use phpDocumentor\Reflection\Types\Boolean;

class Entity
{
    private Bool $checkbox;


    /**
     * @return boolean
     */
    public function getCheckbox(): ?bool
    {
        return $this->checkbox;
    }

    /**
     * @param boolean $val
     */
    public function setCheckbox(?bool $val): void
    {
//        die('123- '.$val);
        $this->checkbox = $val;
    }
}
