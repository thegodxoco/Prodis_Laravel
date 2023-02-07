<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferUnSubscription extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $offer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $offer)
    {
        $this->user = $user;
        $this->offer = $offer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.unsubscription')->subject('Un voluntari menys');
    }
}
