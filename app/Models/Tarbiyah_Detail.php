<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
// use Jenssegers\Mongodb\Eloquent\HybridRelations;


class Tarbiyah_Detail extends Eloquent
{
    // use HybridRelations;

    protected $connection = 'mongodb';

    protected $collection = 'tarbiyah_details';

    protected $fillable = ['id_halaqah', 'id_user'];

    public function halaqah()
    {
        return $this->belongsTo('App\Models\Halaqah');
    }

    public function kaders()
    {
        return $this->hasMany('App\Models\Kader');
    }
}
