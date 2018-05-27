<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LoadContent;
use App\ContentType;
use App\logo_user;

class LoadContentController extends Controller
{
    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('load-contents.index');
        }
    }

     public function index()
    {            $logo_user = logo_user::logo();

        return view('admin.load-contents.index')->with(['logo_user'=>$logo_user]);
    }

    public function main()
    {
    	$loadContents = LoadContent::where("status",1)->get();
        return view('admin.load-contents.async',compact("loadContents"))->with('type', __FUNCTION__);
    }

    public function create()
    {
    	$loadContentNot = LoadContent::where("status",1)->pluck('content_type_id')->all();   
    	$contentTypes = ContentType::where("status",1)->whereNotIn('id', $loadContentNot)->get();    	
        return view('admin.load-contents.async',compact("contentTypes"))->with('type', __FUNCTION__);
    }

    public function store(Request $request)
    {
    	$request->validate([
	        'content_type_id' => 'required',                         
        ]);  

        $loadContent = new LoadContent($request->all());
        $loadContent->status=1;
        $loadContent->save();

        return response()->json(['mensaje'=>'Los datos se han guardado con éxito']);
    	
    }

    public function edit($id)
    {
    	$loadContent = LoadContent::find($id);    	  	
        return view('admin.load-contents.async',compact("loadContent"))->with('type', __FUNCTION__);
    }

    public function update($id)
    {
    	$request = request();
    	$loadContent = LoadContent::find($id);
        $loadContent->template=$request->template;
        $loadContent->save();

        return response()->json(['mensaje'=>'Los datos se han actualizado con éxito']);
    }

    public function destroy($id)
    {
    	LoadContent::destroy($id);
    	$response = array('Status' => '1', 'Message' => 'Delete completed!');
        return $response;
    }
}
