<?php

namespace Cinebaz\Banner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
  use HasFactory, SoftDeletes;
  protected $fillable = [
    'media_id','title_en', 'title_bn', 'title_hn', 'description_en', 'description_bn', 'description_hn', 'age_limit',
    'duration', 'play_button_url', 'details_button_url', 'trailler_button_url', 'year', 'read_status', 'image', 'name_id'
  ];

  function relationtomasterbanner()
  {
    return $this->hasOne('Cinebaz\Banner\Models\MasterBanner', 'id', 'name_id');
  }
  function Bannermedia()
  {
    return $this->hasOne('Cinebaz\Media\Models\Media', 'id', 'media_id');
  }
}
