<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use LRedis;
use App\Message;
use App\UserChat;
use App\Chat;
use Auth;
use App\Events\NewMessageAdded;

class UserChatController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listChat()
    {
        Log::info("ingreso al controlador ChatController@listChat: user: ");
        $messages = [];
        $data = [];

        $chat = UserChat::select('chat_id')->where('user_id', 1)->first();

        if ($chat) {

            $messages = Message::with('user')->where('chat_id', $chat->chat_id)->get();

            foreach ($messages as $key => $value) {
                $data []=[
                    'author'=> $value->user->name,
                    'content' => $value->content,
                    'created_at' => $value->created_at
                 ];
            }

        }
        return $data;

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            // DB::beginTransaction();
            $chat = UserChat::with('user')->where('user_id', 1 )->first();

            if ( count($chat) ) {

                 $message = new Message();
                 $message->user_id = 1;
                 $message->chat_id = $chat->chat_id;
                 $message->content = $request->newMessage['content'];

                 $message->save();

                 $last_message = Message::with('user')->where('id',$message->id)->first();

                 $data =[
                    'author'=> $last_message->user->name,
                    'content' => $last_message->content,
                    'created_at' => $last_message->created_at
                 ];
                 event(
                    new NewMessageAdded($data)
                );
            }else{

                $chat = new Chat();
                $chat->topic = 'chat nuevo';
                $chat->save();

                if ($chat) {
                    Log::debug('id chat: '.$chat->id);
                    $message = new Message();
                    $message->user_id = 1;
                    $message->chat_id = $chat->id;
                    $message->content = $request->newMessage['content'];

                    $message->save();

                    $userChat = new UserChat();
                    $userChat->user_id = 1;
                    $userChat->chat_id = $chat->id;
                    $userChat->save();

                    $last_message = Message::with('user')->where('id',$message->id)->first();

                    $data =[
                        'author'=> $last_message->user->name,
                        'content' => $last_message->content,
                        'created_at' => $last_message->created_at
                    ];

                    event(
                        new NewMessageAdded($data)
                    );
                }

            }


            // DB::commit();
        } catch (\Exception $e) {
            // DB::rollBack();
            Log::error('Ah ocurrido un error en UserChatController@store: ' . $e );
            flash('No se pudo creado el registro', 'error');
            return ['message'=> 'No se pudo enviar el mensaje'];
        }

        return  ['message'=>'El mensaje se envio con exíto'];

    }


    public function room(){
      if(Auth::check()){
        $room = "administrador";
      }else{
        $room ='user';
      }
      return response()->json([
        'room'=> $room
      ]);

    }

    public function userChat()
    {
        try {
            Log::info("ingreso al controlador ChatController@userChat: user: ".request()->id);
            $chat =0;
            $chat_id =0;

            $chat_id = ResourceFunctions::searchChat(Auth::id(), request()->id);

            if (  $chat_id !=0) {
                $chat = Message::with('user')->where('chat_id', $chat_id)->get();
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ah ocurrido un error en MessageController@store: ' . $e );
            flash('No se pudo creado el registro', 'error');
        }

        return [
            'chat' =>$chat,
            'receiver' => User::where('id',request()->id)->get()
        ];
    }
}
