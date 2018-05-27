<?php

namespace App\Http\Controllers\Offers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Mail\OfferEmail;
use Illuminate\Support\Facades\Mail;
use Log;

use App\Offer;
use App\User;
use App\Transaction;
use App\LoadContent;
use App\Parameter;
use App\PaymentData;
use App\ParameterType;
use App\logo_user;
use App\ContentType;

use Auth;
use Feeds;
use View;

class OffersController extends Controller
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

            return view('offers.panel')->with(['logo_user'=>$logo_user]);
        } else {
            return redirect()->route('siteHome');
        }
    }

     public function create_panel()
    {
        $loadContents = LoadContent::whereIn('content_type_id',[4,5])->get();
        $parameters = Parameter::where("status","1")->get();
        $paymentDatas = PaymentData::where("status","1")->get();

        while(!isset($bandera)) {
            $codigo = strtoupper(str_random(8));
            $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
            if (count($buscar_codigo) == 0) {
                $bandera = "1";
            }
        }

        Log::debug('parametros: '.count($parameters));

        $comisionBticoins = ParameterType::find(2)->parameter->value;
        $comisionPesos = ParameterType::find(3)->parameter->value;

        return view('offers.modules.create_offer',compact("loadContents","parameters","paymentDatas","comisionBticoins","comisionPesos","codigo"))->with('type', 'create_panel');

    }

    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('offer.dashboard');
        }
    }

    public function store()
    {
        $request = request();
         // return $request;
        $request->validate([
            'total' => 'required',
            'transaction_number' => 'required',
            'value_offer' => 'required',
            'payment' => 'required',
            'codigo' => 'required',


        ]);
        $comisionBticoins = ParameterType::find(2)->parameter->value;

        $btc = ($request->total * $comisionBticoins)/100;
        $btc = $request->total - $btc;
        $btc = number_format($btc, 8, '.', '');
        $pesos = $request->value_offer;

        $offer = new Offer();
        $offer->user_id = Auth::id();
        $offer->type = $request->type;
        $offer->status = 1;
        $offer->verificada = 0;
        $offer->pesos = $pesos;
        $offer->btc = $btc;
        $offer->save();

        $codigo = $request->codigo;
        $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
        if (count($buscar_codigo) > 0) {
            while(!isset($bandera)) {
                $codigo = strtoupper(str_random(8));
                $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
                if (count($buscar_codigo) == 0) {
                    $bandera = "1";
                }
            }
        }

        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->offer_id = $offer->id;
        $transaction->status = 0;
        $transaction->transaction_number = $request->transaction_number;
        $transaction->unique_code = $codigo;
        $transaction->pay_btc_total = $request->total;
        $transaction->commission = $comisionBticoins;
        $transaction->payment_data_id = $request->payment[0];

        $transaction->save();

        $user = User::find(Auth::id());
        $users = User::where("type","A")->get();
        $correosAdmin = $users->pluck('email');
        $new_transaction = Transaction::with(['user','payment_data'])->find($transaction->id);
        Mail::to($user->email)->send(new OfferEmail(1,$new_transaction));
        Mail::to([])->cc($correosAdmin)->send(new OfferEmail(2,$new_transaction));


        $response = ['message' => 'Publicacion registrada con exíto. Sera verificada por un administrador para su pronta publicación'];
        return response()->json($response);

      }

    public function storeBuy()
    {
        $request = request();
        $request->validate([
            'totalBuy' => 'required',
            'transaction_number_buy' => 'required',
            'value_offer_buy' => 'required',
            'paymentBuy' => 'required',

        ]);
        $comisionPesos = ParameterType::find(3)->parameter->value;

        $btc = $request->totalBuy;
        $pesos = ($request->value_offer_buy * $comisionPesos)/100;
        $pesos = $request->value_offer_buy - $pesos;
        $pesos = number_format($pesos, 2, '.', '');

        $offer = new Offer();
        $offer->user_id = Auth::id();
        $offer->type = $request->typeBuy;
        $offer->status = 1;
        $offer->btc = $btc;
        $offer->pesos = $pesos;
        $offer->verificada = 0;
        $offer->save();

        $codigo = $request->codigo;
        $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
        if (count($buscar_codigo) > 0) {
            while(!isset($bandera)) {
                $codigo = strtoupper(str_random(8));
                $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
                if (count($buscar_codigo) == 0) {
                    $bandera = "1";
                }
            }
        }

        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->offer_id = $offer->id;
        $transaction->transaction_number = $request->transaction_number_buy;
        $transaction->unique_code = $codigo;
        $transaction->pay_pesos_total = $request->value_offer_buy;
        $transaction->commission = $comisionPesos;
        $transaction->status = 0;
        $transaction->payment_data_id = $request->paymentBuy[0];

        $transaction->save();
        $user = User::find(Auth::id());
        $users = User::where("type","A")->get();
        $correosAdmin = $users->pluck('email');

        $new_transaction = Transaction::with(['user','payment_data'])->find($transaction->id);
        Mail::to($user->email)->send(new OfferEmail(1,$new_transaction));
        Mail::to([])->cc($correosAdmin)->send(new OfferEmail(2,$new_transaction));

        $response = ['message' => 'Publicacion registrada con exíto. Sera verificada por un administrador para su pronta publicación'];
        return response()->json($response);




    }
    public function getDataPayment()
    {

        $comisionBticoins = ParameterType::find(2)->parameter->value;
        $comisionPesos = ParameterType::find(3)->parameter->value ;

        $response = [
            'comisionBticoins' => $comisionBticoins,
            'comisionPesos' => $comisionPesos,
        ];

        return response()->json($response);

    }

    public function buy_offer($id)
    {
        $logo_user = logo_user::logo();
        $condicionesCompra = ContentType::find(5)->load_contents->template;
        $parameters = Parameter::where("status","1")->get();
        $paymentDatas = PaymentData::where("status","1")->get();

        $comisionBticoins = ParameterType::find(2)->parameter->value;
        $comisionPesos = ParameterType::find(3)->parameter->value;
        $transaction = Transaction::where('offer_id',$id);
        $offer = Offer::find($id);

        while(!isset($bandera)) {
            $codigo = strtoupper(str_random(8));
            $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
            if (count($buscar_codigo) == 0) {
                $bandera = "1";
            }
        }

        return view('offers.modules.buy_offer',compact("logo_user","condicionesCompra","parameters","paymentDatas","comisionBticoins","comisionPesos", "offer","codigo"));
    }

    public function sell_offer($id)
    {   $logo_user = logo_user::logo();
        $condicionesVenta = ContentType::find(4)->load_contents->template;
        $parameters = Parameter::where("status","1")->get();
        $paymentDatas = PaymentData::where("status","1")->get();

        $comisionBticoins = ParameterType::find(2)->parameter->value;
        $comisionPesos = ParameterType::find(3)->parameter->value;
        $transaction = Transaction::where('offer_id',$id);
        $offer = Offer::find($id);

        while(!isset($bandera)) {
            $codigo = strtoupper(str_random(8));
            $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
            if (count($buscar_codigo) == 0) {
                $bandera = "1";
            }
        }

        return view('offers.modules.sell_offer',compact("logo_user","condicionesVenta","parameters","paymentDatas","comisionBticoins","comisionPesos", "offer","codigo"));
    }

    public function buy_offer_pay()
    {

        $request = request();

        $request->validate([
            'transaction_number' => 'required',
            'paymentBuy' => 'required',
        ]);

        $codigo = $request->codigo;
        $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
        if (count($buscar_codigo) > 0) {
            while(!isset($bandera)) {
                $codigo = strtoupper(str_random(8));
                $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
                if (count($buscar_codigo) == 0) {
                    $bandera = "1";
                }
            }
        }

        $offer = Offer::find($request->offer_id);
        $offer->status=2;
        $offer->save();

        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->offer_id = $request->offer_id;
        $transaction->transaction_number = $request->transaction_number;
        $transaction->unique_code = $codigo;
        $transaction->pay_btc_total = $offer->btc;
        $transaction->payment_data_id = $request->paymentBuy[0];
        $transaction->status = 0;
        $transaction->save();

        flash()->overlay('Su transaccion de Compra sera evaluada y recibira respuesta en los proximos minutos','');
        return redirect()->route('user.panel');
    }

    public function sell_offer_pay()
    {

        $request = request();

        $request->validate([
            'transaction_number' => 'required',
            'payment' => 'required',
        ]);

        $offer = Offer::find($request->offer_id);
        $offer->status=2;
        $offer->save();

        $codigo = $request->codigo;
        $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
        if (count($buscar_codigo) > 0) {
            while(!isset($bandera)) {
                $codigo = strtoupper(str_random(8));
                $buscar_codigo = Transaction::where('unique_code', $codigo)->get();
                if (count($buscar_codigo) == 0) {
                    $bandera = "1";
                }
            }
        }

        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->offer_id = $request->offer_id;
        $transaction->transaction_number = $request->transaction_number;
        $transaction->unique_code = $codigo;
        $transaction->payment_data_id = $request->payment[0];
        $transaction->pay_pesos_total = $offer->pesos;
        $transaction->status = 0;
        $transaction->save();

        flash()->overlay('Su transaccion de Venta sera evaluada y recibira respuesta en los proximos minutos','');
        return redirect()->route('user.panel');
    }
}
