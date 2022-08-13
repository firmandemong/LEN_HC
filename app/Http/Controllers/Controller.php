<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUser()
    {
        $profile = null;
        if (Auth::User()->role == 'Participant') {
            $profile = Participant::where('user_id', Auth::id())->first();
        } else if (Auth::User()->role == 'Mentor' || Auth::User()->role == 'HC') {
            $profile = Mentor::where('user_id', Auth::id())->first();
        }

        return $profile;
    }
}
