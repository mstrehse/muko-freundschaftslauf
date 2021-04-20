<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportPost extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $post;
    public $email;
    public $reason;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $reason
     *
     * @return void
     */
    public function __construct(Post $post, $email, $reason)
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
