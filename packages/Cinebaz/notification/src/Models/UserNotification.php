<?php

namespace Cinebaz\Notification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class UserNotification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = ['read_at'];
    public function GetMember()
    {
        return $this->hasOne(Member::class, 'id', 'notifiable_id');
    }
}
