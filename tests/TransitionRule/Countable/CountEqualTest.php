<?php

namespace ChunKwan\WorkflowReviser\Tests\TransitionRule\Countable;

use ChunKwan\WorkflowReviser\Component\TransitionRule\Countable\CountEqual;
use ChunKwan\WorkflowReviser\Tests\WorkflowEventTestCase;

class CountEqualTest extends WorkflowEventTestCase
{
    private Entity $object;

    protected function setUp(): void
    {
        parent::setUp();

        $this->object = new Entity();
    }

    public function testWithFilledProperty()
    {
        $validations = [
            'albumsArrayCollection' => [2, 'Albums must be two'],
            'albumsArray'           => [2, 'Albums as Array must be two'],
        ];
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->setAlbumsArray([1, 2]);
        $event      = $this->getEvent($this->object);
        $countEqual = new CountEqual($event, $this->object, $validations);
        $countEqual->lookup();
        $this->assertFalse($event->isBlocked());
    }

    public function testWithEmptyProperty()
    {
        $validations = [
            'albumsArrayCollection' => [1, 'Albums must be one'],
            'albumsArray'           => [2, 'Albums as Array must be two'],
        ];
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->setAlbumsArray([1, 2]);
        $event      = $this->getEvent($this->object);
        $countEqual = new CountEqual($event, $this->object, $validations);
        $countEqual->lookup();
        $blockers = $event->getTransitionBlockerList();
        $this->assertTrue($event->isBlocked());
        $this->assertEquals(1, $blockers->count());
        $this->assertStringContainsString('Albums must be one', $blockers->getIterator()->current()->getMessage());
    }
}
