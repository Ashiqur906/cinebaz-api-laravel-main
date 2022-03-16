<?php

namespace Cinebaz\Pricing\Models;

use Cinebaz\Season\Models\Season;
use Cinebaz\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionHead extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'subscription_head';
    // protected $fillable = [
    //     'title_bn', 'title_en', 'title_hn', 'quality', 'fullname', 'shortname', 'remarks', 'is_active', 'create_by', 'modified_by',

    // ];
    // public function pricings()
    // {
    //     return $this->belongsToMany(Pricing::class, 'pricing_quality');
    // }
}
