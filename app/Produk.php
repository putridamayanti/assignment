<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $primaryKey = 'id';

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id');
    }
}
