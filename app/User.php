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
        'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
