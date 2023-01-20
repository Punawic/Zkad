<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class SettingController extends Controller
{
   public function index()
   {
      return view('admin.setting');
   }

   public function update(Request $request)
   {
      User::where('id',Auth::user()->id)->update([
           'name' => $request->username,
        //    'name' => $request->username,
      ]);  
      if($request->hasFile('image')){
        User::where('id',Auth::user()->id)->update([
            'image' => $request->image->store('profile'),
       ]);  
      }
      return back()->with('success','Setting successfully updated!');
   }


   public function UpdatePassword(Request $request)
   {
    if (!empty($request->old_password) AND !empty($request->new_password) AND !empty($request->confirm_password)) {
        if(Hash::check($request->old_password,Auth::user()->password)){
          if($request->new_password == $request->confirm_password){
            User::where('id',Auth::user()->id)->update([
              'password' =>  Hash::make($request->new_password),
            ]);
            return back()->with('success','Password successfully Change');
          }else {
            return back()->with('error','No Confirm password');
          }
        }else{
            return back()->with('error','Invalid password'); 
        }
      }else{
        return back()->with('error','Please enter password');
      }
   }
}
