<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminWithdrawalNotification extends Mailable
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
        return $this->view('emails.admin_withdrawal')
            ->with([
                'wallet_type' => $this->user->wallet_type,
                'user_wallet' => $this->user->user_wallet,
                'transactions' => $this->user->transactions,
                'settings' => $this->user->settings,
                'userDetails' => $this->user,
            ]);
    }
}
