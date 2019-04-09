<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table    = 'provinsi';
    public function santri()
    {
        return $this->hasMany(Santri::class, 'id_provinsi');
    }
}
