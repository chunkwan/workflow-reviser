<?php

namespace ChunKwan\WorkflowReviser\Component\TransitionRule\Common;

use ChunKwan\WorkflowReviser\Tests\TransitionRule\Common\Entity;
use ChunKwan\WorkflowReviser\Tests\WorkflowEventTestCase;

class TextContainsTest extends WorkflowEventTestCase
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
            'name' => ['watc', 'Error'],
        ];
        $this->object->setName('big bro watching you');
        $event   = $this->getEvent($this->object);
        $notNull = new TextContains($event, $this->object, $validations);
        $notNull->lookup();
        $this->assertFalse($event->isBlocked());
    }

    public function testWithEmptyProperty()
    {
        $validations = [
            'name'       => ['brother', 'Error'],
        ];
        $this->object->setName('big bro watching you');
        $event   = $this->getEvent($this->object);
        $notNull = new TextContains($event, $this->object, $validations);
        $notNull->lookup();
        $blockers = $event->getTransitionBlockerList();
        $this->assertTrue($event->isBlocked());
        $this->assertEquals(1, $blockers->count());
        $this->assertStringContainsString('Error', $blockers->getIterator()->current()->getMessage());
    }
}
