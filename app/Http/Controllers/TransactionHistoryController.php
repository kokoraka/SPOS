<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Items;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Validator;
use Auth;

class TransactionHistoryController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }


   public function index() {
      if (Auth::guard('employee')->user()->hasRole(['root', 'cashier'])) {
         $data = [
            'transactions' => $this->gets(),
            'me' => $this
         ];
         return view('transactionhistory.index', $data);
      }
      return redirect('/');
   }

   public function view($id) {
      if (Auth::guard('employee')->user()->hasRole(['root', 'cashier'])) {
         $data = [
            'transaction' => $this->get($id),
            'details' => TransactionDetailsController::get_trx($id),
            'items' => Items::all(),
            'me' => $this
         ];
         return view('transactionhistory.change', $data);
      }
      return redirect('/');
   }

   public function receipt($id) {
      if (Auth::guard('employee')->user()->hasRole(['root', 'cashier'])) {
         $data = [
            'transaction' => $this->get($id),
            'details' => TransactionDetailsController::get_trx($id),
            'items' => Items::all(),
            'me' => $this
         ];
         return view('transactionhistory.receipt', $data);
      }
      return redirect('/');
   }

   public function confirm($id) {
      if (Auth::guard('employee')->user()->hasRole(['root', 'cashier'])) {
         $data = [
            'transaction' => $this->get($id),
            'details' => TransactionDetailsController::get_trx($id),
            'me' => $this
         ];
         return view('transactionhistory.delete', $data);
      }
      return redirect('/');
   }

   public function gets() {
     return Transaction::all();
   }

   public function get($id) {
      $data = Transaction::find($id);
      if ($data) {
         return $data;
      }
      return abort(404);
   }

   public function change($id, Request $request) {
      $data = Transaction::find($id);
      if ($data) {
         $data = [
            'nama_pembeli' => $request->get('buyer'),
            'nomor_telepon' => $request->get('phone'),
         ];
         $rules = [
            'buyer' => 'required|min:4',
            'phone' => 'min:8'
         ];
         $this->validate($request, $rules);

         $items = $request->get('items');
         $quantity = $request->get('quantity');


         foreach ($items as $key => $value) {
            $details[] = array(
               'kode_barang' => $items[$key],
               'jumlah_transaksi_detil' => $quantity[$key],
               'kode_transaksi' => $id
            );
         }

         Transaction::find($id)->update($data);
         TransactionDetails::where('kode_transaksi', '=', $id)->delete();
         TransactionDetails::insert($details);
         return redirect('transaction/history/view/' . $id);
      }
      return redirect('transaction/history');
   }

   public function delete($id) {
      $data = Transaction::find($id);
      if ($data) {
         Transaction::find($id)->delete();
         return redirect('transaction/history');
      }
      return redirect('transaction/history');
   }

   public function store(Request $request) {
      $data = [
         'kode_pegawai' => $request->get('username'),
         'nama_pegawai' => $request->get('name'),
         'kata_sandi_pegawai' => bcrypt($request->get('password')),
         'gambar_pegawai' => $request->get('thumbnail'),
         'kode_otoritas' => $request->get('authority')
      ];

      $rules = [
         'username' => 'required|min:4|max:15',
         'name' => 'required|min:4',
         'password' => 'required|min:6',
         'authority' => 'required',
         'thumbnail' => 'required|mimes:jpeg,png|image|max:2048'
      ];

      $this->validate($request, $rules);

      $file = $request->file('thumbnail');
      $fileName = strtolower(md5(date('YmdHms'))) . '.' . $file->getClientOriginalExtension();
      $try = $file->move("images/profiles", $fileName);
      $data['gambar_pegawai'] = $fileName;

      Transaction::insert($data);
      return redirect('transaction/history');
   }


}
