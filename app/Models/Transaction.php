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


   public static function getDetails() {
      $data['trx'] = Transaction::all();
      foreach ($data['trx'] as $key => $value) {
         $data[] = DB::table('transaksi_detil')
            ->join('barang', 'transaksi_detil.kode_barang', '=', 'barang.kode_barang')
            ->where('kode_transaksi', $value->kode_transaksi)
            ->get();
      }

      if ($data) {
         return $data;
      }
      return abort(404);
   }


}
