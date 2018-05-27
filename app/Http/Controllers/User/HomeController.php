<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Transaction;
use Auth;
use Feeds;
use View;
use App\logo_user;

class HomeController extends Controller
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

            $logo_user = logo_user::logo();

            return view('user.panel')->with(['logo_user'=>$logo_user]);
        } else {
            return redirect()->route('siteHome');
        }
    }

    public function dashboard()
    {
            $id = Auth::user()->id;
            $transactions = Transaction::where("user_id",$id)->orderBy('id', 'DESC')->has('offer')->take(3)->get();            
            $transactionsCount = Transaction::where("user_id",$id)->has('offer')->count();
            return view('user.async',compact('transactions','transactionsCount'))->with(['type'=>'dashboard']);
    }


}
