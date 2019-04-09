<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $table    = 'santri';
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }
}
