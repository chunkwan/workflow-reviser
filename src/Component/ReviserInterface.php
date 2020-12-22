<?php

namespace Chunkwan\WorkflowReviser\Component;

use Symfony\Component\Workflow\Event\GuardEvent;

interface ReviserInterface
{
    public function __construct(GuardEvent $event, object $entity, array $validations);

    public function lookup(): void;
}
