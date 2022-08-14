<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Participant()
    {
        return $this->hasMany(Participant::class, 'school_id');
    }
}
