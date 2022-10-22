<?php

namespace App\Http\Controllers;

use App\Events\UrlReachedEvent;
use Illuminate\Http\Request;

class TestWorkFlowController extends Controller
{
    public function index()
    {
        $params = [
            'url' => request()->url()
        ];
        \Log::info('Sending Event');
        event(new UrlReachedEvent($params));
        \Log::info('After Sending Event');
        return 'Finished request';
    }
}
