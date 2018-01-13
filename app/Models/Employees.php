<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employees extends Model {
    protected $table = "pegawai";
    protected $primaryKey = "kode_pegawai";
    public $incrementing = false;
    public $timestamps = false;

    protected $hidden = [];
    protected $guarded = [];

}
