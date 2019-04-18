<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class article extends Model
{
    use Sluggable; // Slug packge

    // Slug the title of the article to use it in URLs
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $guarded = [];

    // Each article has one owner(one to one)
    public function owner(){
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    // Each article has many categories(many to many)
    public function categories(){
        return $this->belongsToMany(category::class);
    }
}
