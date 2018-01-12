<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }


   public function index() {
     //$data = [
         //'data' => $this->get_all_status('normal', 0, 6)
     //;
      return view('home');
   }

    public function get_all_status($method, $min, $max) {
      if ($method == 'normal') {
        $data['max'] = DB::table('status')
          ->where('visibility', '=', 'PUBLIC')->get();

        $data['recents']  = Status::get_recents();
        $data['authors']  = Authors::get_authors();
        $data['categories']  = Categories::get_categories();
        $data['tags']  = Tags::get_tags();
      }

      $data['status'] = DB::table('status')
       ->selectRaw('status.*, authors.name, authors.slug AS author_slug')
       ->join('authors', 'authors.id', '=', 'status.author_id')
       ->skip($min)->take($max)->get();

      foreach ($data['status'] as $key2 => $value2) {
            $data[$key2]['cats'] = DB::table('categories')
            ->join('statuscategories', 'categories.id', '=', 'statuscategories.id')
            ->orderBy('categories.name', 'ASC')
            ->where('statuscategories.status_id', '=', $value2->id)
            ->get();
      }
      foreach ($data['status'] as $key3 => $value3) {
            $data[$key3]['tags'] = DB::table('tags')
            ->join('statustags', 'tags.id', '=', 'statustags.id')
            ->orderBy('tags.name', 'ASC')
            ->where('statustags.status_id', '=', $value3->id)
            ->get();
      }

       switch ($method) {
         case 'json':
           return response()->json($data, 200);
         break;
         default:
           return $data;
         break;
       }
    }


    public function page($page) {
      if (view()->exists($page)) {
        $data['recents']  = Status::get_recents();
        return view($page, ['data' => $data]);
      }
      return abort(404);
    }

}
