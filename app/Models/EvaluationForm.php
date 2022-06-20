<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationForm extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getDetail()
    {
        return $this->hasMany(EvaluationFormDetail::class, 'form_id');
    }
}
