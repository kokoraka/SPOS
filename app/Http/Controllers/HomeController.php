<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employees;
use App\Models\Transaction;
use App\Models\Items;
use Auth;

class HomeController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }


   public function index() {
     $data = [
         'board' => $this->getMainBoard(),
         'stock' => Items::getStockItems(5),
         'popular' => Items::getPopularItems(5),
         'me' => $this
     ];
     return view('home', $data);
   }

   public function getMainBoard() {
      $data['employees'] = Employees::count();
      $data['items'] = Items::sum('stok_barang');
      $data['transactions'] = DB::table('transaksi')
         ->select(DB::raw('SUM(jumlah_transaksi_detil) AS jumlah_transaksi_detil'))
         ->join('transaksi_detil', 'transaksi.kode_transaksi', '=', 'transaksi_detil.kode_transaksi')
         ->first()->jumlah_transaksi_detil;
      $data['incomes'] = Transaction::sum('total_biaya_transaksi');

      return $data;
   }
}
