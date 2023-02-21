<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        $no = 1;
        return view('Users.index',['datas'=>$data,'no'=>$no]);
    }

    public function create(){
        return view('Users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'user_name' => 'required|max:80',
            'user_photoProfile'=> 'image|file|max:1024',
            'password' => 'required|min:8|max:255',
            'user_role' => 'required', 
        ]);
        if($request->file('user_photoProfile')){
            $validatedData['user_photoProfile'] = $request->file('user_photoProfile')->store('user-profile');
            User::create($validatedData);
        }
        
        // $validatedData['password'] = Hash::make($validatedData['password']); hash pw
        return redirect()->route('Users.home');
    }

    public function edit(User $data){
        $a = $data['user_role'];
        $a===0 ? $a='Operator':($a===1 ?$a='Admin':$a='User'); //cek user_role
        return view('Users.update', ['data'=>$data,'user_role'=>$a]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        // return view('Users.show',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $data)
    {
        
        $validatedData = $request->validate([
            'user_name' => 'required|max:80',
            'user_photoProfile'=> 'image|file|max:1024',
            'password' => 'required|min:8|max:255', 
        ]);
        if($request->file('user_photoProfile')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['user_photoProfile'] = $request->file('user_photoProfile')->store('user-profile');
        }
        
        $user = User::findOrFail($data);
        $user->update($validatedData);
        return redirect()->route('Users.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $data)
    {

        if($data->user_photoProfile){
            Storage::delete($data->user_photoProfile);

        }
        $user  = User::findOrFail($data->id);
        $user->delete();

        return redirect()->route('Users.home');
    }
}
