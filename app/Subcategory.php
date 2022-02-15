<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function bulletins()
    {
        return $this->hasMany('App\Bulletin');
    }
}
