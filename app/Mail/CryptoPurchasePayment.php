<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CryptoPurchasePayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('emails.crypto_purchase_payment') 
            ->with([
                'date_format' => $this->user->date_format,
                'settings' => $this->user->settings,
                'investment' => $this->user->investment,
                'userDetails' => $this->user,
            ]);
    }
}
