<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTask extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static  function countTime($hour, $time)
    {
        $hourToMinute = $hour * 60;
        $totalMinute = $hourToMinute + $time;
        $hour = floor($totalMinute / 60);
        $minute = $totalMinute - ($hour * 60);
        return "$hour Jam $minute Menit";
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
