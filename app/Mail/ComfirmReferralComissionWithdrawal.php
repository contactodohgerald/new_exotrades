<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComfirmReferralComissionWithdrawal extends Mailable
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
        return $this->view('emails.confirm_referral_withdrawal') 
            ->with([
                'ref_comission' => $this->user->ref_comission,
                'settings' => $this->user->settings,
                'userDetails' => $this->user,
            ]);
    }
}
