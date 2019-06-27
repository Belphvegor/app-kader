<?php

namespace App\Models\Wilayah;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Kabupaten extends Eloquent
{
    protected $collection = 'indonesia_cities';
    protected $hidden = ['_id'];
}
