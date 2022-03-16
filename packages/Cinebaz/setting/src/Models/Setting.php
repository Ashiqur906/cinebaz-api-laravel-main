<?php

namespace Cinebaz\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = [
        'key', 'display_name', 'value', 'details', 'type', 'order', 'group',
    ];
}
