<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getclockinAttribute($date)
    {
        return Carbon::createFromFormat('H:i:s', $date)->format('H:i');
    }

    public function getclockoutAttribute($date)
    {
        if(!empty($date)){
            return Carbon::createFromFormat('H:i:s', $date)->format('H:i');
        }
       
    }
}
