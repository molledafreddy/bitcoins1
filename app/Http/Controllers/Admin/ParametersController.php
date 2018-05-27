<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ParameterType;
use App\Parameter;
use App\logo_user;

class ParametersController extends Controller
{
    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('parameters.index');
        }
    }

     public function index()
    {            $logo_user = logo_user::logo();

        return view('admin.parameters.index')->with(['logo_user'=>$logo_user]);
    }

    public function main()
    {
    	$parameters = Parameter::where("status",1)->get();
        return view('admin.parameters.async',compact("parameters"))->with('type', __FUNCTION__);
    }

    public function create()
    {
    	$parametersNot = Parameter::where("status",1)->pluck('parameter_type_id')->all();   
    	$parameterTypes = ParameterType::where("status",1)->whereNotIn('id', $parametersNot)->get();    	
        return view('admin.parameters.async',compact("parameterTypes"))->with('type', __FUNCTION__);
    }
    public function store(Request $request)
    {
    	$request->validate([
	        'parameter_type_id' => 'required',                         
	        'value' => 'required',                         
        ]);  

        $parameter = new Parameter($request->all());
        $parameter->status=1;
        $parameter->save();

        return response()->json(['mensaje'=>'Los datos se han guardado con éxito']);
    	
    }

    public function edit($id)
    {
    	$parameter = Parameter::find($id);    	  	
        return view('admin.parameters.async',compact("parameter"))->with('type', __FUNCTION__);
    }

    public function update($id)
    {
    	$request = request();
    	$request->validate([	                             
	        'value' => 'required',                         
        ]);  
    	$parameter = Parameter::find($id);
        $parameter->value=$request->value;
        $parameter->save();

        return response()->json(['mensaje'=>'Los datos se han actualizado con éxito']);
    }
    public function destroy($id)
    {
    	Parameter::destroy($id);
    	$response = array('Status' => '1', 'Message' => 'Delete completed!');
        return $response;
    }
}

