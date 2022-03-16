<?php

namespace Cinebaz\Member\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TempUser extends Model
{
    use HasFactory;
    protected $table = 'temp_users';

}
