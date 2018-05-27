<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AccountType;
use Carbon\Carbon;
use Image;
use Log;
use App\logo_user;

class AccountTypeController extends Controller
{
   
    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('account-types.index');
        }
    }

     public function index()
    {
        $logo_user = logo_user::logo();

        return view('admin.account-types.index')->with(['logo_user'=>$logo_user]);
    }

    public function main()
    {
    	$accountTypes = AccountType::where("status","1")->get();
        return view('admin.account-types.async',compact("accountTypes"))->with('type', __FUNCTION__);
    }
    
    public function create()
    {    	  	
        return view('admin.account-types.async')->with('type', __FUNCTION__);
        
    } 


    public function editar($id)
    {           
        // return view('admin.account-type.async')->with('type', __FUNCTION__);
        $accountType = AccountType::find($id); 
                
        return view('admin.account-types.async',compact("accountType"))->with('type', __FUNCTION__);
    }    
    

    public function store(Request $request)
    {
        Log::debug('logo : '.$request->name);
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

    	$accountType = new AccountType();
        $accountType->name = $request->name;            
    	$accountType->description = $request->description;    		
        $accountType->status = 1;
        $accountType->logo = $image;
		$accountType->type = $request->type;
		$accountType->save();   	
    

        return response()->json(['mensaje'=>'Los datos se han guardado con éxito','id'=>$accountType->id]);
    	
    }

    
    public function edit($id)
    {   
        $accountType = AccountType::find($id); 
        	  	
        return view('admin.account-types.async',compact("accountType"))->with('type', __FUNCTION__);
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
        return $request;    

        // $carbon = Carbon::now()->format('dmYHis');
        // $image = $carbon.'.'.$request->logo->getClientOriginalExtension();      
        // if($request->logo->move(public_path('images/logos/'), $image)){         
        //     $url='images/logos/'.$image;
        //     $img = Image::make($url);
        //     $width = $img->width();
        //     $height = $img->height();
        //     //si la imagen es cuadrada
        //     if($width == $height){
        //         $img->fit(75);                
        //     }else{
        //         $heightImg = 75;
        //         $widthImg = (integer) (($heightImg * $width)/$height);
        //          $img->fit($widthImg,$heightImg); 
        //     }
        //     $img->save('images/logos/'.$image);           
        // }
      

    	$accountType = AccountType::find($id);
        $accountType->name=$request->name;
        $accountType->description=$request->description;
        // $accountType->logo = $image;
        $accountType->type = $request->type;
        $accountType->save();
        

        return response()->json(['mensaje'=>'Los datos se han actualizado con éxito']);
    }

    public function destroy($id)
    {

	  	AccountType::destroy($id);
    	$response = array('Status' => '1', 'Message' => 'Proceso realizado con exíto!');
        return $response;
    }


}
