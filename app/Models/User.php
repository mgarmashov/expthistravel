<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification as ResetPasswordNotification;

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
        'name', 'email', 'password', 'phone', 'role', 'login',
        'q_who_travels', 'q_how_many_adults', 'q_how_many_child', 'q_how_many_age', 'q_travel_style', 'q_how_long', 'q_preferred_sight'
    ];
    public $timestamps = true;

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
        'q_countries' => 'array',
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

    public function name()
    {
        $output = '';
        if ($this->name) {
            $output .= $this->name;
        }
        if ($this->surname) {
            $output .= $this->surname;
        }

        return $output;
    }

    public function scores()
    {
        if(!$this->totalScores) return null;
        $outputScores = collect();

        foreach ($this->totalScores as $id => $score) {
            $outputScores[$id] = [
                'name' => config('categories')[$id]['name'],
                'score' => $score
            ];
        }
        $outputScores = $outputScores->sortBy('score')->reverse();

        $top = (int) $outputScores->max('score');

//        $top = $outputScores->sum('score');

        $outputScores = $outputScores->map(function($item, $key) use ($top) {
            $item['percent'] = round($item['score'] / $top *100);
            return $item;
        });

        return $outputScores;
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'users_products', 'user_id', 'product_id')
            ->withPivot('status')->withTimestamps();
    }
}
