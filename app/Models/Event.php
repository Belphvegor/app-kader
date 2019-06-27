<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Event extends Eloquent
{
    protected $collection = 'events';

    protected $dates = ['created_at', 'updated_at', 'date_start', 'date_end'];
}
