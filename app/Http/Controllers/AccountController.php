<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();

        return view('account/list',['users' => $users]);
    }

    public function create(){

        return view('account/create');
    }
    public function create_proses(Request $request){

        $this->validate($request,[
            "name"              => "required|min:6",
            "email"                 => "required|email|unique:users,email",
            "password"              => "required|min:6",
            "confirm_password" => "same:password"
            ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]);

        return redirect('account/')->with('register_success', '<div class="alert alert-success"><h5> <span class=" fa fa-check" ></span>Data berhasil ditambahkan.</h5></div>');
    }

    public function update($id){

        $users = DB::table('users')->where('id',$id)->get();

        return view('account/update',['users' => $users]);
    }

    public function update_proses(Request $request){
        $this->validate($request,[
            "name"              => "required|min:6",
            "email"                 => "required|email|unique:users,email",
            "password"              => "required|min:6",
            "confirm_password" => "same:password"
            ]);


        DB::table('users')->where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'updated_at' => date("Y-m-d H:i:s")
            ]);

        return redirect('account/')->with('register_success', '<div class="alert alert-success"><h5> <span class=" fa fa-check" ></span>Data berhasil ditambahkan.</h5></div>');
    }

    public function delete($id)
    {
        DB::table('users')->where('id',$id)->delete();
        
        return redirect('account/')->with('register_success', '<div class="alert alert-success"><h5> <span class=" fa fa-check" ></span>Data berhasil dihapus.</h5></div>');
    }
}
