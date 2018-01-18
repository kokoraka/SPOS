<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Items extends Model {
    protected $table = "barang";
    protected $primaryKey = "kode_barang";
    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [];
    protected $guarded = [];

    public static function getStockItems($amount) {
      $data = Items::orderBy('stok_barang', 'DSC')
        ->select(
          '*', DB::raw('FORMAT(((SELECT stok_barang / (SELECT SUM(stok_barang) FROM barang)) * 100), 2) AS persentasi_barang')
          )
        ->skip(0)->take($amount)->get();
      return $data;
    }

    public static function getPopularItems($amount) {
      $data = DB::table('barang')
        ->select(
            DB::raw('barang.*, SUM(jumlah_transaksi_detil) AS total_terjual'),
            DB::raw('FORMAT(((SELECT stok_barang / (SELECT SUM(stok_barang) FROM barang)) * 100), 2) AS persentasi_barang')
            )
        ->join('transaksi_detil', 'barang.kode_barang', '=', 'transaksi_detil.kode_barang')
        ->groupBy('kode_barang')
        ->orderBy('total_terjual', 'DESC')
        ->get();
       return $data;
    }
}
