<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Items;
use Validator;

class ItemController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }


   public function index() {
     $data = [
         'items' => $this->gets(),
         'me' => $this
     ];
     return view('items.index', $data);
   }

   public function view($id) {
     $data = [
         'item' => $this->get($id),
         'me' => $this
     ];
     return view('items.change', $data);
   }

   public function confirm($id) {
     $data = [
         'item' => $this->get($id),
         'me' => $this
     ];
     return view('items.delete', $data);
   }

   public function gets() {
     return Items::all();
   }

   public function get($id) {
      $data = Items::find($id);
      if ($data) {
         return $data;
      }
      return abort(404);
   }

   public function change($id, Request $request) {
      $data = Items::find($id);
      if ($data) {
         $data = [
            'nama_barang' => $request->get('name'),
            'deskripsi_barang' => $request->get('description'),
            'harga_barang' => $request->get('price'),
            'stok_barang' => $request->get('stock'),
         ];

         $rules = [
            'nama_barang' => 'required|min:5',
            'deskripsi_barang' => 'required|min:15',
            'harga_barang' => 'required',
            'stok_barang' => 'required'
         ];


         if (Validator::make($data, $rules)->fails()) {
            return redirect('items');
         }
         Items::find($id)->update($data);
         return redirect('items/view/' . $id);
      }
      return redirect('items');
   }

   public function delete($id) {
      $data = Items::find($id);
      if ($data) {
         Items::find($id)->delete();
         return redirect('items');
      }
      return redirect('items');
   }


}
