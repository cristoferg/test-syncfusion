<?php

namespace App\WorkFlowActions;

use App\Exceptions\WorkFlowException;
use Exception;

class SendEmail implements WorkFlowAction
{
    protected $to = '';
    protected $isLastStep = false;
    protected $workflow_uid;
    protected $step;

    public function __construct($params = [])
    {
        try {
            $this->workflow_uid = $params['workflow_uid'];
            $this->to = $params['to'];
            $this->step = $params['step'];
            $this->isLastStep = $params['isLastStep'] ?? false;
        } catch (Exception $e) {
            throw new WorkFlowException('To not provided - Action: SendEmail', $params);
        }
    }
    
    public function handle()
    {
        \Log::info('--- SendEmail: '. $this->to. ' ---');
        return $this->isLastStep;
    }

    public function getWorkFlowUid()
    {
        return $this->workflow_uid;
    }

    public function getStep()
    {
        return $this->step;
    }

    public function getIsLastStep()
    {
        return $this->isLastStep;
    }
}