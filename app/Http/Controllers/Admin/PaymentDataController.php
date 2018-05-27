<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentData;
use App\PaymentDataDetail;
use Carbon\Carbon;
use Image;
use App\logo_user;

class PaymentDataController extends Controller
{
    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('payment-data.index');
        }
    }

     public function index()
    {   $logo_user = logo_user::logo();

        return view('admin.payment-datas.index')->with(['logo_user'=>$logo_user]);
    }

    public function main()
    {
    	$paymentDatas = PaymentData::where("status","1")->get();
        return view('admin.payment-datas.async',compact("paymentDatas"))->with('type', __FUNCTION__);
    }


    public function create()
    {
        return view('admin.payment-datas.async')->with('type', __FUNCTION__);
    }


    public function store(Request $request)
    {
    	$request->validate([
	        'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'logo' => 'required |image',
        ]);

        $carbon = Carbon::now()->format('dmYHis');
        $image = $carbon.'.'.$request->logo->getClientOriginalExtension();
        if($request->logo->move(public_path('images/logos/'), $image)){
            $url='images/logos/'.$image;
            $img = Image::make($url);
            $width = $img->width();
            $height = $img->height();
            //si la imagen es cuadrada
            if($width == $height){
                $img->fit(75);
            }else{
                $heightImg = 75;
                $widthImg = (integer) (($heightImg * $width)/$height);
                 $img->fit($widthImg,$heightImg);
            }
            $img->save('images/logos/'.$image);
        }

    	$paymentData = new PaymentData();
        $paymentData->name = $request->name;
    	$paymentData->description = $request->description;
        $paymentData->status = 1;
        $paymentData->logo = $image;
		$paymentData->type = $request->type;
		$paymentData->save();


        return response()->json(['mensaje'=>'Los datos se han guardado con éxito','id'=>$paymentData->id]);

    }

    public function edit($id)
    {
    	$paymentData = PaymentData::find($id);
    	$paymentDataDetails = PaymentDataDetail::where("payment_data_id",$id)->get();
        return view('admin.payment-datas.async',compact("paymentData","paymentDataDetails"))->with('type', __FUNCTION__);
    }


    public function update($id)
    {
    	$request = request();
    	$request->validate([
	        'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'logo' => 'sometimes |image',
        ]);

        $paymentData = PaymentData::find($id);
        if ($request->has('logo')) {
            $carbon = Carbon::now()->format('dmYHis');
            $image = $carbon.'.'.$request->logo->getClientOriginalExtension();
            if($request->logo->move(public_path('images/logos/'), $image)){
                $url='images/logos/'.$image;
                $img = Image::make($url);
                $width = $img->width();
                $height = $img->height();
                //si la imagen es cuadrada
                if($width == $height){
                    $img->fit(75);
                }else{
                    $heightImg = 75;
                    $widthImg = (integer) (($heightImg * $width)/$height);
                     $img->fit($widthImg,$heightImg);
                }
                $img->save('images/logos/'.$image);
                $paymentData->logo = $image;
            }
        }
        $paymentData->name=$request->name;
        $paymentData->description=$request->description;
        $paymentData->type = $request->type;
        $paymentData->save();

        return response()->json(['mensaje'=>'Los datos se han actualizado con éxito']);
    }

    public function destroy($id)
    {
	  	$paymentDataDetailDelete = paymentDataDetail::where("payment_data_id",$id)->delete();
    	PaymentData::destroy($id);
    	$response = array('Status' => '1', 'Message' => 'Delete completed!');
        return $response;
    }

}
