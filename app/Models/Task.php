<?php

namespace App\Models;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getParticipant(){
        return $this->belongsTo(Participant::class,'participant_id');
    }
}
