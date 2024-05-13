<?php

namespace App\Listeners;

use App\Models\AuditLog as Model;
use App\Events\AuditLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddAuditTrail
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
     * @param  \App\Providers\AuditLog  $event
     * @return void
     */
    public function handle(AuditLog $event)
    {
        $add_audit = new Model;
        $add_audit->fk_user = $event->fk_user;
        $add_audit->record_id = $event->record_id;
        $add_audit->Activities = $event->Activities;
        $add_audit->Old_value = $event->old_value;
        $add_audit->New_value = $event->new_value;
        $add_audit->save();
    }
}
