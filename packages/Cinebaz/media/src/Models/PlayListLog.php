<?php

namespace Cinebaz\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayListLog extends Model
{
    use HasFactory;
    protected $fillable = ['video_id' , 'member_id' , 'ip' , 'session_id' , 'pre_time' ,'last_watchtime'];
    protected $table = 'play_list_logs';
    public function media()
    {
        return $this->belongsTo(Media::class, 'video_id', 'id');
    }
    static function mediaSimilar($media_id){
        return MediaSimilar::where('media_id',$media_id)->get();
    }
    static function SimilarMedia($media_id){
        return Media::where('id',$media_id)->first();
    }
    
}
