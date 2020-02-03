<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name'];

    use SoftDeletes;

    public function sheets()
    {
        return $this->hasMany(Sheet::class);
    }
}
