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
            'gambar_barang' => $request->get('thumbnail')
         ];

         $rules = [
            'name' => 'required|min:5',
            'description' => 'required|min:15',
            'price' => 'required',
            'stock' => 'required',
            'thumbnail' => 'required|mimes:jpeg,png|image|max:2048'
         ];

         $this->validate($request, $rules);

         $file = $request->file('thumbnail');
         $fileName = strtolower(md5(date('YmdHms'))) . '.' . $file->getClientOriginalExtension();
         $try = $file->move("images/thumbs", $fileName);
         $data['gambar_barang'] = $fileName;
         
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

   public function store(Request $request) {
      $data = [
         'nama_barang' => $request->get('name'),
         'deskripsi_barang' => $request->get('description'),
         'harga_barang' => $request->get('price'),
         'stok_barang' => $request->get('stock'),
         'gambar_barang' => $request->get('thumbnail'),
      ];

      $rules = [
         'name' => 'required|min:5',
         'description' => 'required|min:15',
         'price' => 'required',
         'stock' => 'required',
         'thumbnail' => 'required|mimes:jpeg,png|image|max:2048'
      ];

      $this->validate($request, $rules);

      $file = $request->file('thumbnail');
      $fileName = strtolower(md5(date('YmdHms'))) . '.' . $file->getClientOriginalExtension();
      $try = $file->move("images/thumbs", $fileName);
      $data['gambar_barang'] = $fileName;

      Items::insert($data);
      return redirect('items');
   }


}
