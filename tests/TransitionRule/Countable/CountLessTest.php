<?php

namespace Reknil\WorkflowReviser\Tests\TransitionRule\Countable;

use Reknil\WorkflowReviser\Component\TransitionRule\Countable\CountLess;
use Reknil\WorkflowReviser\Tests\WorkflowEventTestCase;

class CountLessTest extends WorkflowEventTestCase
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
            'albumsArrayCollection' => [2, 'Albums must be less two'],
            'albumsArray'           => [2, 'Albums as Array must be less two'],
        ];
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->setAlbumsArray([1]);
        $event      = $this->getEvent($this->object);
        $countEqual = new CountLess($event, $this->object, $validations);
        $countEqual->lookup();
        $this->assertFalse($event->isBlocked());
    }

    public function testWithEmptyProperty()
    {
        $validations = [
            'albumsArrayCollection' => [2, 'Albums must be less two'],
            'albumsArray'           => [2, 'Albums as Array must be less two'],
        ];
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->setAlbumsArray([1, 2]);
        $event      = $this->getEvent($this->object);
        $countEqual = new CountLess($event, $this->object, $validations);
        $countEqual->lookup();
        $blockers = $event->getTransitionBlockerList();
        $this->assertTrue($event->isBlocked());
        $this->assertEquals(2, $blockers->count());
        $this->assertStringContainsString('Albums must be less two', $blockers->getIterator()->offsetGet(0)->getMessage());
        $this->assertStringContainsString('Albums as Array must be less two', $blockers->getIterator()->offsetGet(1)->getMessage());
    }
}
