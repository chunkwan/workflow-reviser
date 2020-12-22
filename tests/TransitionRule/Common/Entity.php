<?php

namespace Reknil\WorkflowReviser\Tests\TransitionRule\Common;

class Entity
{
    private string $name;

    private ?string $secondName = null;

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getSecondName(): ?string
    {
        return $this->secondName;
    }

    /**
     * @param null|string $secondName
     */
    public function setSecondName(?string $secondName): void
    {
        $this->secondName = $secondName;
    }
}
