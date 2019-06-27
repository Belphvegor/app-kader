<?php

namespace App\Models\Wilayah;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Kelurahan extends Eloquent
{
    protected $collection = 'indonesia_villages';
    protected $hidden = ['_id'];
}
