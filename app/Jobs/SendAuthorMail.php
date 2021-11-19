<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\AuthorMail;
use Mail;


class SendAuthorMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $maildetails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($maildetails)
    {
        $this->maildetails = $maildetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new AuthorMail($this->maildetails);
        Mail::to('aluvia.guran@gmail.com')->send($email);
    }
}
