<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SheetAnswer extends Model
{
  /**
   * @param array $fillable
   */
  protected $fillable = [
    'sheet_id',
    'type_question_id',
    'answer'
  ];

  /**
   * @param array $casts
   */
  protected $casts = [
    'answer' => 'array'
  ];


  public function sheet() {
    return $this->belongsTo(Sheet::class);
  }
}
