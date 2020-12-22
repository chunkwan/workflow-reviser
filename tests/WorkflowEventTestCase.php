<?php

namespace Chunkwan\WorkflowReviser\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Workflow\Event\GuardEvent;
use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\WorkflowInterface;

class WorkflowEventTestCase extends TestCase
{
    private Marking $marking;

    private Transition $transition;

    private WorkflowInterface $workflow;

    private GuardEvent $event;

    protected function setUp(): void
    {
        parent::setUp();
        $this->marking    = $this->createMock(Marking::class);
        $this->transition = $this->createMock(Transition::class);
        $this->workflow   = $this->createMock(WorkflowInterface::class);
    }

    /**
     * @return Marking|\PHPUnit\Framework\MockObject\MockObject
     */
    public function getMarking()
    {
        return $this->marking;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|Transition
     */
    public function getTransition()
    {
        return $this->transition;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|WorkflowInterface
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

    /**
     * @param mixed $object
     *
     * @return GuardEvent
     */
    public function getEvent($object): GuardEvent
    {
        $this->event      = new GuardEvent(
            $object,
            $this->getMarking(),
            $this->getTransition(),
            $this->getWorkflow()
        );

        return $this->event;
    }
}
