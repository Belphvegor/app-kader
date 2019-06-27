<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Halaqah extends Eloquent
{
    use SoftDeletes;

    protected $connection = 'mongodb';

    protected $collection = 'halaqah';
    protected $dates = ['deleted_at'];

    protected $fillable = ['nama_halaqah', 'murabbi', 'naqib', 'sekretaris', 'bendahara', 'id_marhala'];

    public function tarbiyah()
    {
        return $this->hasMany('App\Models\Tarbiyah_Detail', 'id_halaqah', '_id');
    }

    public function marhala()
    {
        return $this->belongsTo('App\Models\Marhala');
    }
}
