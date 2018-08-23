<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    public function user() {
        $this->belongsTo('App\User');
    }
}
