<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
// use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Marhalah extends Eloquent
{
    // use HybridRelations;
    protected $collection = 'marhalah';

    protected $fillable = ['nama_marhalah'];

    public function halaqah()
    {
        return $this->hasMany('App\Models\Halaqah', 'id_marhalah', '_id');
    }

    public function kader()
    {
        return $this->hasMany('App\Models\Kader', 'id_marhalah', '_id');
    }
}
