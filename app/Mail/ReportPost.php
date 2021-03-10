<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportPost extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $email;
    public $reason;

    /**
     * Create a new message instance.
     * @param \App\Post $post
     * @param string $email
     * @param string $reason
     * @return void
     */
    public function __construct(\App\Post $post, $email, $reason)
    {
        $this->post = $post;
        $this->email = $email;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.post.report')->subject('Gemeldeter Beitrag / Muko Freundschaftslauf');
    }
}
