<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPaymentNotifier extends Mailable
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
        return $this->view('emails.payment_notifier') 
            ->with([
                'date_format' => $this->user->date_format,
                'payment_type' => $this->user->payment_type,
                'amount' => $this->user->amount,
                'settings' => $this->user->settings,
                'investment' => $this->user->investment,
                'userDetails' => $this->user,
            ]);
    }
}
