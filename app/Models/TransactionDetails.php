<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransactionDetails extends Model {
    protected $table = "transaksi_detil";
    protected $primaryKey = "kode_transaksi_detil";
    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [];
    protected $guarded = [];

}
