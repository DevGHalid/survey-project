<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeQuestion extends Model
{
  /**
   * @param array $fillable
   */
  protected $fillable = ['title', 'icon', 'question'];

  /**
   * @param array $casts
   */
  protected $casts = [
    'question' => 'array'
  ];

  public function sheets()
  {
    return $this->belongsToMany(Sheet::class, 'sheet_answers');
  }

  public function answers() {
    return $this->hasMany(SheetAnswer::class);
  }
}
