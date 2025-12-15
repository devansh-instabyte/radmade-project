<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $guarded = [];

    public function layouts()
{
    return $this->hasMany(PageLayout::class);
}

}
