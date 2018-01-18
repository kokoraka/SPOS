<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable {

     protected $table = "pegawai";
     protected $primaryKey = "kode_pegawai";
     public $incrementing = false;
     public $timestamps = false;
     public $remember = false;

    protected $fillable = [
        'kode_pegawai', 'password',
    ];

    protected $hidden = [];

    public function getAuthPassword() {
      return $this->kata_sandi_pegawai;
    }

    public function hasRole($roles = NULL) {
      if ($roles) {
          if (User::where('kode_pegawai', Auth::guard('employee')->user()->kode_pegawai)->whereIn('kode_otoritas', $roles)->get()->count() > 0) {
            return TRUE;
          }
      }
      return FALSE;
    }
}
