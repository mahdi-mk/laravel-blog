<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class category extends Model
{

    use Sluggable;

    // Slug the name 
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $table = 'categories';

    protected $guarded = [];

    // Each category has many articles(many to many)
    public function articles(){
        return $this->belongsToMany(article::class);
    }
}
