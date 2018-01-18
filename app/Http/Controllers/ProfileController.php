<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Employees;
use Validator;

class ProfileController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }


   public function index() {
     $data = [
         'me' => $this,
     ];
     return view('profiles.index', $data);
   }

   public function save(Request $request) {
      $data = Employees::find('toor');//auth
      if ($data) {
         $data = [
            'nama_pegawai' => $request->get('name'),
            'kata_sandi_pegawai' => bcrypt($request->get('password'))
         ];

         $rules = [
            'name' => 'required|min:4',
            'password' => 'required|min:6',
            'thumbnail' => 'mimes:jpeg,png|image|max:2048'
         ];

         $this->validate($request, $rules);

         $file = $request->file('thumbnail');
         if ($file) {
            $fileName = strtolower(md5(date('YmdHms'))) . '.' . $file->getClientOriginalExtension();
            $try = $file->move("images/profiles", $fileName);
            $data['gambar_pegawai'] = $fileName;
         }

         Employees::find('toor')->update($data);//auth
         return redirect('profile');
      }
      return redirect('profile');
   }

}
