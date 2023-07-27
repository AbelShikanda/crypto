<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEncryptionKeyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customEncryptionKey;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customEncryptionKey)
    {
        $this->customEncryptionKey = $customEncryptionKey;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.custom_encryption_key');
    }
}
