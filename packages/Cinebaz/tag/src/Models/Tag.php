<?php

namespace Cinebaz\Tag\Models;

use Cinebaz\Season\Models\Season;
use Cinebaz\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tags';
    protected $fillable = [
        'title_bn', 'title_en', 'title_hn', 'slug', 'remarks', 'is_active', 'create_by', 'modified_by',

    ];
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
