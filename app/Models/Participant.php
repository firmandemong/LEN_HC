<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    public function Division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function Mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
