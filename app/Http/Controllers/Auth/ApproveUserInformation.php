<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveUserInformation extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $user;

    public $dataemail;

    // hello    
    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $plainPassword
     */
    public function __construct($dataemail)
    {
        $this->dataemail = $dataemail;

        if ($dataemail['status'] == 'BLOCKED') {
            $subjek = 'Permohonan Penggunaan Sistem e-Perak Tidak Diluluskan';
        } else {
            $subjek = 'Permohonan Penggunaan Sistem e-Perak Telah Diluluskan';
        }

        $this->subject($subjek);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site::email.emailuser');
    }
}
