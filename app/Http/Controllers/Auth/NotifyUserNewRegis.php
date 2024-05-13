<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyUserNewRegis extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $user;

    public $dataemail;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $plainPassword
     */
    public function __construct($dataemail)
    {
        $this->dataemail = $dataemail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pendaftaran Baru Pengguna Sistem e-Perak')
                    ->view('site::email.emailnotifyuser');
    }
}
