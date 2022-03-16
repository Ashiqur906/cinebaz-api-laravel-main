<?php

namespace Cinebaz\Pricing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cinebaz\Season\Models\Season;
use Cinebaz\Seo\Models\Seo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cinebaz\Pricing\Models\Quality;

class AssignPlan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'assign_plans';
    public function SubHead()
    {
        return $this->hasOne(SubscriptionHead::class, 'id', 'sub_head_id');
    }
    public function PlanHead()
    {
        return $this->hasOne(PlanHead::class, 'id', 'plan_head_id');
    }

    public static function AssignHead($id, $id2)
    {
        return $GetAssign = AssignPlan::where('sub_head_id', $id)
            ->where('sub_head_id', $id)
            ->where('plan_head_id', $id2)
            ->first();
    }
    public static function GetQuality($id)
    {
        return $GetAssign = Quality::where('id', $id)
            ->first();
    }
}
