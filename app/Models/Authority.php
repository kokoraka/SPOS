<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Authority extends Model {
    protected $table = "otoritas";
    protected $primaryKey = "kode_otoritas";
    public $incrementing = false;
    public $timestamps = false;

    protected $hidden = [];
    protected $guarded = [];

}
