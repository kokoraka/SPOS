<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Employees;
use App\Models\Authority;
use Validator;
use Auth;

class EmployeeController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }


   public function index() {
      if (Auth::guard('employee')->user()->hasRole(['root'])) {
         $data = [
            'employees' => $this->gets(),
            'authority' => Authority::all(),
            'me' => $this
         ];
         return view('employees.index', $data);
      }
      return redirect('/');
   }

   public function view($id) {
      if (Auth::guard('employee')->user()->hasRole(['root'])) {
         $data = [
            'employee' => $this->get($id),
            'authority' => Authority::all(),
            'me' => $this
         ];
         return view('employees.change', $data);
      }
      return redirect('/');
   }

   public function confirm($id) {
    if (Auth::guard('employee')->user()->hasRole(['root'])) {
      $data = [
         'employee' => $this->get($id),
         'authority' => Authority::all(),
         'me' => $this
      ];
      return view('employees.delete', $data);
    }
    return redirect('/');
   }

   public function gets() {
     return Employees::all();
   }

   public function get($id) {
      $data = Employees::find($id);
      if ($data) {
         return $data;
      }
      return abort(404);
   }

   public function change($id, Request $request) {
      $data = Employees::find($id);
      if ($data) {
         $data = [
            'nama_pegawai' => $request->get('name'),
            'kata_sandi_pegawai' => bcrypt($request->get('password')),
            'kode_otoritas' => $request->get('authority')
         ];

         $rules = [
            'name' => 'required|min:4',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'authority' => 'required',
            'thumbnail' => 'mimes:jpeg,png|image|max:2048'
         ];

         $this->validate($request, $rules);

         $file = $request->file('thumbnail');
         if ($file) {
            $fileName = strtolower(md5(date('YmdHms'))) . '.' . $file->getClientOriginalExtension();
            $try = $file->move("images/profiles", $fileName);
            $data['gambar_pegawai'] = $fileName;
         }

         Employees::find($id)->update($data);
         return redirect('employees/view/' . $id);
      }
      return redirect('employees');
   }

   public function delete($id) {
      $data = Employees::find($id);
      if ($data) {
         Employees::find($id)->delete();
         return redirect('employees');
      }
      return redirect('employees');
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

      Employees::insert($data);
      return redirect('employees');
   }


}
