<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;
use Feeds;
use View;
use App\User;
use App\Offer;
use App\ContentType;
use App\LoadContent;
use App\UserChat;
use App\Message;
use App\Comment;
use App\Events\NewMessageAdded;
use Mail;
use Session;

class HomeController extends Controller
{

    public function __construct()
	{
    	$this->middleware('2fa', ['only' => ['index']]);
	}

    public function index(){

	    	$feed = Feeds::make('https://news.google.com/news/rss/search/section/q/criptomonedas/criptomonedas?hl=es-419&gl=CO&ned=es_co', 5, true);
	    	$data = array('items' => $feed->get_items(),'comments'=> Comment::where('status','si')->get());

			return View::make('welcome', $data)->with('type', '');

	}

	public function renewRegistration()
    {
        $google2fa = app('pragmarx.google2fa');

        $secret = $google2fa->generateSecretKey();

        // Create the QR image.
        $qr_image = $google2fa->getQRCodeInline(
            config('app.name'),
            Auth::user()->email,
            $secret
        );
        $user=User::findOrFail(Auth::user()->id);
        $user->google2fa_secret=$secret;
        $user->save();
        return view('google2fa.update')->with(['secret' => $secret, 'qr_image' => $qr_image]);
    }

	public function buy_offers(){

		return view('site.buy_offers');

	}

	public function sell_offers(){

		return view('site.sell_offers');

	}

	public function buys(){

		$offers = Offer::where("type",'buy')->where('status',1)->where('verificada',1)->get();
		return view('site.template.partials.buys')->with('offers',$offers);

	}

	public function sells(){
		$offers = Offer::where("type",'seller')->where('status',1)->where('verificada',1)->get();
    return view('site.template.partials.sells')->with('offers',$offers);;

	}

	public function about_us(){
		return view('site.about_us');

	}

	public function contact(){
		return view('site.contact');

	}
  public function contactStore(Request $request){
    $request->validate([
      'nombre' => 'required|min:3',
      'email' => 'required|email',
      'asunto' => 'required',
      'mensaje' => 'required|min:3',
    ]);

    $correos_admin = User::where('type', 'A')->pluck("email");
    $data = [
      "nombre" => $request->nombre,
      "email" => $request->email,
      "asunto" => $request->asunto,
      "mensaje" => $request->mensaje
    ];
    foreach($correos_admin as $correo){
        Mail::send('email.emailContactoAdmin', ['data' => $data], function($msj) use ($correo) {
            $msj->subject('Contacto');
            $msj->to($correo);
        });
    }


    $response = ['message' => 'Correo enviado con exito.'];
    return response()->json($response);

  }

	public function services(){
		return view('site.services');

	}

	public function comments(){
		return view('site.comments');

	}

	public function home(){
		$chat = UserChat::select('chat_id')->where('user_id', 1)->first();

        if ($chat) {
            $messages = Message::with('user')->where('chat_id', $chat->chat_id)->get();

        }

        return view('home', compact('messages'));

	}

	public function search(Request $request)
    {
        $quantity = $request->quantity;
        $type = $request->type;
        $moneda = $request->moneda;

        $offers = Offer::where('verificada', 1)->type($type)->quantity($quantity,$moneda)->get();        

        return view('site.template.partials.wireframe',compact("offers","$offers"))->with('type', 'search');
    }

    public function content()
    {
       return $content = ContentType::select('content_types.name', 'content_types.status', 'content_types.id')
       ->join('load_contents AS j', 'j.content_type_id', '=', 'content_types.id')
       ->where('j.status',1)
       ->get();
    }

    public function load_home_content($id)
    {
    	$content=LoadContent::where('content_type_id',$id)->get()->first();
    	if($content){
       	return view('site.content')->with('content', $content);
       }else{
       	return redirect()->route('siteHome');
       }
    }

    public function terms_cond()
    {
       return $content = LoadContent::where('content_type_id',2)->get()->first();
    }

    public function salida(){
        Auth::logout();
        Session::flush();
        flash()->overlay('Sesión Cerrada por Inactividad', '');
        return redirect()->route('siteHome');
    }

}
