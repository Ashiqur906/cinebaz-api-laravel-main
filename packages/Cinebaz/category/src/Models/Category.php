<?php

namespace Cinebaz\Category\Models;

use Cinebaz\Media\Models\Media;
use Cinebaz\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = [
        'title_bangla', 'title_english', 'title_hindi', 'slug', 'menu_show', 'page_show', 'home_show',
        'is_active',  'create_by', 'modified_by',

    ];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
    public function images()
    {
        return $this->morphMany(CategoryPicture::class, 'imageable');
    }
    public function allimages()
    {
        return $this->morphMany(CategoryPicture::class, 'imageable');
    }
    public function medias()
    {
        return $this->belongsToMany(Media::class, 'media_category');
    }

}
