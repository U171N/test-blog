<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthorEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $password;
    /**
     * Create a new message instance.
     */
    public function __construct($password)
    {
        $this->password = $password;

    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->from('your_email@example.com', 'Your Name') // Specify the sender email address and name
        ->subject('New Karyawan')
        ->view('emails.new_karyawan');
    }
}
