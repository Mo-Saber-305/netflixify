<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    protected $appends = ['poster_path', 'image_path'];

    public function getPosterPathAttribute()
    {
        return Storage::url('images/' . $this->poster);
    }

    public function getImagePathAttribute()
    {
        return Storage::url('images/' . $this->image);
    }
}
