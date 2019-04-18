<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;
    use Sluggable;

    // Slug user name
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'bio', 'avatar', 'lives_in', 'from', 'works_at', 'studied_at', 'website'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * All posts
     */
    public function posts(){
        return $this->hasMany(article::class, 'owner_id', 'id');
    }
}
