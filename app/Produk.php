<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public function berinilai()
    {
        return $this->hasMany(BeriNilai::class);
    }
}
