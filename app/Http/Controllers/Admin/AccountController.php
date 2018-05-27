<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\AccountType;
use App\PaymentData;
use App\PaymentDataDetail;
use Log;
use App\logo_user;

class AccountController extends Controller
{

    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('accounts.index');
        }
    }

    public function index()
    {
        $logo_user = logo_user::logo();

        return view('admin.accounts.index')->with(['logo_user'=>$logo_user]);
    }

    public function main()
    {
        $accounts = PaymentData::has('paymentDataDetail')->get();
        return view('admin.accounts.async',compact("accounts"))->with('type', __FUNCTION__);
    }

    public function create()
    {
        $accountTypesNot = PaymentDataDetail::pluck('payment_data_id')->all();
    	$accountTypes = PaymentData::where("status",1)->whereNotIn('id', $accountTypesNot)->get();

        return view('admin.accounts.async',compact("accountTypes"))->with('type', __FUNCTION__);
    }
    public function store(Request $request)
    {
    	$request->validate([
	        'type' => 'required',
        ]);
        $names = $request->names;
        $values = $request->values;
        $links = $request->is_links;
        $id = $request->type;
        $i=0;
        $paymentDataDetailDelete = paymentDataDetail::where("payment_data_id",$id)->delete();
        if($names != null && $values != null ){
            foreach ($names as $key => $name) {
                $paymentDataDetail = new PaymentDataDetail();
                $paymentDataDetail->name = $name;
                if(isset($links[$i])){$paymentDataDetail->is_link = 1;}else{$paymentDataDetail->is_link = 0;}
                $paymentDataDetail->value = $values[$key];
                $paymentDataDetail->payment_data_id = $id;
                $paymentDataDetail->save();
                $i++;
            }
        }
        return response()->json(['mensaje'=>'Los datos se han guardado con éxito']);

    }

    public function edit($id)
    {
    	$paymentDataDetails = paymentDataDetail::where('payment_data_id',$id)->get();
        $paymentData = PaymentData::find($id);
        return view('admin.accounts.async',compact("paymentDataDetails","paymentData"))->with('type', __FUNCTION__);
    }

    public function update($id)
    {
    	$request = request();
        $request->validate([
	        'type' => 'required',
        ]);
        $names = $request->names;
        $values = $request->values;
        $links = $request->is_links;
        $id = $request->type;
        $i=0;      
        $paymentDataDetailDelete = paymentDataDetail::where("payment_data_id",$id)->delete();
        if($names != null && $values != null){
            foreach ($names as $key => $name) {
                $paymentDataDetail = new PaymentDataDetail();
                $paymentDataDetail->name = $name;
                if(isset($links[$i])){$paymentDataDetail->is_link = 1;}else{$paymentDataDetail->is_link = 0;}
                $paymentDataDetail->value = $values[$key];
                $paymentDataDetail->payment_data_id = $id;
                $paymentDataDetail->save();
                $i++;
            }
        }


        return response()->json(['mensaje'=>'Los datos se han actualizado con éxito']);
    }
    public function destroy($id)
    {
    	Account::destroy($id);
    	$response = array('Status' => '1', 'Message' => 'Delete completed!');
        return $response;
    }

}
