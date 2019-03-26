<?php

namespace Illuminate\Auth;

use Illuminate\Support\Facades\Auth;
use App\Aktivasimentor;

trait MustVerifyEmail
{
    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        // return ! is_null($this->email_verified_at);
        if (Auth::check()) {
            return  !is_null(Aktivasimentor::where('id', Auth::user()->id)->value('tglAktivasi'));
        }
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {

        Aktivasimentor::where('id', Auth::user()->id)->update(['tglAktivasi' => $this->freshTimestamp()]);

        // return $this->forceFill([
        //     'statusAktivasi' => '1',
        // ])->save();
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new Notifications\VerifyEmail);
    }
}
