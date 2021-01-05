<?php

namespace ChunKwan\WorkflowReviser\Tests\TransitionRule\Date;

use ChunKwan\WorkflowReviser\Component\TransitionRule\Date\DateBefore;
use ChunKwan\WorkflowReviser\Component\TransitionRule\Date\DateEqual;
use ChunKwan\WorkflowReviser\Component\TransitionRule\Date\DateUntil;
use ChunKwan\WorkflowReviser\Tests\WorkflowEventTestCase;

class DateTest extends WorkflowEventTestCase
{
    private Entity $object;

    protected function setUp(): void
    {
        parent::setUp();

        $this->object = new Entity('2019-12-20');
    }

    public function testWithFilledProperty()
    {
        $testingDate                  = [
            DateBefore::class => new \DateTime('2019-12-24'),
            DateUntil::class  => new \DateTime('2019-12-18'),
            DateEqual::class  => new \DateTime('2019-12-20'),
        ];
        foreach ($testingDate as $key => $val) {
            $validation = [
                'dateTesting' => [$val, 'error'],
            ];
            $event                     = $this->getEvent($this->object);
            $test                      = new $key($event, $this->object, $validation);
            $test->lookup();
            $this->assertFalse($event->isBlocked());
        }
    }

    public function testWithEmptyProperty()
    {
        $testingDate                  = [
            DateBefore::class => new \DateTime('2019-12-16'),
            DateUntil::class  => new \DateTime('2019-12-24'),
            DateEqual::class  => new \DateTime('2019-12-21'),
        ];
        foreach ($testingDate as $key => $val) {
            $validation = [
                'dateTesting' => [$val, 'error'],
            ];
            $event                     = $this->getEvent($this->object);
            $test                      = new $key($event, $this->object, $validation);
            $test->lookup();
            $blockers = $event->getTransitionBlockerList();
            $this->assertTrue($event->isBlocked());
            $this->assertEquals(1, $blockers->count());
            $this->assertStringContainsString('error', $blockers->getIterator()->current()->getMessage());
        }
    }
}
