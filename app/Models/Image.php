<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['avatar'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getAvatarAttribute($image)
    {

        if(strpos($image, 'https://') !== FALSE || strpos($image, 'http://') !== FALSE)
        {
            return $image;
        }

        return asset('storage/' . $image);
    }
}
