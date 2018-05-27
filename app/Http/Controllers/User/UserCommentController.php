<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Comment;

class UserCommentController extends Controller
{
  
    public function store()
    {
        $request = request();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->passes()) {
            $comment = new Comment($request->all());
            $comment->status = 'no';
            $comment->save();

            $response = ['message' => 'Comentario enviado con exíto.'];
            return response()->json($response);
         }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

}
