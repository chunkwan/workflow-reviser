<?php

namespace Chunkwan\WorkflowReviser\Tests\TransitionRule\DateTime;

class Entity
{
    public \DateTime $dateTesting;

    public function __construct($date)
    {
        $this->dateTesting = new \DateTime($date);
    }

    /**
     * @return DateTime
     */
    public function getDateTesting(): \DateTime
    {
        return $this->dateTesting;
    }
}
