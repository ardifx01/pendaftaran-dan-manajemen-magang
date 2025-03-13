<?php 
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PermintaanMagang;

class StudentRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $permintaan;

    public function __construct(PermintaanMagang $permintaan)
    {
        $this->permintaan = $permintaan;
    }

    public function build()
    {
        return $this->view('emails.student_registration');
    }
}
