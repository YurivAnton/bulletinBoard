<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function bulletins()
    {
        return $this->hasManyThrough('App\Bulletin', 'App\Subcategory');
    }
}
