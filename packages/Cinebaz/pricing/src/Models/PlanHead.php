<?php

namespace Cinebaz\Pricing\Models;

use Cinebaz\Season\Models\Season;
use Cinebaz\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanHead extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'plan_head';
    // protected $fillable = [
    //     'title_bn', 'title_en', 'title_hn', 'quality', 'fullname', 'shortname', 'remarks', 'is_active', 'create_by', 'modified_by',

    // ];
    public static function hasOption($id)
    {
        $options = PlanHead::get();

        $result = [];
        foreach ($options as $list) {
            $assing = AssignPlan::AssignHead($id, $list->id);
            $is = 'No';
            if ($assing) {
                if ($assing->quality_id) {
                    $quality = Quality::find($assing->quality_id);
                    if ($quality) {
                        $is = $quality->title_en;
                    } else {
                        $is = 'No';
                    }
                } else {
                    $is = 'Yes';
                }
            }
            $result[$list->title] = $is;
        }
        return $result;
    }
}
