<?php

namespace Cinebaz\Page\Models;

use Cinebaz\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    protected $table = 'pages';
    protected $fillable = [
        'title_en', 'title_bn', 'title_hn', 'sub_title_en', 'sub_title_bn', 'sub_title_hn',
        'slug', 'description_en', 'description_bn', 'description_hn',
        'remarks', 'sort_by', 'is_active', 'create_by', 'modified_by'
    ];



    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
