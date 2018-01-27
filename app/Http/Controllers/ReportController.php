<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Items;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Validator;
use Auth;

class ReportController extends Controller {

    public function __construct() {
       //$this->middleware('auth');
    }

   public function items() {
      if (Auth::guard('employee')->user()->hasRole(['root', 'supervisor'])) {
         $data = [
            'items' => Items::all(),
            'me' => $this
         ];
         return view('reports.items', $data);
      }
      return redirect('/');
   }

   public function viewReportItems() {
      if (Auth::guard('employee')->user()->hasRole(['root', 'supervisor'])) {
         $data = [
            'items' => Items::all(),
            'me' => $this
         ];
         return view('reports.viewItems', $data);
      }
      return redirect('/');
   }

   public function incomes() {
      if (Auth::guard('employee')->user()->hasRole(['root', 'supervisor'])) {
         $data = [
            'incomes' => Transaction::getSummary(),
            'me' => $this
         ];
         return view('reports.incomes', $data);
      }
      return redirect('/');
   }

   public function viewReportIncomes() {
      if (Auth::guard('employee')->user()->hasRole(['root', 'supervisor'])) {
         $data = [
            'incomes' => Transaction::getSummary(FALSE),
            'me' => $this
         ];
         return view('reports.viewIncomes', $data);
      }
      return redirect('/');
   }

   public function viewReportIncomesCustom($start, $end) {
      if (Auth::guard('employee')->user()->hasRole(['root', 'supervisor'])) {
         $data = [
            'incomes' => Transaction::getSummary(['start' => $start, 'end' => $end]),
            'me' => $this
         ];
         return view('reports.viewIncomes', $data);
      }
      return redirect('/');
   }

}
