<?php

namespace Core\Base;

use Illuminate\Database\Eloquent\Model;

class BaseEntity extends Model
{
  protected $hidden = [
    'created_at',
    'updated_at'
  ];
  public $rules = [];
}
