<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DefaultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $message;
    public $url = null;
    public $attachment = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $title,
        $message,
        $url = null,
        $attachment = null
    )
    {
        $this->title = $title;
        $this->message = $message;
        $this->url = $url;
        $this->attachment = $attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.default');
    }
}
