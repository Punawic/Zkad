<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $activeQuery = Page::where('status',1)->orderBy('id','desc');
        if(Auth::user()->user_type != 'admin'){
            $activeQuery->where('user_id',Auth::user()->id);
        } 
        $active = $activeQuery->get();     

        $inActiveQuery = Page::where('status',0);

        if(Auth::user()->user_type != 'admin'){
            $inActiveQuery->where('user_id',Auth::user()->id);
        } 

        $inActive = $inActiveQuery->get(); 

        $pageQuery = Page::orderBy('id','desc');

        if(Auth::user()->user_type != 'admin'){
            $pageQuery->where('user_id',Auth::user()->id);
        } 

        $page = $pageQuery->get(); 
        
        return view('admin.pages.index',compact('page','active','inActive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Page::where('name',$request->name)->first();
        if(isset($check)){
            return back()->with('error','Page Already exist!');
        }

        $page = new Page;
        $page->user_id = Auth::user()->id;
        $page->name = $request->name;
        $page->status = $request->status == 'on' ? 1 : 0;
        if($request->hasFile('image')){

            $page->image = $request->image->store('page');
        }
        $page->save();
        return back()->with('success','Page Successfully Created!');
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
        $page = Page::where('id',$id)->first();
        return view('admin.pages.create',compact('page'));
        
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
        Page::where('id',$id)->update([
            'name' => $request->name,
            'status' => $request->status == 'on' ? 1 : 0,
        ]);

        if($request->hasFile('image')){
            Page::where('id',$id)->update([
                'image' => $request->image->store('page'),
            ]);
        }

        return back()->with('success','Page Successfully Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::where('id',$id)->delete();
        return back()->with('success','Page Successfully deleted!');
    }
}
