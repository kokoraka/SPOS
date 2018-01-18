<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class EmployeeAuthController extends Controller {

  protected $username = 'kode_pegawai';
  protected $redirectTo = '/';
  protected $redirectAfterLogout = '/login';
  protected $guard = 'employee';

  public function __construct() {
    $this->middleware('guest:employee', ['except' => ['logout', 'getLogout']]);
  }

  public function username() {
      return 'kode_pegawai';
  }

  public function showLoginForm() {
    return view('auth.login');
  }

  public function login(Request $request) {

    $validator = Validator::make($request->all(), [
      'kode_pegawai' => 'required|min:4',
      'password' => 'required'
    ]);
    $messages = $validator->errors();

    if (!$validator->fails()) {
      $credentials = [
        'kode_pegawai' => $request->kode_pegawai,
        'password' => $request->password
      ];

      if (Auth::guard('employee')->attempt($credentials)) {
        return redirect()->intended('/');
      }
      $messages->add('', 'Pengguna tidak ditemukan, gagal masuk ke dalam sistem.');
      return redirect()->back()->withInput($request->all())->withErrors($messages);
    }
    return redirect()->back()->withInput($request->all())->withErrors($messages);
  }

  public function logout(Request $request) {
    Auth::guard('employee')->logout();
    $request->session()->forget('employee');
    return redirect('/login');
  }

  /*
  public function authenticate() {
    if (Auth::guard('employee')->attempt(['kode_pegawai' => $email, 'password' => $password])) {
      return redirect()->intended('/');
    }
  }
  */

}
