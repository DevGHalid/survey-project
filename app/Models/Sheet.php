<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sheet extends Model
{
  /**
   * @param array $fillable
   */
  protected $fillable = ['user_id', 'form_id', 'title', 'page'];

  use SoftDeletes;

  public function form()
  {
    return $this->belongsTo(Form::class);
  }

  public function questions()
  {
    return $this->belongsToMany(TypeQuestion::class, 'sheet_answers');
  }

  public function sheetAnswers() {
    return $this->hasMany(SheetAnswer::class);
  }
}
