<?php

namespace App\Models;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getParticipant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public static function getStatusLabel($status)
    {
        if ($status == 0) {
            return "<span class='badge badge-warning'>Not Submitted</span>";
        } else if ($status == 1) {
            return "<span class='badge badge-primary'>Pending</span>";
        } else if ($status == 2) {
            return "<span class='badge badge-success'>Finished</span>";
        } else if ($status == 3) {
            return "<span class='badge badge-danger'>Rejected</span>";
        }
    }

    public function scopeNotSubmitted($query)
    {
        return $query->where('status', 0);
    }

    public function getFileSubmission()
    {
        return $this->hasOne(TaskFileSubmission::class, 'task_id');
    }
}
