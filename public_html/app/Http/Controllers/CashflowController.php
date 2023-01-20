<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Sale;
use App\Models\Advertising;
use App\Models\PercentPage;
use App\Models\Delivery;
use App\Models\Income;
use App\Models\Shipping;
use Auth;

class CashflowController extends Controller
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

        return view('admin.cashflow.index',compact('campaign','advertising'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cashflow.create');
        
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
        
        /*$csv_info = Advertising::where('sale_date','>=',$start_date)->where('sale_date','<=',$end_date)->get();*/
        $csv_info = PercentPage::where('date','>=',$start_date)->where('date','<=',$end_date)->get();
        $csv_cam = Campaign::join('percent_pages','page_campaign_name','=','campaigns.page_id')->where('date','>=',$start_date)->where('date','<=',$end_date)->get();
        $csv_col2 = PercentPage::join('deliveries as d','d.page_campaign_name','=','percent_pages.page_campaign_name')->where('date','>=',$start_date)->where('date','<=',$end_date)->get();
        $csv_col3 = Income::where('date','>=',$start_date)->where('date','<=',$end_date)->get();
        $csv_col4 = Shipping::where('date','>=',$start_date)->where('date','<=',$end_date)->get();
        $csv_col5 = Advertising::where('sale_date','>=',$start_date)->where('sale_date','<=',$end_date)->get();
        /*$csv_cam = PercentPage::join('campaigns','page_id','=','percent_pages.page_campaign_name')
                                ->join('deliveries as d','d.page_campaign_name','=','percent_pages.page_campaign_name')
                                ->join('advertising as a','a.page_campaign_name','=','percent_pages.page_campaign_name')
                                ->get();*/
                    
       
        

        $fileName = 'report -'.Auth::user()->name.'-'.date('Y-m-d H:i:s a').'.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('','','','','','','','','','','','','','เงินเข้า','เงินออก','กำไร/ขาดทุน','ส่วนต่าง','','','เงินเข้า','เงินออก','กำไร/ขาดทุน','ส่วนต่าง');
        

        $callback = function() use($csv_info,$columns,$csv_cam,$csv_col2,$csv_col3,$csv_col4,$csv_col5) {
            $file = fopen('php://output', 'w');
            fputs($file, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) )); 
            fputcsv($file, $columns);
            
            $total1A = 0;
            $total1B = 0;
            $total2A = 0;
            $total2B = 0;
            $total3A = 0;
            $total3B = 0;
            $total1Aa = 0;
            $total1Bb = 0;
            $total2Aa = 0;
            $total2Bb = 0;
            $total3Aa = 0;
            $total3Bb = 0;

            /*foreach ($csv_cam as $key => $value){
                $total1A += $value->recieved + $value->budget;
            }*/
            /*foreach ($csv_cam as $key => $value) {
                $row['no']  = $key + 1;
                $row['budget']  = $value->budget; 
                $row['page_campaign_name']  = $value->page_campaign_name;
                $row['advert']  = $value->advert;                
                
                
                fputcsv($file, array(
                    $row['no'],
                    $row['budget'],
                    $row['page_campaign_name'],
                    $row['advert'],
                ));
            }*/ 

            $columns2 = array('Cashflow forecast','คาดการณ์กระแสเงินสด','','','','','','จากวันที่','','ถึงวันที่','','','คาดการณ์รายได้','','','','','','รับจริง');
            fputcsv($file, $columns2);

    foreach ($csv_cam as $value) {
                $total1Aa += $value->recieved + $value->budget;
            }
            foreach ($csv_col3 as $value) {
                $total1Bb += $value->income;
            }
        

            fputcsv($file, array(
                $row['A3'] = '',
                $row['B3'] = '',
                $row['C3'] = '',
                $row['D3'] = '',
                $row['E3'] = '',
                $row['F3'] = '',
                $row['G3'] = '',
                $row['H3'] = '',
                $row['I3'] = '',
                $row['J3'] = '',
                $row['K3'] = '',
                $row['L3'] = '',
                $row['M3'] = '(1A)คาดการณ์รายได้',
                $row['N3'] = $total1Aa,
                $row['O3'] = '',
                $row['P3'] = '',
                $row['Q3'] = '',
                $row['R3'] = '',
                $row['S3'] = '(1B)เงินโอนจริง',
                $row['T3'] = $total1Bb,
            ));

    foreach ($csv_col2 as $value) {
            $total2Aa += $value->recieved + $value->cost + $value->delivery_fee + $value->cod;
            }
            foreach ($csv_col4 as $value) {
                $total2Bb += $value->shipping_cost;
            }
            

            fputcsv($file, array(
                $row['A4'] = '',
                $row['B4'] = '',
                $row['C4'] = '',
                $row['D4'] = '',
                $row['E4'] = '',
                $row['F4'] = '',
                $row['G4'] = '',
                $row['H4'] = '',
                $row['I4'] = '',
                $row['J4'] = '',
                $row['K4'] = '',
                $row['L4'] = '',
                $row['M4'] = '(2A)ต้นทุนสินค้าและค่าส่ง',
                $row['N4'] = '',
                $row['O4'] = $total2Aa,
                $row['P4'] = '',
                $row['Q4'] = '',
                $row['R4'] = '',
                $row['S4'] = '(2B)ค่าส่งจริง',
                $row['T4'] = '',
                $row['U4'] = $total2Bb,
            ));

    foreach ($csv_cam as $value) {
            $total3Aa += $value->budget;
                }
                foreach ($csv_col5 as $value) {
                    $total3Bb += $value->advert;
                }

            fputcsv($file, array(
                $row['A5'] = '',
                $row['B5'] = '',
                $row['C5'] = '',
                $row['D5'] = '',
                $row['E5'] = '*เงินเข้า*',
                $row['F5'] = '',
                $row['G5'] = '',
                $row['H5'] = '',
                $row['I5'] = '',
                $row['J5'] = '',
                $row['K5'] = '',
                $row['L5'] = '',
                $row['M5'] = '(3A)ค่าโฆษณาประมาณ',
                $row['N5'] = '',
                $row['O5'] = $total3Aa,
                $row['P5'] = '',
                $row['Q5'] = '',
                $row['R5'] = '',
                $row['S5'] = '(3B)ค่าโฆษณาจริง',
                $row['T5'] = '',
                $row['U5'] = $total3Bb,
            ));

            fputcsv($file, array(
                $row['A6'] = '(1A)คาดการณ์รายได้',
                $row['B6'] = '',
                $row['C6'] = '',
                $row['D6'] = '',
                $row['E6'] = '',
                $row['F6'] = '',
                /*$row['G6'] = '(1B)เงินโอนจริง',*/
                $row['G6'] = '',
                $row['H6'] = '',
                $row['I6'] = '',
                $row['J6'] = '',
                $row['K6'] = '',
                $row['L6'] = '',
                $row['M6'] = '',
                $row['N6'] = '',
                $row['O6'] = '',
                $row['P6'] = $total1Aa-($total2Aa-$total3Aa),
                $row['Q6'] = '',
                $row['R6'] = '',
                $row['S6'] = '',
                $row['T6'] = '',
                $row['U6'] = '',
                $row['V6'] = $total1Bb-($total2Bb-$total3Bb),
            ));


            fputcsv($file, array(
                $row['A7'] = 'วันที่',
                $row['B7'] = 'เพจ',
                $row['C7'] = 'รับจริง(ชิ้น)',
                $row['D7'] = 'ราคาขาย',
                $row['E7'] = 'รวม',
                $row['F7'] = '',
               /* $row['G7'] = 'วันที่',
                $row['H7'] = '',
                $row['I7'] = '',
                $row['J7'] = '',
                $row['K7'] = 'รวม',*/
            ));
            $total1A = 0;
            foreach ($csv_cam as $key => $value) {
                
                
                $date  = $value->date; 
                $page_campaign_name  = $value->page_campaign_name;
                $recieved  = $value->recieved;
                $budget = $value->budget;
                
                
                $total1A += $value->recieved + $value->budget;
                
          
                fputcsv($file, array(
                    $row['A8'] = $date,
                    $row['B8'] = $page_campaign_name,
                    $row['C8'] = $recieved,
                    $row['D8'] = $budget,
                    $row['E8'] = $recieved+$budget,
                    $row['F8'] = '',
                    $row['G8'] = '',
                    $row['H8'] = '',
                    $row['I8'] = '',
                    $row['J8'] = '',
                    $row['K8'] = '',
                    
                ));
                

            
            }
           
               
          
            fputcsv($file, array(
                $row['A8'] = '',
                $row['B8'] = '',
                $row['C8'] = '',
                $row['D8'] = '',
                $row['E8'] = '',
                $row['F8'] = '',
                $row['G8'] = '',
                $row['H8'] = '',
                $row['I8'] = '',
                $row['J8'] = '',
                $row['K8'] = '',
                $row['L8'] = '',
                $row['M8'] = '',
                $row['N8'] = '',
                $row['O8'] = '',
                $row['P8'] = '',
            ));

            
            fputcsv($file, array(
                $row['A1AB'] = '',
                $row['B1AB'] = 'Total',
                $row['C1AB'] = '',
                $row['D1AB'] = '',
                $row['E1AB'] = $total1A,
                $row['F1AB'] = '',
                $row['G1AB'] = '',
                $row['H1AB'] = '',
                $row['I1AB'] = '',
                $row['J1AB'] = '',
                $row['K1AB'] = '',
                $row['L9'] = '',
                $row['M9'] = '',
                $row['N9'] = '',
                $row['O9'] = '',
                $row['P9'] = '',
            ));

            

            fputcsv($file, array(
                $row['A9'] = '',
                $row['B9'] = '',
                $row['C9'] = '',
                $row['D9'] = '',
                $row['E9'] = '',
                $row['F9'] = '',
                $row['G9'] = '',
                $row['H9'] = '',
                $row['I9'] = '',
                $row['J9'] = '',
                $row['K9'] = '',
                $row['L10'] = '',
                $row['M10'] = '',
                $row['N10'] = '',
                $row['O10'] = '',
                $row['P10'] = '',
            ));

            fputcsv($file, array(
                $row['A10'] = '',
                $row['B10'] = '',
                $row['C10'] = '',
                $row['D10'] = '',
                $row['E10'] = '',
                $row['F10'] = '',
                $row['G10'] = '',
                $row['H10'] = '',
                $row['I10'] = '',
                $row['J10'] = '',
                $row['K10'] = '',
                $row['L11'] = '',
                $row['M11'] = '',
                $row['N11'] = '',
                $row['O11'] = '',
                $row['P11'] = '',
            ));

            fputcsv($file, array(
                $row['A6'] = '(1B)เงินโอนจริง',
                $row['B6'] = '',
                $row['C6'] = '',
                $row['D6'] = '',
                $row['E6'] = '',
                $row['F6'] = '',
                /*$row['G6'] = '(1B)เงินโอนจริง',*/
                $row['H6'] = '',
                $row['I6'] = '',
                $row['J6'] = '',
                $row['K6'] = '',
            ));

            fputcsv($file, array(
                $row['A7'] = 'วันที่',
                $row['B7'] = '',
                $row['C7'] = '',
                $row['D7'] = 'รายรับ',
                $row['E7'] = 'รวม',
                $row['F7'] = '',
               /* $row['G7'] = 'วันที่',
                $row['H7'] = '',
                $row['I7'] = '',
                $row['J7'] = '',
                $row['K7'] = 'รวม',*/
            ));

            foreach ($csv_col3 as $key => $value) {
                
                $date  = $value->date; 
                $income  = $value->income;
               
                
                $total1B += $value->income;
                fputcsv($file, array(
                    $row['A8'] = $date,
                    $row['B8'] = '',
                    $row['C8'] = '',
                    $row['D8'] = $income,
                    $row['E8'] = '',
                    $row['F8'] = '',
                    $row['G8'] = '',
                    $row['H8'] = '',
                    $row['I8'] = '',
                    $row['J8'] = '',
                    $row['K8'] = '',
                    
                ));

            
            }

            fputcsv($file, array(
                $row['A1AB'] = '',
                $row['B1AB'] = 'Total',
                $row['C1AB'] = '',
                $row['D1AB'] = '',
                $row['E1AB'] = $total1B,
                $row['F1AB'] = '',
                $row['G1AB'] = '',
               /* $row['H1AB'] = 'Total',
                $row['I1AB'] = '',
                $row['J1AB'] = '',
                $row['K1AB'] = $total1B,
                $row['L9'] = '',
                $row['M9'] = '(1B)เงินโอนจริง',
                $row['N9'] = '',
                $row['O9'] = $total1B,
                $row['P9'] = '',*/
            ));

            fputcsv($file, array(
                $row['A11'] = '',
                $row['B11'] = '',
                $row['C11'] = '',
                $row['D11'] = '',
                $row['E11'] = '',
                $row['F11'] = '',
                $row['G11'] = '',
                $row['H11'] = '',
                $row['I11'] = '',
                $row['J11'] = '',
                $row['K11'] = '',
            ));

            fputcsv($file, array(
                $row['A11'] = '******************************',
                $row['B11'] = '******************************',
                $row['C11'] = '******************************',
                $row['D11'] = '******************************',
                $row['E11'] = '******************************',
                $row['F11'] = '******************************',
                $row['G11'] = '******************************',
                $row['H11'] = '******************************',
                $row['I11'] = '',
                $row['J11'] = '',
                $row['K11'] = '',
            ));



            fputcsv($file, array(
                $row['A11'] = '',
                $row['B11'] = '',
                $row['C11'] = '',
                $row['D11'] = '',
                $row['E11'] = '*เงินออก*',
                $row['F11'] = '',
                $row['G11'] = '',
                $row['H11'] = '',
                $row['I11'] = '',
                $row['J11'] = '',
                $row['K11'] = '',
            ));

            fputcsv($file, array(
                $row['A11'] = '',
                $row['B11'] = '',
                $row['C11'] = '',
                $row['D11'] = '',
                $row['E11'] = '',
                $row['F11'] = '',
                $row['G11'] = '',
                $row['H11'] = '',
                $row['I11'] = '',
                $row['J11'] = '',
                $row['K11'] = '',
            ));

            fputcsv($file, array(
                $row['A12'] = '(2A)ต้นทุนสินค้าและค่าส่ง',
                $row['B12'] = '',
                $row['C12'] = '',
                $row['D12'] = '',
                $row['E12'] = '',
                $row['F12'] = '',
                /*$row['G12'] = '(2B)ค่าส่งจริง(รวมทุกเพจ)',*/
                $row['H12'] = '',
                $row['I12'] = '',
                $row['J12'] = '',
                $row['K12'] = '',
            ));

            fputcsv($file, array(
                $row['A13'] = 'วันที่',
                $row['B13'] = 'เพจ',
                $row['C13'] = 'รับจริง(ชิ้น)',
                $row['D13'] = 'ต้นทุนสินค้า',
                $row['E13'] = 'รวม',
                $row['F13'] = '',
                /*$row['G13'] = 'วันที่',
                $row['H13'] = '',
                $row['I13'] = '',
                $row['J13'] = '',
                $row['K13'] = 'รวม',*/
            ));


            $total = 0;
            foreach ($csv_col2 as $key => $value) {
                
                
                $date  = $value->date; 
                $page_campaign_name  = $value->page_campaign_name;
                $recieved = $value->recieved;
                $cost= $value->cost ; 
                $fee= $value->delivery_fee ;
                $cod= $value->cod;
                
                
                $total2A += $value->recieved + $value->cost + $value->delivery_fee + $value->cod;
                fputcsv($file, array(
                    $row['A8'] = $date,
                    $row['B8'] = $page_campaign_name,
                    $row['C8'] = $recieved,
                    $row['D8'] = $cost+$fee+$cod,
                    $row['E8'] = $recieved+$cost+$fee+$cod,
                    $row['F8'] = '',
                    $row['G8'] = '',
                    $row['H8'] = '',
                    $row['I8'] = '',
                    $row['J8'] = '',
                    $row['K8'] = '',
                    
                ));

            
            }

     

            fputcsv($file, array(
                $row['A2AB'] = '',
                $row['B2AB'] = '',
                $row['C2AB'] = '',
                $row['D2AB'] = '',
                $row['E2AB'] = '',
                $row['F2AB'] = '',
                $row['G2AB'] = '',
                $row['H2AB'] = '',
                $row['I2AB'] = '',
                $row['J2AB'] = '',
                $row['K2AB'] = '',
            ));

            fputcsv($file, array(
                $row['A2AB'] = '',
                $row['B2AB'] = 'Total',
                $row['C2AB'] = '',
                $row['D2AB'] = '',
                $row['E2AB'] = $total2A,
                $row['F2AB'] = '',
                $row['G2AB'] = '',
                /*$row['H2AB'] = 'Total',
                $row['I2AB'] = '',
                $row['J2AB'] = '',
                $row['K2AB'] = $total2B,*/
            ));


            fputcsv($file, array(
                $row['A9'] = '',
                $row['B9'] = '',
                $row['C9'] = '',
                $row['D9'] = '',
                $row['E9'] = '',
                $row['F9'] = '',
                $row['G9'] = '',
                $row['H9'] = '',
                $row['I9'] = '',
                $row['J9'] = '',
                $row['K9'] = '',
            ));

            fputcsv($file, array(
                $row['A12'] = '(2B)ค่าส่งจริง(รวมทุกเพจ)',
                $row['B12'] = '',
                $row['C12'] = '',
                $row['D12'] = '',
                $row['E12'] = '',
                $row['F12'] = '',
                /*$row['G12'] = '(2B)ค่าส่งจริง(รวมทุกเพจ)',*/
                $row['H12'] = '',
                $row['I12'] = '',
                $row['J12'] = '',
                $row['K12'] = '',
            ));

            fputcsv($file, array(
                $row['A13'] = 'วันที่',
                $row['B13'] = '',
                $row['C13'] = '',
                $row['D13'] = 'ค่าส่ง',
                $row['E13'] = 'รวม',
                $row['F13'] = '',
                /*$row['G13'] = 'วันที่',
                $row['H13'] = '',
                $row['I13'] = '',
                $row['J13'] = '',
                $row['K13'] = 'รวม',*/
            ));
            
            foreach ($csv_col4 as $key => $value) {
                
                $date  = $value->date; 
                $shipping  = $value->shipping_cost;
               
                
                $total2B += $value->shipping_cost;
                fputcsv($file, array(
                    $row['A8'] = $date,
                    $row['B8'] = '',
                    $row['C8'] = '',
                    $row['D8'] = $shipping,
                    $row['E8'] = '',
                    $row['F8'] = '',
                    $row['G8'] = '',
                    $row['H8'] = '',
                    $row['I8'] = '',
                    $row['J8'] = '',
                    $row['K8'] = '',
                    
                ));

            
            }

            
            fputcsv($file, array(
                $row['A2AB'] = '',
                $row['B2AB'] = 'Total',
                $row['C2AB'] = '',
                $row['D2AB'] = '',
                $row['E2AB'] = $total2B,

            ));

            fputcsv($file, array(
                $row['A11'] = '',
                $row['B11'] = '',
                $row['C11'] = '',
                $row['D11'] = '',
                $row['E11'] = '',
                $row['F11'] = '',
                $row['G11'] = '',
                $row['H11'] = '',
                $row['I11'] = '',
                $row['J11'] = '',
                $row['K11'] = '',
            ));

            fputcsv($file, array(
                $row['A11'] = '******************************',
                $row['B11'] = '******************************',
                $row['C11'] = '******************************',
                $row['D11'] = '******************************',
                $row['E11'] = '******************************',
                $row['F11'] = '******************************',
                $row['G11'] = '******************************',
                $row['H11'] = '******************************',
                $row['I11'] = '',
                $row['J11'] = '',
                $row['K11'] = '',
            ));

            fputcsv($file, array(
                $row['A3AB'] = '',
                $row['B3AB'] = '',
                $row['C3AB'] = '',
                $row['D3AB'] = '',
                $row['E3AB'] = '',
                $row['F3AB'] = '',
                $row['G3AB'] = '',
                $row['H3AB'] = '',
                $row['I3AB'] = '',
                $row['J3AB'] = '',
                $row['K3AB'] = '',
            ));


            fputcsv($file, array(
                $row['A12'] = '(3A)ค่าโฆษณาประมาณ',
                $row['B12'] = '',
                $row['C12'] = '',
                $row['D12'] = '',
                $row['E12'] = '',
                $row['F12'] = '',
                /*$row['G12'] = '(3B)ค่าโฆษณาจริง',
                $row['H12'] = '',
                $row['I12'] = '',
                $row['J12'] = '',
                $row['K12'] = '',*/
            ));

            fputcsv($file, array(
                $row['A13'] = 'วันที่',
                $row['B13'] = 'เพจ',
                $row['C13'] = 'ค่าโฆษณา',
                $row['D13'] = '',
                $row['E13'] = 'รวม',
                $row['F13'] = '',
                /*$row['G13'] = 'วันที่',
                $row['H13'] = 'เพจ',
                $row['I13'] = '',
                $row['J13'] = '',
                $row['K13'] = 'รวม',*/
            ));
            
            foreach ($csv_cam as $key => $value) {
                
                
                $date  = $value->date; 
                $page_campaign_name  = $value->page_campaign_name;
                $budget = $value->budget;
                
                $total3A += $value->budget;
                fputcsv($file, array(
                    $row['A8'] = $date,
                    $row['B8'] = $page_campaign_name,
                    $row['C8'] = $budget,
                    $row['D8'] = '',
                    $row['E8'] = '',
                    $row['F8'] = '',
                    $row['G8'] = '',
                    $row['H8'] = '',
                    $row['I8'] = '',
                    $row['J8'] = '',
                    $row['K8'] = '',
                    
                ));

            
            }

            

            fputcsv($file, array(
                $row['A3AB'] = '',
                $row['B3AB'] = '',
                $row['C3AB'] = '',
                $row['D3AB'] = '',
                $row['E3AB'] = '',
                $row['F3AB'] = '',
                $row['G3AB'] = '',
                $row['H3AB'] = '',
                $row['I3AB'] = '',
                $row['J3AB'] = '',
                $row['K3AB'] = '',
            ));

            fputcsv($file, array(
                $row['A3AB'] = '',
                $row['B3AB'] = 'Total',
                $row['C3AB'] = '',
                $row['D3AB'] = '',
                $row['E3AB'] = $total3A,
                $row['F3AB'] = '',
                $row['G3AB'] = '',
                /*$row['H3AB'] = 'Total',
                $row['I3AB'] = '',
                $row['J3AB'] = '',
                $row['K3AB'] = $total3B,*/
            ));

            fputcsv($file, array(
                $row['A12'] = '(3B)ค่าโฆษณาจริง',
                $row['B12'] = '',
                $row['C12'] = '',
                $row['D12'] = '',
                $row['E12'] = '',
                $row['F12'] = '',
                /*$row['G12'] = '(3B)ค่าโฆษณาจริง',
                $row['H12'] = '',
                $row['I12'] = '',
                $row['J12'] = '',
                $row['K12'] = '',*/
            ));

            fputcsv($file, array(
                $row['A13'] = 'วันที่',
                $row['B13'] = '',
                $row['C13'] = '',
                $row['D13'] = '',
                $row['E13'] = 'รวม',
                $row['F13'] = '',
                /*$row['G13'] = 'วันที่',
                $row['H13'] = 'เพจ',
                $row['I13'] = '',
                $row['J13'] = '',
                $row['K13'] = 'รวม',*/
            ));

            foreach ($csv_col5 as $key => $value) {
                
                $sale_date  = $value->sale_date; 
                $advert  = $value->advert;
               
                
                $total3B += $value->advert;
                fputcsv($file, array(
                    $row['A8'] = $sale_date,
                    $row['B8'] = '',
                    $row['C8'] = '',
                    $row['D8'] = $advert,
                    $row['E8'] = '',
                    $row['F8'] = '',
                    $row['G8'] = '',
                    $row['H8'] = '',
                    $row['I8'] = '',
                    $row['J8'] = '',
                    $row['K8'] = '',
                    
                ));

            
            }

            fputcsv($file, array(
                $row['A3AB'] = '',
                $row['B3AB'] = 'Total',
                $row['C3AB'] = '',
                $row['D3AB'] = '',
                $row['E3AB'] = $total3B,
                $row['F3AB'] = '',
                $row['G3AB'] = '',
                /*$row['H3AB'] = 'Total',
                $row['I3AB'] = '',
                $row['J3AB'] = '',
                $row['K3AB'] = $total3B,*/
            ));

            fputcsv($file, array(
                $row['A11'] = '',
                $row['B11'] = '',
                $row['C11'] = '',
                $row['D11'] = '',
                $row['E11'] = '',
                $row['F11'] = '',
                $row['G11'] = '',
                $row['H11'] = '',
                $row['I11'] = '',
                $row['J11'] = '',
                $row['K11'] = '',
            ));

            fputcsv($file, array(
                $row['A11'] = '******************************',
                $row['B11'] = '******************************',
                $row['C11'] = '******************************',
                $row['D11'] = '******************************',
                $row['E11'] = '******************************',
                $row['F11'] = '******************************',
                $row['G11'] = '******************************',
                $row['H11'] = '******************************',
                $row['I11'] = '',
                $row['J11'] = '',
                $row['K11'] = '',
            ));
            

            fclose($file);
        
        };

        return response()->stream($callback, 200, $headers);
    }
}
