<?php

namespace ChunKwan\WorkflowReviser\Tests\TransitionRule\CheckBox;

use ChunKwan\WorkflowReviser\Component\TransitionRule\CheckBox\IsCheck;
use ChunKwan\WorkflowReviser\Tests\WorkflowEventTestCase;

class IsCheckTest extends WorkflowEventTestCase
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
            'checkbox' => 'checkbox must be checked',
        ];
        $this->object->setCheckbox(true);
        $event = $this->getEvent($this->object);
        $check = new IsCheck($event, $this->object, $validations);
        $check->lookup();
        $this->assertFalse($event->isBlocked());
    }

    public function testWithEmptyProperty()
    {
        $validations = [
            'checkbox' => 'checkbox must be checked',
        ];
        $this->object->setCheckbox(false);
        $event   = $this->getEvent($this->object);
        $check   = new IsCheck($event, $this->object, $validations);
        $check->lookup();
        $blockers = $event->getTransitionBlockerList();
        $this->assertTrue($event->isBlocked());
        $this->assertEquals(1, $blockers->count());
        $this->assertStringContainsString('checkbox must be checked', $blockers->getIterator()->current()->getMessage());
    }
}
