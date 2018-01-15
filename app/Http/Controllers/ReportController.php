<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Items;
use App\Models\Transaction;
use App\Models\TransactionDetails;
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

   public function incomes() {
     $data = [
         'incomes' => Transaction::all(),
         'me' => $this
     ];
     return view('reports.incomes', $data);
   }

   public function viewReportIncomes() {
     $data = [
         'incomes' => Transaction::getDetails(),
         'me' => $this
     ];
     return view('reports.viewIncomes', $data);
   }

}
