<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Items;
use Validator;

class ReportController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }

   public function items() {
     $data = [
         'items' => Items::all(),
         'me' => $this
     ];
     return view('reports.items', $data);
   }

   public function viewReportItems() {
     $data = [
         'items' => Items::all(),
         'me' => $this
     ];
     return view('reports.viewItems', $data);
   }

}
