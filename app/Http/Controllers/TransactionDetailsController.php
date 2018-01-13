<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Validator;

class TransactionDetailsController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }


   public function gets() {
     return TransactionDetails::all();
   }

   public static function get_trx($id) {
      $data = DB::table('transaksi_detil')
         ->join('barang', 'transaksi_detil.kode_barang', '=', 'barang.kode_barang')
         ->where('kode_transaksi', $id)
         ->get();
         
      if ($data) {
         return $data;
      }
      return abort(404);
   }

   public function delete($id) {
      $data = TransactionDetails::find($id);
      if ($data) {
         TransactionDetails::find($id)->delete();
         return redirect('transaction/history');
      }
      return redirect('transaction/history');
   }

}
