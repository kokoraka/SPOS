<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model {
    protected $table = "transaksi";
    protected $primaryKey = "kode_transaksi";
    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [];
    protected $guarded = [];

}
