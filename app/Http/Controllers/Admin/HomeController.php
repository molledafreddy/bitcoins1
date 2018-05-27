<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\logo_user;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function isAdmin()
    {
        if (Auth::user()->type == 'A') return true;
        else return false;
    }

    public function index()
    {
        if ($this->isAdmin()) {
            $logo_user = logo_user::logo();

            return view('admin.panel')->with(['logo_user'=>$logo_user]);
        } else {
            return redirect()->route('siteHome');
        }
    }
}
