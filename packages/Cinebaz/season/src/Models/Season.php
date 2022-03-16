<?php

namespace Cinebaz\Season\Models;

use Cinebaz\Media\Models\Media;
use Cinebaz\Seo\Models\Seo;
use Cinebaz\Series\Models\Series;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'seasons';
    protected $fillable = [
        'series_id', 'title_bn', 'title_en', 'title_hn', 'slug', 'is_active', 'create_by', 'modified_by',

    ];
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }
    public function medias()
    {
        return $this->hasMany(Media::class, 'session_id', 'id');
    }
}
