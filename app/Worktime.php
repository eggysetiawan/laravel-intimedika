<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worktime extends Model
{
    //

    // relations
    public function worktimeable()
    {
        return $this->morphTo();
    }
}
