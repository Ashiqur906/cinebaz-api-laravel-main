<?php

namespace Cinebaz\Seo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seo extends Model
{
    use SoftDeletes;
    protected $table = 'seos';
    protected $fillable = [
        'meta_title', 'seoable_id', 'seoable_type', 'meta_description', 'meta_keywords', 'canonical_tag', 'meta_type', 'meta_image',
        'remarks', 'sort_by', 'is_active', 'create_by', 'modified_by'
    ];

    public function seoable()
    {
        return $this->morphTo();
    }
}
