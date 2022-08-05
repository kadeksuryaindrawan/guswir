<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNotification extends Mailable
{
    use Queueable, SerializesModels;
    protected $article;
    protected $status;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($article,$status)
    {
        $this->article = $article;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('kadeksuryaindrawan@gmail.com','Toko Komang Martini')
        ->subject($this->status)
        ->markdown('email.index')->with('article', $this->article);;
    }
}
