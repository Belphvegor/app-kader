<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Jenssegers\Mongodb\Eloquent\HybridRelations;


class Kader extends Eloquent
{
    use SoftDeletes;
    protected $collection = 'kaders';

    protected $hidden = [
        'password', 'api_token'
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'nik', 'nama', 'profesi', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat',
        'nomor_telepon', 'email', 'password', 'gol_darah', 'asal', 'kecamatan', 'status', 'id_marhalah', 'api_token'
    ];

    public function tarbiyah()
    {
        return $this->belongsTo('App\Models\Tarbiyah_Detail', 'id_user', '_id');
    }

    public function marhala()
    {
        return $this->belongsTo('App\Models\Marhala');
    }
}
