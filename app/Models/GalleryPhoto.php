<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    protected $fillable = ['gallery_group_id', 'image_path', 'caption'];

    public function group()
    {
        return $this->belongsTo(GalleryGroup::class, 'gallery_group_id');
    }
}
