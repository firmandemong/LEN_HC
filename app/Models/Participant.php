<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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

    public function getInstitute(){
        return $this->belongsTo(Institute::class,'school_id');
    }

    public function getEvaluation(){
        return $this->belongsTo(EvaluationForm::class,'participant_id');
    }

    public function getMajor(){
        return $this->belongsTo(Major::class,'major_id');
    }

    public function scopeActive($query){
        return $query->where('status',1);
    }

    public function scopeNotActive($query){
        return $query->where('status',0);
    }
}
