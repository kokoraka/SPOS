<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
