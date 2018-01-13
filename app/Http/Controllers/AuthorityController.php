<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Authority;

class AuthorityController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }

   public function gets() {
     return Authority::all();
   }

   public function get($id) {
      $data = Authority::find($id);
      if ($data) {
         return $data;
      }
      return abort(404);
   }

}
