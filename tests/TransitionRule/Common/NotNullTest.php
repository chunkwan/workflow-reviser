<?php

namespace ChunKwan\WorkflowReviser\Tests\TransitionRule\Common;

use ChunKwan\WorkflowReviser\Component\TransitionRule\Common\NotNull;
use ChunKwan\WorkflowReviser\Tests\WorkflowEventTestCase;

class NotNullTest extends WorkflowEventTestCase
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
            'name' => 'Имя can\'t be empty',
        ];
        $this->object->setName('Hello');
        $event = $this->getEvent($this->object);

        $notNull = new NotNull($event, $this->object, $validations);
        $notNull->lookup();
        $this->assertFalse($event->isBlocked());
    }

    public function testWithEmptyProperty()
    {
        $validations = [
            'name'       => 'Name can\'t be empty',
            'secondName' => 'Second Name can\'t be empty',
        ];
        $this->object->setName('Hello');
        $event   = $this->getEvent($this->object);
        $notNull = new NotNull($event, $this->object, $validations);
        $notNull->lookup();
        $blockers = $event->getTransitionBlockerList();
        $this->assertTrue($event->isBlocked());
        $this->assertEquals(1, $blockers->count());
        $this->assertStringContainsString('Second Name can\'t be empty', $blockers->getIterator()->current()->getMessage());
    }
}
