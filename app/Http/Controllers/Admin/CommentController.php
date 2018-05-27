<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\logo_user;

class CommentController extends Controller
{
    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('admin.comment.index');
        }
    }

     public function index()
    {
        $logo_user = logo_user::logo();

        return view('admin.comments.index')->with(['logo_user'=>$logo_user]);
    }

    public function main()
    {
    	$comments = Comment::all();
        return view('admin.comments.async',compact("comments"))->with('type', __FUNCTION__);
    }

    public function edit($id)
    {
    	$comment = Comment::find($id);    	  	
        return view('admin.comments.async',compact("comment"))->with('type', 'edit');
    }

    public function update($id)
    {
    	$request = request();
    	$comment = Comment::find($id);
        $comment->status=$request->status;
        $comment->save();

        return response()->json(['mensaje'=>'Los datos se han actualizado con éxito']);
    }

    public function destroy($id)
    {
    	Comment::destroy($id);
    	$response = array('Status' => '1', 'Message' => 'Delete completed!');
        return $response;
    }
}
