<?php

namespace ChunKwan\WorkflowReviser\Tests\TransitionRule\CheckBox;

use ChunKwan\WorkflowReviser\Component\TransitionRule\CheckBox\IsNotCheck;
use ChunKwan\WorkflowReviser\Tests\WorkflowEventTestCase;

class IsNotCheckTest extends WorkflowEventTestCase
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
        $this->object->setCheckbox(false);
        $event = $this->getEvent($this->object);

        $notCheck = new IsNotCheck($event, $this->object, $validations);
        $notCheck->lookup();
        $this->assertFalse($event->isBlocked());
    }

    public function testWithEmptyProperty()
    {
        $validations = [
            'checkbox' => 'Checkbox can\'t be checked',
        ];
        $this->object->setCheckbox(true);
        $event    = $this->getEvent($this->object);
        $notCheck = new IsNotCheck($event, $this->object, $validations);
        $notCheck->lookup();
        $blockers = $event->getTransitionBlockerList();
        $this->assertTrue($event->isBlocked());
        $this->assertEquals(1, $blockers->count());
        $this->assertStringContainsString('Checkbox can\'t be checked', $blockers->getIterator()->current()->getMessage());
    }
}
