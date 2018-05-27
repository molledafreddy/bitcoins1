<?php

namespace App\Http\Controllers\Admin;

use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\logo_user;

class UsersController extends Controller
{
    private function isAdmin()
    {
        if (Auth::user()->type == 'A') return true;
        else return false;
    }    

    public function index()
    {
        if ($this->isAdmin()) {
            $logo_user = logo_user::logo();

            return view('admin.users.index')->with(['logo_user'=>$logo_user]);
        } else {
            return redirect()->route('siteHome');
        }
    }

    public function main()
    {
        return view('admin.users.async')->with('type', __FUNCTION__);
    }
    public function create()
    {
        return view('admin.users.async')->with('type', __FUNCTION__);
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.async')->with('type', __FUNCTION__)->with('user', $user);
    }

    public function store()
    {
        $request = request();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,',
        ]);

        if ($validator->passes()) {
            $user = new User($request->all());
            $user->password = Hash::make($request->password);
            $user->is_active = 0;
            $user->save();
            $response = ['message' => 'Usuario registrado con exito.'];
            return response()->json($response);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function update($id)
    {
        $request = request();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        if ($validator->passes()) {
            $user = User::find($id);

            $nombre = $user->name;
            $status_actual = $user->is_active;


            $user->fill($request->all());
            $user->save();

            $response = ['message' => 'Usuario actualizado con exito.'];
            return response()->json($response);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->is_active= '9';
        $user->type= 'S';
        $user->email= 'usuario'.$user->id.' '.$user->name.' eliminado ';
        $user->save();


    }

    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('admin.users.index');
        }
    }

    public function getDataTables($type) {
        $users = User::select('id', 'name', 'lastname', 'email', 'username', 'is_active', 'created_at')->where('type', $type);

        return Datatables::of($users)
                ->editColumn('created_at', function($users) {
                    return $users->created_at->format('d/m/Y');
                })
                ->addColumn('status', function($users) {
                    $color = $users->is_active == 1 ? 'green' : 'red';
                    return '<i class="fa fa-circle" style="color: '.$color.'" aria-hidden="true"></i>';
                })
                ->addColumn('actions', function($users) {
                    return '<a href="'.route('admin.users.async', ['edit', 'id'=> $users->id]).'" class="btn btn-xs btn-primary edit" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i> Editar</a>&nbsp;<a href="'.route('admin.users.async', ['delete', 'id'=> $users->id]).'" class="btn btn-xs btn-danger function delete" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fa fa-trash"></i> Eliminar</a>';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
    }
}