<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $input_content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from, $subject, $content)
    {
        $this->input_from = $from;
        $this->input_subject = $subject;
        $this->input_content = $content;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from($this->input_from, 'test' )
                ->subject($this->input_subject)
                ->view('emails.admin_email');
    }
}
