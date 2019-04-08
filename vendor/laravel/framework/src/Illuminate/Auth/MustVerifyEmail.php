<?php

namespace Illuminate\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Aktivasimentor;
use App\Tbmentor;

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
            return  !is_null(Aktivasimentor::where('idaktivasimentor', Auth::user()->idmentor)->value('tglAktivasi'));
        }
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {

        $tahun = Carbon::now()->isoFormat('YY');
        $bulan = Carbon::now()->format('m');
        $noidmentor = 'M' . $bulan . $tahun;
        if(strlen((string)Auth::user()->idmentor)==1){
            Aktivasimentor::where('idaktivasimentor', Auth::user()->idmentor)->update(['NoIDMentor' => $noidmentor.'0000'.Auth::user()->idmentor]);
            Tbmentor::where('idmentor', Auth::user()->idmentor)->update(['NoIDMentor' => $noidmentor.'0000'.Auth::user()->idmentor]);
        }else if(strlen((string)Auth::user()->idmentor)==2){
            Aktivasimentor::where('idaktivasimentor', Auth::user()->idmentor)->update(['NoIDMentor' => $noidmentor.'000'.Auth::user()->idmentor]);
            Tbmentor::where('idmentor', Auth::user()->idmentor)->update(['NoIDMentor' => $noidmentor.'000'.Auth::user()->idmentor]);
        }
        else if(strlen((string)Auth::user()->idmentor)==3){
            Aktivasimentor::where('idaktivasimentor', Auth::user()->idmentor)->update(['NoIDMentor' => $noidmentor.'00'.Auth::user()->idmentor]);
            Tbmentor::where('idmentor', Auth::user()->idmentor)->update(['NoIDMentor' => $noidmentor.'00'.Auth::user()->idmentor]);
        }
        else if(strlen((string)Auth::user()->idmentor)==4){
            Aktivasimentor::where('idaktivasimentor', Auth::user()->idmentor)->update(['NoIDMentor' => $noidmentor.'0'.Auth::user()->idmentor]);
            Tbmentor::where('idmentor', Auth::user()->idmentor)->update(['NoIDMentor' => $noidmentor.'0'.Auth::user()->idmentor]);
        }
        else {
            Aktivasimentor::where('idaktivasimentor', Auth::user()->idmentor)->update(['NoIDMentor' => $noidmentor.Auth::user()->idmentor]);
            Tbmentor::where('idmentor', Auth::user()->idmentor)->update(['NoIDMentor' => $noidmentor.Auth::user()->idmentor]);
        }

        Aktivasimentor::where('idaktivasimentor', Auth::user()->idmentor)->update(['tglAktivasi' => $this->freshTimestamp()]);
        Tbmentor::where('idmentor', Auth::user()->idmentor)->update(['statusAktivasi' => '1']);

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
