<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $guarded = [];
    public function notes()
    {
        # code...

        return $this->hasMany(Note::class);
    }
}
