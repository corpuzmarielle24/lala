<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Signups extends Mailable
{
    use Queueable, SerializesModels;

    public $appointments;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointments)
    {
        $this->appointments = $appointments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PawMonitoring')
                    ->view('signups'); // Assuming your view file is in 'resources/views/emails/signup.blade.php'
    }
}

