<?php

namespace App\WorkFlowActions;

use App\Exceptions\WorkFlowException;
use Exception;

class StoreUrl implements WorkFlowAction
{
    protected $url = '';
    protected $isLastStep = false;
    protected $workflow_uid;
    protected $step;

    public function __construct($params = [])
    {
        \Log::info('Action construct');
        try {
            $this->workflow_uid = $params['workflow_uid'];
            $this->url = $params['url'];
            $this->step = $params['step'];
            $this->isLastStep = $params['isLastStep'] ?? false;
        } catch (Exception $e) {
            \Log::info('exception');
            throw new WorkFlowException('StoreUrl Action error, some params are missing', $params);
            \Log::info('throwed');
        }
        \Log::info('Successfully constructed action');
    }
    
    public function handle()
    {
        \Log::info('--- StoreUrl: '. $this->url);
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