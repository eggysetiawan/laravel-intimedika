<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    protected $fillable = ['name', 'slug', 'model', 'brand', 'price', 'spec', 'category', 'reference', 'stock'];
}
