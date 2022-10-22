<?php

namespace App\Jobs;

use App\Events\WorkFlowCompletedEvent;
use App\Events\WorkFlowFailedEvent;
use App\Events\WorkFlowSuccessEvent;
use App\Exceptions\WorkFlowException;
use App\WorkFlowActions\WorkFlowAction;
use App\WorkFlowEvent;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkFlowTestJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $action;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($action)
    {
        $this->action = $action;
        \Log::info('job construct');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $action = $this->action;
        try {
            $action->handle();
            if ($action->getIsLastStep()) {
                event(new WorkFlowCompletedEvent([
                    'workflow_uid' => $action->getWorkFlowUid(), 
                    'step' => $action->getStep() 
                ]));
            } else {
                event(new WorkFlowSuccessEvent([
                    'workflow_uid' => $action->getWorkFlowUid(),
                    'step' => $action->getStep(),
                    'to' => 'test@email.com'
                ]));
            }
        } catch (WorkFlowException $e) {
            \Log::info('catched');
            \Log::error($e->getMessage());
            event(new WorkFlowFailedEvent([
                'workflow_uid' => $action->getWorkFlowUid(),
                'step' => $action->getStep()
            ]));
        } catch (Exception $e) {
            \Log::error('other error');
        }
    }
}
