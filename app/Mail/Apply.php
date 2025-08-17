<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Apply extends Mailable
{
    use Queueable, SerializesModels;
    public $tables;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tables)
    {
        $this->tables = $tables;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->subject('Artmoto')
                     ->view('apply');
    }
}
