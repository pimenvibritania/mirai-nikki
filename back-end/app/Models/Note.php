<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Subset;

class Note extends Model
{
    protected $guarded = [];

    public function subject()
    {
        # code...
        return $this->belongsTo(Subject::class);
    }
}
