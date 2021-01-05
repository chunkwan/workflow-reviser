<?php

namespace ChunKwan\WorkflowReviser\Tests\TransitionRule\Numerical;

use ChunKwan\WorkflowReviser\Component\TransitionRule\Numerical\NumberEqual;
use ChunKwan\WorkflowReviser\Tests\WorkflowEventTestCase;

class NumberEqualTest extends WorkflowEventTestCase
{
    private Entity $object;

    protected function setUp(): void
    {
        parent::setUp();

        $this->object = new Entity();
    }

    public function testWithFilledProperty()
    {
        $validation = [
            'number' => [13, 'error'],
        ];
        $this->object->setNumber('13');
        $event   = $this->getEvent($this->object);
        $test    = new NumberEqual($event, $this->object, $validation);
        $test->lookup();
        $this->assertFalse($event->isBlocked());
    }

    public function testWithEmptyProperty()
    {
        $validation = [
            'number' => [13, 'Error'],
        ];
        $this->object->setNumber('19');
        $event   = $this->getEvent($this->object);
        $test    = new NumberEqual($event, $this->object, $validation);
        $test->lookup();
        $blockers = $event->getTransitionBlockerList();
        $this->assertTrue($event->isBlocked());
        $this->assertEquals(1, $blockers->count());
        $this->assertStringContainsString('Error', $blockers->getIterator()->current()->getMessage());
    }
}
