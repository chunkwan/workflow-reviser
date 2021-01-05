<?php

namespace ChunKwan\WorkflowReviser\EventSubscriber;

use ChunKwan\WorkflowReviser\Component\ReviserInterface;
use ChunKwan\WorkflowReviser\Component\WorkflowReviser;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\GuardEvent;

class GuardReviserSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.guard' => ['guardReviser'],
        ];
    }

    public function guardReviser(GuardEvent $event): void
    {
        $transitions = $event->getMetadata(WorkflowReviser::class, $event->getTransition());
        if (!\is_array($transitions)) {
            return;
        }
        foreach ($transitions as $reviser => $validation) {
            /**
             * @var ReviserInterface $reviserInstance
             */
            $reviserInstance = new $reviser($event, $event->getSubject(), $validation);
            $reviserInstance->lookup();
        }
    }
}
