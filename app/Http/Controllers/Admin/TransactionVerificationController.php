<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Transaction;
use App\Mail\VerifyOffer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Log;
use App\logo_user;


class TransactionVerificationController extends Controller
{
    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('transaction-verification.index');
        }
    }

    public function index()
    {
        $logo_user = logo_user::logo();

        return view('admin.transaction-verification.index')->with(['logo_user'=>$logo_user]);
    }

    public function main($id)
    {

       	$transactions = Transaction::orderBy('id', 'DESC')->has('offer')->paginate(8);

        return view('admin.transaction-verification.async',compact("transactions"))->with('type', __FUNCTION__);
    }

     public function search()
    {
        $transactions = Transaction::search(request()->unique_code, request()->type, request()->name, request()->money, request()->status)->orderBy('id', 'DESC')->has('offer')->paginate(8);

        return view('admin.transaction-verification.async',compact("transactions"))->with('type', 'main');
    }
    public function detail($id){
        $transaction = Transaction::find($id);
        return view('admin.transaction-verification.async',compact("transaction"))->with('type', __FUNCTION__);
    }

    public function verify($id){
        $transaction = Transaction::find($id);
        $transaction->status = 1;
        $transaction->save();

        $offer = Offer::find($transaction->offer_id);
        $offer->verificada = 1;
        $offer->save();

        Mail::to($transaction->user->email)->send(new VerifyOffer(1,$transaction));


        return response()->json(['mensaje'=>'La oferta ha sido verificada']);
    }

    public function reject($id){
        $transaction = Transaction::find($id);
        $transaction->status = 2;
        $transaction->save();

        $offer = Offer::find($transaction->offer_id);
        $offer->verificada = 2;
        $offer->status = 0;
        $offer->save();

        Mail::to($transaction->user->email)->send(new VerifyOffer(2,$transaction));
        return response()->json(['mensaje'=>'La oferta ha sido rechazada']);
    }
}
