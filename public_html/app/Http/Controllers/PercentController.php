<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PercentDay;
use App\Models\PercentPage;
use App\Models\Campaign;
use App\Models\Page;
use Auth;

class PercentController extends Controller
{
    public $search;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $percentDay = PercentDay::orderBy('id','desc')->get();
        return view('admin.percent.index',compact('percentDay'));
    }

    public function destroyByDay($id)
    {
        PercentDay::where('id',$id)->delete();
        return redirect()->back()->with('success','Percent by Day Successfully deleted!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.percent.create');
         if(isset($_GET['from']) && !empty($_GET['from'])){
            $percentPage = PercentPage::where('date','>=',$_GET)
            ->where('date','<=',$_GET['to'])
            ->get();
            // echo '<pre>';
            // return print_r($percentPage);

         }else{

             $percentPage = PercentPage::orderBy('id','desc')->get();
         }
        
        $campaign = Campaign::orderBy('id','desc')->get();
        return view('admin.percent.percent-by-page.index',compact('campaign','percentPage'));

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     * @return \Illuminate\Http\Response
     */

    public function percentByPagesearch()
    {
        
        if(isset($_GET['search'])){
            $percentPage = Page::where('name','LIKE',$_GET['search'])->get();
       
        }else{
            $percentPage = PercentPage::orderBy('id','desc')->get();
        }

        $campaign = Campaign::orderBy('id','desc')->get();
        return view('admin.percent.percent-by-page.index',compact('percentPage','campaign'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PercentDay::create([     
            'user_id' => Auth::user()->id,
            'return_date' => $request->return_date,
            'total_delivery_shipped' => $request->total_delivery_shipped,
            'successful_shipped' => $request->successful_shipped,
            'in_inventory' => $request->in_inventory,
            'returned_successful' => $request->returned_successful,
            'way_delivery' => $request->way_delivery,
            'way_return' => $request->way_return,
            'damage' => $request->damage,
        ]);
        return redirect()->back()->with('success','Percent by day Successfully Created!');


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
        $percentPage = PercentPage::where('id',$id)->first();
        return view('admin.percent.percent-by-page.create',compact('campaign','percentPage'));
        
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
        PercentPage::where('id',$id)->update([
            'date' => $request->date,
            'page_campaign_name' => $request->page_campaign_name,
            'total_delivery' => $request->total_delivery,
            'recieved' => $request->recieved,
        ]);
        return redirect()->back()->with('success','Percent by Page Successfully Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PercentPage::where('id',$id)->delete();
        return redirect()->back()->with('success','Percent by Page Successfully deleted!');
    }

    public function pageIndex()
    {
        // return null;
        
        return view('admin.percent.percent-by-day.index');
    }

    public function percentByPageStore(Request $request)
    {
        PercentPage::create([
            'user_id' => Auth::user()->id,
            'date' => $request->date,
            'page_campaign_name' => $request->page_campaign_name,
            'total_delivery' => $request->total_delivery,
            'recieved' => $request->recieved,
        ]);
        return redirect()->back()->with('success','Percent by Page Successfully Created!');


    }

    public function export_excel(Request $request)
    {    
        $dates = [];
        
        foreach (explode('-', $request->daterange) as $key => $value) {
            $dates[$key] = $value;
        }
        
        $start_date = date('Y-m-d', strtotime(trim($dates[0])));
        $end_date = date('Y-m-d', strtotime(trim($dates[1])));
        
        $csv_info = PercentDay::where('return_date','>=',$start_date)->where('return_date','<=',$end_date)->get();

        $fileName = 'report -'.Auth::user()->name.'-'.date('Y-m-d H:i:s a').'.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('#','Delivery Date','Total Delivery Shipped','Successful Shipped','In Inventory',
        'Returned Successful','On the way Delivery','On the way Return','Damage&Claim');

        $callback = function() use($csv_info, $columns) {
            $file = fopen('php://output', 'w'); 
            fputcsv($file, $columns);

            $total = 0;
            foreach ($csv_info as $key => $value) {
                $row['no']  = $key + 1;
                $row['return_date']  = $value->return_date;
                $row['total_delivery_shipped']  = $value->total_delivery_shipped;                
                $row['successful_shipped']  = $value->successful_shipped;
                $row['in_inventory']  = $value->in_inventory;
                $row['returned_successful']  = $value->returned_successful;
                $row['way_delivery']  = $value->way_delivery;
                $row['way_return']  = $value->way_return;
                $row['damage']  = $value->damage;

                $total += $value->sale;
                fputcsv($file, array(
                    $row['no'],
                    $row['return_date'] , 
                    $row['total_delivery_shipped'],                
                    $row['successful_shipped'] , 
                    $row['in_inventory'] , 
                    $row['returned_successful'] , 
                    $row['way_delivery'] , 
                    $row['way_return'] ,
                    $row['damage'] , 
                ));
            }


            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function export_excel1(Request $request)
    {    
        $dates = [];
        
        foreach (explode('-', $request->daterange) as $key => $value) {
            $dates[$key] = $value;
        }
        
        $start_date = date('Y-m-d', strtotime(trim($dates[0])));
        $end_date = date('Y-m-d', strtotime(trim($dates[1])));
        
        $csv_info = PercentPage::where('date','>=',$start_date)->where('date','<=',$end_date)->get();

        $fileName = 'report -'.Auth::user()->name.'-'.date('Y-m-d H:i:s a').'.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('#','Date','CAMPAIGN NAME = PRODUCT NAME','Total Delivery',
        'Recieved');

        $callback = function() use($csv_info, $columns) {
            $file = fopen('php://output', 'w'); 
            fputcsv($file, $columns);

            $total = 0;
            foreach ($csv_info as $key => $value) {
                $row['no']  = $key + 1;
                $row['date']  = $value->date;
                $row['page_campaign_name']  = $value->page_campaign_name;                
                $row['total_delivery']  = $value->total_delivery;
                $row['recieved']  = $value->recieved;
               

                $total += $value->sale;
                fputcsv($file, array(
                    $row['no'],
                    $row['date'] , 
                    $row['page_campaign_name'],                
                    $row['total_delivery'] , 
                    $row['recieved'] , 
                  
                ));
            }


            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}



