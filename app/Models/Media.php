<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $guarded = [];

    /** The path stored in an `image_url` column — resolved against the site root y   HasImageUrl. */
    public function path(): string
    {
        return '/media/'.$this->id;
    }




    
    public function bytes(): string
    {
        return base64_decode($this->data);
    }
}
