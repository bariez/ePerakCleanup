<?php

namespace Workbench\Site\Handlers\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Workbench\Site\Events\SampleEvent;
use Workbench\Site\Http\Notifications\SampleMailer;

class SentEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentMade  $event
     * @return void
     */
    public function handle(SampleEvent $event)
    {
    }
}
