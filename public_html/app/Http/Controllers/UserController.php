<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id','!=',Auth::user()->id)->orderBy('id','desc')->get();
        return view('admin.users.index',compact('user'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $check = User::where('email',$request->email)->first();
        if(isset($check)){
            return back()->with('error','User Already exist!');
        }
        
        if($request->password != $request->confirm_password){
            return back()->with('error','Confirm password mot match!');
        }
        $user = new User;
        $user->name = $request->username;
        $user->email = $request->email;
        $user_type = 'user';
        if(!empty($request->role)){
         foreach($request->role as $value){
            if($value == 'Admin'){
                $user_type = 'admin';
            }
         }
        }
    
        $user->user_type = $user_type;
        $user->password = Hash::make($request->password);

        $user->role = !empty($request->role) ? json_encode($request->role) : '';
        $user->save();
        return back()->with('success','User Successfully created!');

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
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        return view('admin.users.create',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_type = 'user';
        if(!empty($request->role)){
            foreach($request->role as $value){
            if($value == 'Admin'){
                $user_type = 'admin';
            }
            }
        }
        
       User::where('id',$id)->update([
        'name' => $request->username,
        'email' => $request->email,
        'role' => !empty($request->role) ? json_encode($request->role) : '',
        'user_type' => $user_type,
       ]);
       return back()->with('success','User Successfully Updated!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return back()->with('success','User Successfully deleted!');
    }
}
