<?php

namespace Cinebaz\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cinebaz\Media\Models\Media;
class Tranding extends Model
{
    use HasFactory;
    protected $table = 'trandings';
    protected $fillable = [
        'video_id',  'start_date', 'deadline', 'placement'
    ];
    public function media()
    {
        return $this->belongsTo(Media::class, 'video_id', 'id');
    }
    
    static function getSessions($id){
        return $getSessions = Media::where('series_id',$id)->get();
    }
   
}
