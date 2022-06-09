<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationFormDetail extends Model
{
    use HasFactory;

    public function getSubject()
    {
        return $this->belongsTo(EvaluationSubject::class, 'subject_id');
    }
}
