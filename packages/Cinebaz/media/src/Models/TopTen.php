<?php

namespace Cinebaz\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopTen extends Model
{
    use HasFactory;
    protected $table = 'top_tens';
    protected $fillable = [
        'video_id',  'start_date', 'deadline', 'placement'
    ];
    public function media()
    {
        return $this->belongsTo(Media::class, 'video_id', 'id');
    }
}
