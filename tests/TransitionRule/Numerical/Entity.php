<?php

namespace ChunKwan\WorkflowReviser\Tests\TransitionRule\Numerical;

class Entity
{
    private int $number = 0;

    /**
     * @return null|int
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param null|int $number
     */
    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }
}
