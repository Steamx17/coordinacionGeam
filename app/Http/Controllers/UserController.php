<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:User.index')->only('index');
        $this->middleware('can:User.create')->only('create', 'store');
        $this->middleware('can:User.edit')->only('edit', 'update');
        $this->middleware('can:User.destroy')->only('destroy');
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Users = User::all();


        return view('Users.index', compact('Users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $roles = Role::all();


        // dd($roles);

        return view('Users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => 'required|unique:users',
            'roles' => 'required',

        ]);

        $User =  User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        
        $User->roles()->sync($request->roles);
        return redirect()->route('User.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        $roles = Role::all();

        // $roles= Auth::user()->getRoleNames();

        // dd($roles);


        return view('Users.edit', compact('User', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        // debemos aceder a la tabla intermedia de la relacion con los roles, esa tabla es model_has_rol

        $User->roles()->sync($request->roles);

        return redirect()->route('User.edit', $User)->with('info', 'se asigno los roles correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        $User->delete();
        return redirect()->route('User.index');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $userx = User::where('id', $id)->first();

        $rol = Auth::user()->getRoleNames();
        //dd($userx);

        return view('Users.profile', compact('userx', 'rol'));
    }
}
