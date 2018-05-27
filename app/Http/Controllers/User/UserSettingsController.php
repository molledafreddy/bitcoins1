<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use Auth;
use Feeds;
use App\User;
use App\logo_user;
use App\UserAccount;
use App\PaymentData;

class UserSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return view('user.async')->with(['type'=>'dashboard']);
        }
    }

    private function isUser()
    {
        if (Auth::user()->type == 'U') return true;
        else return false;
    }
    public function index()
    {
        if ($this->isUser()) {
            return view('user.async')->with(['type'=>'settings']);
        } else {
            return redirect()->route('siteHome');
        }
    }
    public function editpassword()
    {
            return view('user.async')->with(['type'=>'password_edit']);
    }
    public function edituser()
    {
            $logo_user = logo_user::logo();

            return view('user.async')->with(['logo_user'=>$logo_user,'type'=>'edit_user']);
    }

    public function account_index()
    {
        $accounts = PaymentData::whereHas('UserAccounts', function ($query) {
            $query->where('user_id',Auth::user()->id);
        })->get();

        return view('user.async')->with(['accounts'=>$accounts,'type'=>'account_index']);
    }

    public function add_account()
    {
        $accountTypesNot = UserAccount::where("user_id",Auth::user()->id)->pluck('payment_data_id')->all();
    	$accountTypes = PaymentData::where("status",1)->whereNotIn('id', $accountTypesNot)->get();
        return view('user.async',compact('accountTypes'))->with('type', __FUNCTION__);
    }

    public function store_account()
    {
        $request=request();
        $request->validate([
            'type' => 'required',
        ]);
        $names = $request->names;
        $values = $request->values;
        $id = $request->type;
        $user_id = Auth::user()->id;

        $serAccountDelete = UserAccount::where("user_id", $user_id)->where("payment_data_id",$id)->delete();
        if($names != null && $values != null){
            foreach ($names as $key => $name) {
                $userAccount = new UserAccount();
                $userAccount->name = $name;
                $userAccount->user_id = $user_id;
                $userAccount->value = $values[$key];
                $userAccount->payment_data_id = $id;
                $userAccount->save();
            }
        }

        return response()->json(['mensaje'=>'Los datos se han guardado con éxito']);
    }

    public function edit_bank_account($id)
    {
        $user_id = Auth::user()->id;
        $userAccounts = UserAccount::where("user_id", $user_id)->where('payment_data_id',$id)->get();
        $paymentData = PaymentData::find($id);

        return view('user.async',compact('paymentData','userAccounts'))->with(['type' => __FUNCTION__]);
    }

    public function update_bank_account($id)
    {
        $request=request();
        $request->validate([
            'type' => 'required',
        ]);
        $names = $request->names;
        $values = $request->values;
        $id = $request->type;
        $user_id = Auth::user()->id;

        $serAccountDelete = UserAccount::where("user_id", $user_id)->where("payment_data_id",$id)->delete();
        if($names != null && $values != null){
            foreach ($names as $key => $name) {
                $userAccount = new UserAccount();
                $userAccount->name = $name;
                $userAccount->user_id = $user_id;
                $userAccount->value = $values[$key];
                $userAccount->payment_data_id = $id;
                $userAccount->save();
            }
        }

        return response()->json(['mensaje'=>'Los datos se han guardado con éxito']);
    }

    public function delete_bank_account($id)
    {
        $request=request();
        $account = UserAccount::find($id);
        $account->status = 2;
        $account->save();

        return response()->json(['mensaje'=>'Los datos se han actualizado con éxito']);
    }

	public function edit_password(Request $request){

		$usuarios=User::findOrFail(Auth::user()->id);
		$usuarios->fill($request->all());
        $clave=$request->get('password');
		$NuevaClave = bcrypt($clave);
		$usuarios->password = $NuevaClave;
        $usuarios->save();
        flash()->overlay('Contraseña modificada con exito');
        return redirect()->back();

    }

    public function edit_account(Request $request){

        $usuarios=User::findOrFail(Auth::user()->id);
        $logo = logo_user::where('user_id',Auth::user()->id)->first();
        if(count($logo)<1){$logo_user = new logo_user();} else{ $logo_user = $logo;}


        $usuarios->fill($request->all());

            $usuarios->name=$request->get('name');
            $usuarios->lastname=$request->get('lastname');
            $usuarios->email=$request->get('email');
            $usuarios->username=$request->get('username');
            $logo_user->value=$request->get('value');
            $logo_user->user_id= Auth::user()->id;

            $logo_user->save();
            $usuarios->save();

            flash()->overlay('Datos actualizados correctamente','');
            return redirect()->back();

	}
}
