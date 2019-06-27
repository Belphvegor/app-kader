<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class OpenRegistration extends Eloquent
{
    protected $collection = 'open_registration';
    protected $dates = ['created_at', 'updated_at', 'open_registration', 'close_registration'];
}
