<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role', 'login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'totalScores' => 'array',
        'q1' => 'array',
        'q2' => 'array',
        'q3' => 'array',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function emailApprovedStatus() {
        if (empty($this->email_verified_at)) {
            return '<i class="fa fa-times" style="color:red" aria-hidden="true"></i>';
        } else {
            return '<i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>';
        }

    }
}
