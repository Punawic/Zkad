<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use Auth;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaignQuery = Campaign::orderBy('id','desc');
        if(Auth::user()->user_type != 'admin'){
            $campaignQuery->where('user_id',Auth::user()->id);
        }
        $campaign = $campaignQuery->get();

        $activeQuery = Campaign::where('status',1)->orderBy('id','desc');
        if(Auth::user()->user_type != 'admin'){
            $activeQuery->where('user_id',Auth::user()->id);
        }
        $active = $activeQuery->get();

        $inActiveQuery = Campaign::where('status',0)->orderBy('id','desc');
        if(Auth::user()->user_type != 'admin'){
            $inActiveQuery->where('user_id',Auth::user()->id);
        }
        $inActive = $inActiveQuery->get();

        return view('admin.campaign.index',compact('campaign','active','inActive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        $keyword = '';
        if(isset($request->key)) {
            foreach($request->key as $value){
                $keyword .= $value.',';
            }                
        }

        // return $request
        $campaign = new Campaign;
        $campaign->user_id = Auth::user()->id;
        $campaign->campaign_id = $request->campaign_id;
        $campaign->campaign_name = $request->campaign_name;
        $campaign->page_id = $request->page_id;
        $campaign->budget = $request->budget;
        $campaign->keyword = $keyword;
        $campaign->duty = $request->duty;
        $campaign->product_name = $request->product_name;
        $campaign->location = $request->location;
        $campaign->sale_price = $request->sale_price;
        $campaign->description = $request->description;
        $campaign->status = $request->status == 'on' ? 1 : 0;
        if($request->hasFile('image')){
            $campaign->image = $request->image->store('campaign');
        }
        $campaign->save();

        // return back()->with('success','Campaign Successfully created!');
        return redirect(route('campaign.index'))->with('success','Campaign Successfully created!');

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
        $campaign = Campaign::where('id',$id)->first();
        return view('admin.campaign.create',compact('campaign'));
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
        $keyword = '';
        if(isset($request->key)) {
            foreach($request->key as $value){
                $keyword .= $value.',';
            }                
        }

        Campaign::where('id',$id)->update([
            'campaign_id' => $request->campaign_id,
            'campaign_name' => $request->campaign_name,
            'page_id' => $request->page_id,
            'budget' => $request->budget,
            'keyword' => $keyword,
            'duty' => $request->duty,
            'product_name' => $request->product_name,
            'location' => $request->location,
            'description' => $request->description,
            'status' => $request->status == 'on' ? 1 : 0,
        ]);
        if($request->hasFile('image')){
            Campaign::where('id',$id)->update([
                
                'image' => $request->image->store('campaign'),
            ]);
        }
        
        
        return back()->with('success','Campaign Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Campaign::where('id',$id)->delete();
        return back()->with('success','Campaign Successfully deleted!');
    }
}
