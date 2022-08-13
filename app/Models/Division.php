<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getDivisionById($id)
    {
        $division = Division::find($id);
        $name = empty($division->id) ? '-' : $division->name;
        return $name;
    }

    public function getDetailQuota()
    {
        return $this->hasMany(DetailDivisionQuota::class, 'division_id');
    }
}
