<?php 

namespace App\WorkFlowActions;

interface WorkFlowAction {
 
    public function handle();

    public function getWorkFlowUid();

    public function getIsLastStep();

    public function getStep();
    
}