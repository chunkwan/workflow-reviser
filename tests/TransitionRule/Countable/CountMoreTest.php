<?php

namespace Reknil\WorkflowReviser\Tests\TransitionRule\Countable;

use Reknil\WorkflowReviser\Component\TransitionRule\Countable\CountMore;
use Reknil\WorkflowReviser\Tests\WorkflowEventTestCase;

class CountMoreTest extends WorkflowEventTestCase
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
            'albumsArrayCollection' => [2, 'Albums must be more then two'],
            'albumsArray'           => [2, 'Albums as Array must be  more then two'],
        ];
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->setAlbumsArray([1, 2, 3]);
        $event      = $this->getEvent($this->object);
        $countEqual = new CountMore($event, $this->object, $validations);
        $countEqual->lookup();
        $this->assertFalse($event->isBlocked());
    }

    public function testWithEmptyProperty()
    {
        $validations = [
            'albumsArrayCollection' => [2, 'Albums must be more then two'],
            'albumsArray'           => [2, 'Albums as Array must be  more then two'],
        ];
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->addAlbumsArrayCollection(new Entity());
        $this->object->setAlbumsArray([1, 2]);
        $event      = $this->getEvent($this->object);
        $countEqual = new CountMore($event, $this->object, $validations);
        $countEqual->lookup();
        $blockers = $event->getTransitionBlockerList();
        $this->assertTrue($event->isBlocked());
        $this->assertEquals(2, $blockers->count());
        $this->assertStringContainsString('Albums must be more then two', $blockers->getIterator()->offsetGet(0)->getMessage());
        $this->assertStringContainsString('Albums as Array must be  more then two', $blockers->getIterator()->offsetGet(1)->getMessage());
    }
}
