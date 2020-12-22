<?php

namespace Reknil\WorkflowReviser\Tests\TransitionRule\Countable;

use Doctrine\Common\Collections\ArrayCollection;

class Entity
{
    private ArrayCollection $albumsArrayCollection;

    private array $albumsArray;

    /**
     * Entity constructor.
     */
    public function __construct(

    ) {
        $this->albumsArrayCollection = new ArrayCollection();
        $this->albumsArray           = [];
    }

    /**
     * @return ArrayCollection
     */
    public function getAlbumsArrayCollection(): ArrayCollection
    {
        return $this->albumsArrayCollection;
    }

    /**
     * @param Entity $entity
     */
    public function addAlbumsArrayCollection(self $entity): void
    {
        $this->albumsArrayCollection->add($entity);
    }

    /**
     * @return array
     */
    public function getAlbumsArray(): array
    {
        return $this->albumsArray;
    }

    /**
     * @param array $albumsArray
     */
    public function setAlbumsArray(array $albumsArray): void
    {
        $this->albumsArray = $albumsArray;
    }
}
