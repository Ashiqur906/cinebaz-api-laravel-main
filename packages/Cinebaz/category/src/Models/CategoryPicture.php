<?php

namespace Cinebaz\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryPicture extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pictures';

    protected $fillable = [
        'imageable_id',  'imageable_type', 'name', 'file_name', 'featured', 'mime_type', 'small',
        'medium', 'full', 'thumbnail',
        'remarks', 'sort_by', 'is_active', 'create_by', 'modified_by'
    ];
    public function imageable()
    {
        return $this->morphTo();
    }
}