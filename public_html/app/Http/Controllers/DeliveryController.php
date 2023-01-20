<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Delivery;
use Auth;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveryQuery = Delivery::orderBy('id','desc');
        if(Auth::user()->user_type != 'admin'){
            $deliveryQuery->where('user_id',Auth::user()->id);
        }
        $delivery = $deliveryQuery->get();


        $campaignQuery = Campaign::orderBy('id','desc');
        if(Auth::user()->user_type != 'admin'){
            $campaignQuery->where('user_id',Auth::user()->id);
        }
        $campaign = $campaignQuery->get();

        return view('admin.delivery.index',compact('campaign','delivery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $delivery = new Delivery;
        $delivery->user_id = Auth::user()->id;
        $delivery->page_campaign_name = $request->page_campaign_name;
        $delivery->cost = $request->cost;
        $delivery->delivery_fee = $request->delivery_fee;
        $delivery->cod = $request->cod;
        $delivery->save();
        return redirect()->back()->with('success','Delivery Successfully created!');
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
        $campaign = Campaign::orderBy('id','desc')->get();
        $delivery = Delivery::where('id',$id)->first();
        return view('admin.delivery.create',compact('delivery','campaign'));
        
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
        Delivery::where('id',$id)->update([
            'page_campaign_name' => $request->page_campaign_name,
            'cost' => $request->cost,
            'delivery_fee' => $request->delivery_fee,
            'cod' => $request->cod,
        ]);
        return redirect()->back()->with('success','Delivery Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Delivery::where('id',$id)->delete();
        return redirect()->back()->with('success','Delivery Successfully deleted!');

    }
}
