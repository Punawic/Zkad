<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Sale;
use App\Models\Advertising;
use Auth;

class AdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaignQuery = Campaign::orderBy('id','desc')->where('status','1');
        // if(Auth::user()->user_type != 'admin'){
        //     $campaignQuery->where('user_id',Auth::user()->id);
        // }
        $campaign = $campaignQuery->get();


        $advertisingQuery = Advertising::orderBy('id','desc');
       
        // if(Auth::user()->user_type != 'admin'){
        //     $saleQuery->where('user_id',Auth::user()->id);
        // }
        $advertising = $advertisingQuery->get();

        return view('admin.advertising.index',compact('campaign','advertising'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertising.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $advertising = new Advertising;
        $advertising->user_id = Auth::user()->id;
        $advertising ->sale_date = $request->sale_date;
        $advertising ->page_campaign_name = $request->page_campaign_name;
        $advertising ->advert = $request->advert;
        $advertising ->save();
        return redirect()->back()->with('success','Sale Successfully created!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Advertising::where('id',$id)->delete();
        return redirect()->back()->with('success','Sale Successfully deleted!');
    }

    public function export_excel(Request $request)
    {    
        $dates = [];
        
        foreach (explode('-', $request->daterange) as $key => $value) {
            $dates[$key] = $value;
        }
        
        $start_date = date('Y-m-d', strtotime(trim($dates[0])));
        $end_date = date('Y-m-d', strtotime(trim($dates[1])));
        
        $csv_info = Advertising::where('sale_date','>=',$start_date)->where('sale_date','<=',$end_date)->get();

        $fileName = 'report -'.Auth::user()->name.'-'.date('Y-m-d H:i:s a').'.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('#','DATE','PAGE NAME','Advertising Cost');

        $callback = function() use($csv_info, $columns) {
            $file = fopen('php://output', 'w'); 
            fputcsv($file, $columns);
            
            $total = 0;
            foreach ($csv_info as $key => $value) {
                $row['no']  = $key + 1;
                $row['sale_date']  = $value->sale_date; 
                $row['page_campaign_name']  = $value->page_campaign_name;
                $row['advert']  = $value->advert;                
                
                $total += $value->sale;
                fputcsv($file, array(
                    $row['no'],
                    $row['sale_date'],
                    $row['page_campaign_name'],
                    $row['advert'],
                ));
            }

            

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
