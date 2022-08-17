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

    public function getInstitute()
    {
        return $this->belongsTo(Institute::class, 'school_id');
    }

    public function getEvaluation()
    {
        return $this->hasOne(EvaluationForm::class, 'participant_id');
    }

    public function getCertificate()
    {
        return $this->hasOne(Certificate::class, 'participant_id');
    }

    public function getMajor()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function scopeActiveAndFinished($query)
    {
        return $query->where('status', 2)->orWhere('status', 4);
    }

    public function scopeFinished($query)
    {
        return $query->Where('status', 4);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 2);
    }

    public function scopeNotActive($query)
    {
        return $query->where('status', 0);
    }

    public static function getLabelStatus($status)
    {
        if ($status == 2) {
            return "<span class='badge badge-success'>Aktif</span>";
        } else if ($status == 4) {
            return "<span class='badge badge-danger'>Tidak Aktif</span>";
        }
    }
}
