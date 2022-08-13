<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Mentor()
    {
        return $this->hasOne(Mentor::class, 'user_id');
    }

    public function Participant()
    {
        return $this->hasOne(Participant::class, 'user_id');
    }

    public function getUser()
    {
        $profile = null;
        if (Auth::User()->role == 'Participant') {
            $profile = Participant::where('user_id', Auth::id())->first();
        } else if (Auth::User()->role == 'Mentor' || Auth::User()->role == 'HC') {
            $profile = Mentor::where('user_id', Auth::id())->first();
        }

        return $profile;
    }
}
