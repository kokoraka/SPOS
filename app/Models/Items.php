<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Items extends Model {
    protected $table = "barang";
    protected $primaryKey = "kode_barang";
    public $incrementing = true;
    public $timestamps = false;

    protected $hidden = [];
    protected $guarded = [];
    /*
    public static function get_recents() {
      $data = DB::table('status')
       ->selectRaw('status.*, authors.name, authors.slug AS author_slug')
       ->orderBy('status.updated_at', 'DSC')
       ->join('authors', 'authors.id', '=', 'status.author_id')
       ->skip(0)->take(7)->get();
       return $data;
    }

    public static function get_categories() {
      return DB::table('categories')->orderBy('name', 'ASC')->get();
    }
    */
}
