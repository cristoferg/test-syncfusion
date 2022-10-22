<?php

namespace App\Listeners;

use App\Events\UrlReachedEvent;
use App\Events\WorkFlowCompletedEvent;
use App\Events\WorkFlowFailedEvent;
use App\Events\WorkFlowSuccessEvent;
use App\Exceptions\WorkFlowException;
use App\Interfaces\WorkFlowEvent;
use App\Jobs\WorkFlowTestJob;
use App\WorkFlowEvent as AppWorkFlowEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkFlowEventListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $workFlowEvent;

    public function __construct()
    {
        \Log::info('construct event listener');
    }

    /**
     * Handle the event.
     *
     * @param  WorkFlowEvent  $event
     * @return void
     */
    public function handle(WorkFlowEvent $event)
    {
        // This comes from the db given the instance of the event received $query->where('event', $event->class);
        $workflowConfiguration = [
            'event' => 'UrlReachedEvent',
            'actions' => [
                [
                    'model' => 'App\WorkFlowActions\StoreUrl',
                    'options' => [
                        'url' => null,
                    ]
                ],
                [
                    'model' => 'App\WorkFlowActions\SendEmail',
                    'options' => [
                        'to' => 'test@email.com'
                    ]
                ]
            ],
        ];
        $workFlowEvent = $this->storeOrRetrieveEvent($event);
        $this->workFlowEvent = $workFlowEvent;
        if ($event instanceof WorkFlowSuccessEvent) {
            $this->nextStep($event, $workflowConfiguration);
        } else if ($event instanceof WorkFlowCompletedEvent) {
            $this->completeWorkFlow($event);
        } else if ($event instanceof WorkFlowFailedEvent) {
            $this->failedStep($event);
        } else {
            $this->startWorkFlow($event, $workflowConfiguration);
        }
        
    }

    public function storeOrRetrieveEvent($event) {
        $workFlowEvent = (isset($event->workflow_uid) && $event->workflow_uid) ? AppWorkFlowEvent::where('uid', $event->workflow_uid)->first() : new AppWorkFlowEvent();
        if ($workFlowEvent->id) {
            return $workFlowEvent;
        }
        $workFlowEvent->uid = str_random();
        $workFlowEvent->name = get_class($event);
        //$workFlowEvent->options = $event->parameters;
        $workFlowEvent->save();
        return $workFlowEvent;
    }

    public function startWorkFlow($event, $workflow)
    {
        try {
            \Log::info('-- Start Processing Workflow Step: '. $this->workFlowEvent->uid);
            $options = $workflow['actions'][0]['options'] ?? [];
            $steps = count($workflow['actions']) - 1;
            $params = $this->getParams($event, $options, $steps);
            $actionClass = $workflow['actions'][0]['model'];
            \Log::info($actionClass);
            $action = new $actionClass($params);
            dispatch(new WorkFlowTestJob($action));
        } catch (WorkFlowException $e) {
            $this->failedStep($event);
        }
    }

    public function nextStep($event, $workflow) {
        try {
            \Log::info('-- Next Step: '. $this->workFlowEvent->uid);
            $options = $workflow['actions'][$event->step]['options'] ?? [];
            $steps = count($workflow['actions']) - 1;
            $params = $this->getParams($event, $options, $steps);
            $action = new $workflow['actions'][$event->step]['model']($params);
            dispatch(new WorkFlowTestJob($action));
        } catch (WorkFlowException $e) {
            $this->failedStep($event);
        }
    }

    public function completeWorkFlow($event) {
        \Log::info('--- Complete Workflow ' . $this->workFlowEvent->uid . '---');
    }

    public function failedStep($event) {
        \Log::info('--- Failed Workflow ' . $this->workFlowEvent->uid . '---');
    }

    public function getParams($event, $options, $steps) {
        $intersect = array_intersect_key($event->parameters, $options);
        $intersect['isLastStep'] = $event->step == $steps;
        $intersect['step'] = $event->step + 1;
        $intersect['workflow_uid'] = $this->workFlowEvent->uid;
        return $intersect;
    }
}
