<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'post_image', 'user_id'];

    public $imagesDirectory = 'storage/';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->whereNull('parent_id');
    }

    public function getPostImageAttribute($image)
    {

        if(strpos($image, 'https://') !== FALSE || strpos($image, 'http://') !== FALSE)
        {
            return $image;
        }

        return asset('storage/' . $image);
    }
}
