<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryGroup extends Model
{
    protected $fillable = ['title', 'description'];

    public function photos()
    {
        return $this->hasMany(GalleryPhoto::class);
    }
}
