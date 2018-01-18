<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Items;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Session;
use Validator;
use Auth;

class TransactionController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }


   public function index(Request $request) {
      if (Auth::guard('employee')->user()->hasRole(['root', 'cashier'])) {
         $data = [
            'transactions' => Transaction::all(),
            'items' => Items::all(),
            'orders' => $this->gets($request),
            'me' => $this
         ];
         return view('transaction.index', $data);
      }
      return redirect('/');
   }

   public function gets(Request $request) {
      $orders = $request->session()->get('orders');
      $items = Items::all();
      if ($orders) {
         foreach ($orders as $key => $value) {
            foreach ($items as $key2 => $value2) {
               if ($orders[$key]['kode_barang'] == $value2->kode_barang) {
                  $orders[$key]['nama_barang'] = $value2->nama_barang;
                  $orders[$key]['harga_barang'] = $value2->harga_barang;
                  break;
               }
            }
         }
      }

      return $orders;
   }

   public function get(Request $request, $id) {
      $orders = $request->session()->get('orders');
      foreach ($orders as $key => $value) {
         if ($value->kode_barang == $id) {
            return $orders[$key];
         }
         break;
      }
      return abort(404);
   }

   public function addItem(Request $request) {
      $data = [
         'kode_barang' => $request->get('id'),
         'jumlah_barang' => $request->get('qty'),
      ];

      $found = -1;
      $orders = Session::get('orders');;

      if (count($orders) > 0) {
         foreach ($orders as $key => $value) {
            if ($orders[$key]['kode_barang'] == $data['kode_barang']) {
               $found = $key;
            }
         }
      }

      if ($found == -1) {
         $request->session()->push('orders', $data);
      }
      else {
         $orders[$found]['jumlah_barang'] += $data['jumlah_barang'];
         Session::set('orders', $orders);
      }
   }

   public function removeItem(Request $request) {
      $data = [
         'kode_barang' => $request->get('id'),
      ];

      $found = -1;
      $orders = Session::get('orders');;

      if (count($orders) > 0) {
         foreach ($orders as $key => $value) {
            if ($orders[$key]['kode_barang'] == $data['kode_barang']) {
               $found = $key;
               break;
            }
         }
      }

      if ($found !== -1) {
         unset($orders[$found]);
         $details = array();
         foreach ($orders as $key => $value) {
            $details[] = [
               'kode_barang' => $orders[$key]['kode_barang'],
               'jumlah_barang' => $orders[$key]['jumlah_barang'],
            ];
         }

         if (count($details) > 0) {
            Session::set('orders', $details);
         }
         else {
            Session::forget('orders');
         }
      }
   }

   public function getOrders(Request $request) {
      $orders = $this->gets($request);
      $total = 0;
      if (count($orders) > 0) {
         foreach ($orders as $key => $value) {
            $total += $orders[$key]['harga_barang'] * $orders[$key]['jumlah_barang'];
         }
      }
      return response()->json(['data' => $orders, 'total' => $this->rp($total), 'max' => $total]);
   }

   public function removeOrders(Request $request) {
      $request->session()->forget('orders');
      return response()->json(['msg' => 'Berhasil menghapus barang dari transaksi'], 200);
   }

   public function store(Request $request) {
      $data = [
         'nama_pembeli' => $request->get('name'),
         'nomor_telepon' => $request->get('phone'),
         'keterangan_transaksi' => $request->get('addition'),
         'total_bayar_transaksi' => $request->get('cash'),
         'kode_pegawai' => 'toor'//session login
      ];
      $rules = [
         'name' => 'min:4',
         'phone' => 'min:9',
         'addition' => 'min:5',
         'cash' => 'required'
      ];
      $orders = $this->gets($request);
      $validator = Validator::make($request->all(), $rules);
      if (!$validator->fails()) {
         $messages = $validator->errors();

         if (count($orders) > 0) {
            $try = Transaction::create($data);
            if ($try) {
               $details = array();
               foreach ($orders as $key => $value) {
                  $details[] = [
                     'kode_transaksi' => $try->kode_transaksi,
                     'kode_barang' => $orders[$key]['kode_barang'],
                     'jumlah_transaksi_detil' => $orders[$key]['jumlah_barang']
                  ];
               }
               TransactionDetails::insert($details);
               $this->removeOrders($request);
            }
         }
         else {
            $messages->add('', 'Tidak ada barang yang dibeli.');
         }
      }
      return redirect('transaction')->withErrors($messages)->withInput();
   }

  public function last10() {
    return response()->json(['content' => Transaction::getSummary(FALSE, ['skip' => 0, 'take' => 10])]);
  }

}
