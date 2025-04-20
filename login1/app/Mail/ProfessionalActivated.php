<?php
namespace App\Mail;

use App\Models\Professional;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfessionalActivated extends Mailable
{
    use Queueable, SerializesModels;

    public $professional;

    public function __construct(Professional $professional)
    {
        $this->professional = $professional;
    }

    public function build()
    {
        return $this->subject('Your Account Has Been Activated')
                    ->view('emails.professionalActivated');
    }
}
