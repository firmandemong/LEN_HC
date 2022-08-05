<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendInterviewSchedule extends Mailable
{
    use Queueable, SerializesModels;
    public $interviewDate,$interviewTime,$interviewType,$interviewPlace,$role,$name, $divisi;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($interviewDate,$interviewTime,$interviewType,$interviewPlace,$role,$name, $divisi)
    {
        $this->interviewDate = $interviewDate;
        $this->interviewTime = $interviewTime;
        $this->interviewType = $interviewType;
        $this->interviewPlace = $interviewPlace;
        $this->role = $role;
        $this->name = $name;
        $this->divisi = $divisi;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Email From LEN')->view('layout.sendSchedule');
    }
}
