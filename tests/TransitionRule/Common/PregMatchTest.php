<?php

namespace ChunKwan\WorkflowReviser\Tests\TransitionRule\Countable;

use ChunKwan\WorkflowReviser\Component\TransitionRule\Common\PregMatch;
use ChunKwan\WorkflowReviser\Tests\TransitionRule\Common\Entity;
use ChunKwan\WorkflowReviser\Tests\WorkflowEventTestCase;

class PregMatchTest extends WorkflowEventTestCase
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
            'name' => ['/[0-9]+/', 'Error'],
        ];
        $this->object->setName('number - 13');
        $event   = $this->getEvent($this->object);
        $notNull = new PregMatch($event, $this->object, $validations);
        $notNull->lookup();
        $this->assertFalse($event->isBlocked());
    }

    public function testWithEmptyProperty()
    {
        $validations = [
            'name' => ['/[0-9]+/', 'Error'],
        ];
        $this->object->setName('number - null');
        $event   = $this->getEvent($this->object);
        $notNull = new PregMatch($event, $this->object, $validations);
        $notNull->lookup();
        $blockers = $event->getTransitionBlockerList();
        $this->assertTrue($event->isBlocked());
        //   $this->assertEquals(1, $blockers->count());
        $this->assertStringContainsString('Error', $blockers->getIterator()->current()->getMessage());
    }
}
