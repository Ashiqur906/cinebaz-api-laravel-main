<?php

namespace Cinebaz\Pricing\Models;

use Cinebaz\Season\Models\Season;
use Cinebaz\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pricing extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pricings';
    protected $fillable = [
        'title_bn', 'title_en', 'title_hn', 'amount', 'description', 'color', 'remarks', 'is_active', 'create_by', 'modified_by',

    ];
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
    public function qualities()
    {
        return $this->belongsToMany(Quality::class, 'pricing_quality');
    }
}
