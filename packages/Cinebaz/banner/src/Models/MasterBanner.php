<?php

namespace Cinebaz\Banner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterBanner extends Model
{
    use HasFactory, SoftDeletes;
}
