<?php

namespace Workbench\Site\Events;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailEvent extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public $activitylist;

    public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $activitylist, $id)
    {
        //get data here to use below
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Makluman Kemaskini Aktiviti Semakan HR')
            ->cc('elatihan.ppj@outlook.com')
            ->bcc(env('EMAIL_CC'))
            ->markdown('site::emails.default');
    }
}
