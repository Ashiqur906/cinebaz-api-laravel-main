<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['banner_image', 'banner_title', 'banner_description', 'age_limit', 'duration', 'play_button_text', 'play_button_url', 'details_button_text', 'details_button_url', 'trailler_button_text', 'trailler_button_url', 'read_status'];
}
