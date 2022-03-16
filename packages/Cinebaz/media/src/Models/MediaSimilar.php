<?php

namespace Cinebaz\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaSimilar extends Model
{
    use HasFactory;

    public function media()
    {
        return $this->belongsTo(Media::class, 'similar_id', 'id');
    }
 
    
}
 