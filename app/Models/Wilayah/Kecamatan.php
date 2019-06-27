<?php

namespace App\Models\Wilayah;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Kecamatan extends Eloquent
{
    protected $collection = 'indonesia_districts';
    protected $hidden = ['_id'];
}
