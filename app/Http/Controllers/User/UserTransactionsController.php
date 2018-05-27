<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use Auth;
use Feeds;
use App\Offer;
use App\Transaction;
use Log;

class UserTransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function isUser()
    {
        if (Auth::user()->type == 'U') return true;
        else return false;
    }
    public function index()
    {
        if ($this->isUser()) {
            $id = Auth::user()->id;
            $transactions = Transaction::where("user_id",$id)->orderBy('id', 'DESC')->has('offer')->paginate(10);
            return view('user.async',compact('transactions'))->with(['type'=>'transactions']);
        } else {
            return redirect()->route('siteHome');
        }
    }

    public function detail($action, $id){
        Log::debug('detalle las transacciones'.request()->id);
        $transaction = Transaction::find($id);
        return view('user.async',compact("transaction"))->with(['type'=>$action]);
    }

}
