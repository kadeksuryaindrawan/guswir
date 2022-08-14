<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeriNilai extends Model
{
    public function produk(){
        return $this->belongsTo(Produk::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
