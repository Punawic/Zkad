<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Sale;
use App\Models\Shipping;
use App\Models\Income;
use Auth;

class IncomeController extends Controller
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


        $incomeQuery = Income::orderBy('id','desc');
       
        // if(Auth::user()->user_type != 'admin'){
        //     $saleQuery->where('user_id',Auth::user()->id);
        // }
        $income = $incomeQuery->get();

        return view('admin.income.index',compact('campaign','income'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.income.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $income= new Income;
        $income->user_id = Auth::user()->id;
        $income ->date = $request->date;
        $income ->income = $request->income;
        $income ->save();
        return redirect()->back()->with('success','Income Cost Successfully created!');
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
        Income::where('id',$id)->delete();
        return redirect()->back()->with('success','Income Successfully deleted!');
    }

    public function export_excel(Request $request)
    {    
        $dates = [];
        
        foreach (explode('-', $request->daterange) as $key => $value) {
            $dates[$key] = $value;
        }
        
        $start_date = date('Y-m-d', strtotime(trim($dates[0])));
        $end_date = date('Y-m-d', strtotime(trim($dates[1])));
        
        $csv_info = Income::where('date','>=',$start_date)->where('date','<=',$end_date)->get();

        $fileName = 'report -'.Auth::user()->name.'-'.date('Y-m-d H:i:s a').'.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('#','DATE','INCOME');

        $callback = function() use($csv_info, $columns) {
            $file = fopen('php://output', 'w'); 
            fputcsv($file, $columns);

            foreach ($csv_info as $key => $value) {
                $row['no']  = $key + 1;
                $row['date']  = $value->date; 
                $row['income']  = $value->income;              
                
                
                fputcsv($file, array(
                    $row['no'],
                    $row['date'],
                    $row['income'],
                    
                ));
            }


            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
