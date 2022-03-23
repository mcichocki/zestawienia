<?php

namespace App\Service;

use App\Entity\Formularz;
use LogicException;
use Symfony\Component\Workflow\WorkflowInterface;

class WorkflowService
{
    private $formularzStateMachine;

    public function __construct(WorkflowInterface $formularzStateMachine)
    {
        $this->formularzStateMachine = $formularzStateMachine;
    }


    public function workerToSupervisorToVerify(Formularz $formularz)
    {
        try {
            $this->formularzStateMachine->apply($formularz, 'worker_to_supervisor_to_verify');
        } catch (LogicException $exception) {
            // ...
        }
        // ...
    }
}