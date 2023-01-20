<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Sale;
use App\Models\PercentPage;
use App\Models\Delivery;
use App\Models\Page;
use App\Models\Advertising;
use App\Models\Shipping;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(isset($_GET['search']) && !empty($_GET['search'])){
            $campaignQuery = Campaign::orderBy('id','desc')->where('status',1)
            ->where('campaign_name','LIKE','%'.$_GET['search'].'%')
            ->Orwhere('keyword','LIKE','%'.$_GET['search'].'%');
            if(Auth::user()->user_type != 'admin'){
               $campaignQuery->where('user_id',Auth::user()->id);
            }

        } else {
            $campaignQuery = Campaign::orderBy('id','desc')->where('status',1);
             if(Auth::user()->user_type != 'admin'){
                $campaignQuery->where('user_id',Auth::user()->id);
            }
        }

        $campaign = $campaignQuery->paginate(50);

        //  $campaignTotalRevenue = array(0, 0, 0);
        //  $campaignTotalCost = array(0, 0, 0);
        //  $campaignAds = array(0, 0, 0);
        //  $campaignProfitLoss = array(0, 0, 0);
        //  $sale = array(0, 0, 0);
        //  $percentReturn = array(0, 0, 0);

        //  if(isset($campaign)) {
        //     foreach($campaign as $key => $value) {
        //         $percentPage = PercentPage::where('page_campaign_name', $value->page_id .' = '. $value->campaign_name .' = '. $value->product_name)->get();
              
        //         // foreach ($percentPage as $page) {
                    
        //         // }
        //         if(isset($percentPage) && !empty($percentPage)) {
        //             $campaignTotalRevenue[$key] += $value->sale_price * $percentPage->recieved;

        //             $percent = ($percentPage->recieved / $percentPage->total_delivery) -1;
        //             $percentReturn[$key] += number_format((float)$percent, 2, '.', '');
                    
        //             $delivery = Delivery::where('page_campaign_name', $percentPage->page_campaign_name)->first();
        //             if(isset($delivery) && !empty($delivery)) {
        //                 $campaignTotalCost[$key] += $percentPage->total_delivery * ($delivery->cost + $delivery->delivery_fee + $delivery->cod);
        //             }
        //         }
        //         $campaignAds[$key] += $value->budget;

        //        $campaignProfitLoss[$key] += $campaignTotalRevenue[$key] - $campaignTotalCost[$key] - $campaignAds[$key];

        //        $saleData = Sale::where('page_campaign_name', $value->page_id .' = '. $value->campaign_name .' = '. $value->product_name)->first();
        //        if(isset($saleData) && !empty($saleData)) {
        //             $sale[$key] += $saleData->sale;
        //        }
        //     }
        //  }
        

         $todayProfitLose = $this->todayProfite()['todayProfitLose'];
        //  return $todayProfitLose['todayProfitLose']; 

         $saleQuery = new Sale;
         if(Auth::user()->user_type != 'admin'){
            $saleQuery->where('user_id',Auth::user()->id);
         }
         $yesterday = \Carbon\Carbon::yesterday()->format('Y-m-d').'%';
         $yesterdaySale = $saleQuery->where('created_at', 'like', $yesterday)->first();
 

         $salesQuery = new Sale;
         if(Auth::user()->user_type != 'admin'){
            $salesQuery->where('user_id',Auth::user()->id);
         }

         $sales = $salesQuery->get();
         $totalSale = 0;

         foreach($sales as $key => $value){
            $totalSale += $value->sale;
         }
         $month = array(
             '1' => 'jan',
             '2' => 'Feb',
             '3' => 'Mar',
             '4' => 'Apr',
             '5' => 'May',
             '6' => 'Jun',
             '7' => 'Jul',
             '8' => 'Aug',
             '9' => 'Sep',
             '10' => 'Oct',
             '11' => 'Nov',
             '12' => 'Dec',
         );
         $graph = array();
         for ($i=1; $i <= 12 ; $i++) {   
              $p = Sale::whereMonth('created_at', $i)->get();
              $add = 0;
              foreach($p as $key => $value){
                  $add += $value->sale;
              }
            $graph[$month[$i]] = $add;
         }
        //  return $graph[$month[1]];


        

        return view('admin.index',compact('campaign','sales','yesterdaySale','totalSale','graph','month', 'todayProfitLose'));
    }


    public function todayProfite($id = null, $campaign = null)
    {
        $today = \Carbon\Carbon::now()->format('Y-m-d').'%';
        if(empty($id) && empty($campaign)) {
            $todayCampaign = Campaign::where('created_at', 'like', $today)->get();
        } elseif(empty($id)) {
           $todayCampaign = Campaign::where('id',$campaign)->where('created_at', 'like', $today)->get();
        } else {
            $todayCampaign = Campaign::where('id',$id)->get();
        }

      
        $totalRevenue = 0;
        $totalCost = 0;
        $ads = 0;
        $total_return  = 0;
        $totalSale = 0;
        $total_delivery = 0;
        $total_recieved = 0;
        $cost = 0;
        $sale_price = 0;
        $total_ads = 0;
        $currentDate = Date("d");
        $daysPassed = 0;
        $createdDate = 0;

        //Today Loss/Profite Total
        if(isset($todayCampaign) && !empty($todayCampaign)) {
            foreach($todayCampaign as $value) {
                // Today Compaign Percent Page 
                $page = Page::where('id',$value->page_id)->first();
                if(!empty($page)){
                    $sale = Sale::where('page_campaign_name', $page->name .' = '. $value->campaign_name .' = '. $value->product_name)->get();
                    foreach ($sale as $sales) {
                        $totalSale += $sales->sale;
                    }
                }
                
                $percentPage = PercentPage::where('page_campaign_name', $value->page_id .' = '. $value->campaign_name .' = '. $value->product_name)
                ->where(function($q) use ($today){
                    if(empty($id) && !empty($campaign)){
                       $q->where('created_at', 'like','%' . $today);
                    }
                })
                ->get();

                foreach($percentPage as $page){
                    // total Revenue = Compaign->sale * Page->revcieved
                    $totalRevenue += $value->sale_price * $page->recieved;
                    $total_return += (1 - ($page->recieved/$page->total_delivery)) * 100;

                    $total_delivery += $page->total_delivery;
                    $total_recieved += $page->recieved;

                    //Delivery Total cost same as Compaing page
                    $delivery = Delivery::where('page_campaign_name', $page->page_campaign_name)->where(
                        function($q) use ($today) {
                            if(empty($id) && !empty($campaign)) {
                                $q->where('created_at', 'like','%' . $today);
                            }
                        })
                    ->get();
                    foreach($delivery as $deliveries){
                        $totalCost +=  $page->total_delivery * ($deliveries->cost + $deliveries->delivery_fee + $deliveries->cod);
                        // $cost += $deliveries->cost + $deliveries->delivery_fee + $deliveries->cod;
                    }                     
                }

                // // Delivery Total cost same as Compaing page
                $delivery = Delivery::where('page_campaign_name', $value->page_id .' = '. $value->campaign_name .' = '. $value->product_name)->where(
                    function($q) use ($today) {
                        if(empty($id) && !empty($campaign)) {
                            $q->where('created_at', 'like','%' . $today);
                        }
                    })
                ->get();
                foreach($delivery as $deliveries){
                    $cost += $deliveries->cost + $deliveries->delivery_fee + $deliveries->cod;
                }

                $ads += $value->budget;
                $sale_price += $value->sale_price;
                $createdDate += strtotime($value->created_at);
            }            
        }

        $todayProfitLose = $totalRevenue - $totalCost - $ads;

        $percent = number_format((float)1 - ($total_recieved / ($total_delivery == 0 ? 1 : $total_delivery)), 2, '.', ''); 
        $percent_sale = $totalSale * $percent; 
        $recieved_amount = $totalSale - $percent_sale; 
        $recieved_money = $recieved_amount * $sale_price; 
        
        $createdDate = date("d", $createdDate);
        $daysPassed += $currentDate - $createdDate;
        $total_ads = ($daysPassed == 0 ? 1 : $daysPassed) * $ads;
        
        $totalProfitLoss = $recieved_money - $total_ads - ($cost * $totalSale);

        return $array = array(
         'todayProfitLose' =>  $todayProfitLose,
         'return_percent' => $total_return,
         'total_sale' => $totalSale,
         'totalProfitLoss' => $totalProfitLoss,
        );
    }


}