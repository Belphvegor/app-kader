<?php

namespace App\Models\Wilayah;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Provinsi extends Eloquent
{
    protected $collection = 'indonesia_provinces';
    protected $hidden = ['_id'];
}
