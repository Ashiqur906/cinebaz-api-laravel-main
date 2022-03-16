<?php

namespace Cinebaz\Series\Models;

use Cinebaz\Season\Models\Season;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Series extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'series';
    protected $fillable = [
        'title_bn', 'title_en', 'title_hn',  'slug', 'remarks', 'is_active', 'create_by', 'modified_by',

    ];

    public function season()
    {
        return $this->hasMany(Season::class);
    }
}
