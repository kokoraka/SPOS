<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
     protected $username = 'kode_pegawai';
     protected $redirectTo = '/';
     protected $redirectAfterLogout = '/login';
     protected $guard = 'employee';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'kode_pegawai' => 'required|min:6|max:15|unique:pegawai',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function authenticate() {
      if (Auth::guard('employee')->attempt(['kode_pegawai' => $email, 'password' => $password])) {
        return redirect()->intended('/');
      }
    }


  public function logout(Request $request) {
    Auth::guard('employee')->logout();
    $request->session()->forget('employee');
    return redirect('/login');
  }

    /*
    protected function create(array $data) {
        return User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'email' => 'dd',
            'realname' => 'dd',
            'biography' => 'dd',
            'registered_date' => date('Y-m-d'),
            'registered_time' => date('H:m:s'),
            'auth_id' => 'user'
        ]);
    }
    */
}
