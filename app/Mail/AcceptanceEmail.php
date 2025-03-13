<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class AcceptanceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mahasiswaData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mahasiswaData)
    {
        $this->mahasiswaData = $mahasiswaData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.acceptance');
                    
    }
}
