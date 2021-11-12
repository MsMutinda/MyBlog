<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EditorMail extends Mailable
{
    use Queueable, SerializesModels;
    public $maildetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildetails)
    {
        $this->maildetails = $maildetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('A new blog is waiting for your review!')
                    ->markdown('mails.editor');
    }
}
