<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Sale;
use App\Models\Shipping;
use Auth;

class ShippingController extends Controller
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


        $shippingQuery = Shipping::orderBy('id','desc');
       
        // if(Auth::user()->user_type != 'admin'){
        //     $saleQuery->where('user_id',Auth::user()->id);
        // }
        $shipping = $shippingQuery->get();

        return view('admin.shipping.index',compact('campaign','shipping'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shipping= new Shipping;
        $shipping->user_id = Auth::user()->id;
        $shipping ->date = $request->date;
        $shipping ->shipping_cost = $request->shipping_cost;
        $shipping ->save();
        return redirect()->back()->with('success','Shipping Cost Successfully created!');
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
        Shipping::where('id',$id)->delete();
        return redirect()->back()->with('success','Shipping Successfully deleted!');
    }

    public function export_excel(Request $request)
    {    
        $dates = [];
        
        foreach (explode('-', $request->daterange) as $key => $value) {
            $dates[$key] = $value;
        }
        
        $start_date = date('Y-m-d', strtotime(trim($dates[0])));
        $end_date = date('Y-m-d', strtotime(trim($dates[1])));
        
        $csv_info = Shipping::where('date','>=',$start_date)->where('date','<=',$end_date)->get();

        $fileName = 'report -'.Auth::user()->name.'-'.date('Y-m-d H:i:s a').'.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('#','DATE','Shipping Cost');

        $callback = function() use($csv_info, $columns) {
            $file = fopen('php://output', 'w'); 
            fputcsv($file, $columns);

            foreach ($csv_info as $key => $value) {
                $row['no']  = $key + 1;
                $row['date']  = $value->date; 
                $row['shipping_cost']  = $value->shipping_cost;              
                
                
                fputcsv($file, array(
                    $row['no'],
                    $row['date'],
                    $row['shipping_cost'],
                    
                ));
            }


            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
