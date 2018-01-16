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

   public static function getSummary($date = FALSE) {
      $qry = DB::table('transaksi')
         ->select(
               DB::raw('DATE(tanggal_transaksi) AS tanggal_transaksi, SUM(jumlah_transaksi_detil) AS jumlah_barang_transaksi, SUM(jumlah_transaksi_detil * harga_barang) AS total_biaya_transaksi')
            )
         ->join('transaksi_detil', 'transaksi.kode_transaksi', '=', 'transaksi_detil.kode_transaksi')
         ->join('barang', 'transaksi_detil.kode_barang', '=', 'barang.kode_barang')
         ->groupBy(DB::raw('DATE(tanggal_transaksi)'))
         ->orderBy('tanggal_transaksi', 'DESC');
      if ($date) {
         $qry->whereRaw("DATE(tanggal_transaksi) >= '" . $date['start'] . "'");
         $qry->whereRaw("DATE(tanggal_transaksi) <= '" . $date['end'] . "'");
      }

      $data = $qry->get();

      if ($data) {
         return $data;
      }
      return abort(404);
   }


}
