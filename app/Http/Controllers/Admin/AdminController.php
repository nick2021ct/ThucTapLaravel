<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Traits\TimeFilterTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class AdminController extends Controller
{
    use TimeFilterTrait;

    public function index(Request $request)
    {

        $order_today = $this->checkToday(Order::query())->get();  
        $pending_today = count($order_today->where('status','pending'));
        $completed_today = count($order_today->where('status','completed'));
        $canceled_today = count($order_today->where('status','canceled'));

        $order_week = $this->checkWeek(Order::query())->get();   
        $pending_week = count($order_week->where('status','pending'));
        $completed_week = count($order_week->where('status','completed'));
        $canceled_week = count($order_week->where('status','canceled'));

        $order_month = $this->checkMonth(Order::query())->get();
        $pending_month = count($order_month->where('status','pending'));
        $completed_month = count($order_month->where('status','completed'));
        $canceled_month = count($order_month->where('status','canceled'));

        $order_year = $this->checkYear(Order::query())->get();
        $pending_year = count($order_year->where('status','pending'));
        $completed_year = count($order_year->where('status','completed'));
        $canceled_year = count($order_year->where('status','canceled'));

        $total_income_today = Order::where('status', 'completed');
        $total_income_today = $this->checkToday($total_income_today)->SUM('total');

        $total_income_week = Order::where('status', 'completed');
        $total_income_week = $this->checkWeek($total_income_week)->SUM('total');

        $total_income_month = Order::where('status', 'completed');
        $total_income_month = $this->checkMonth($total_income_month)->SUM('total');

        $total_income_year = Order::where('status', 'completed');
        $total_income_year = $this->checkYear($total_income_year)->SUM('total');

        $product_today = $this->checkToday(OrderProduct::query())->count();
        $product_week = $this->checkWeek(OrderProduct::query())->count();   
        $product_month = $this->checkMonth(OrderProduct::query())->count();
        $product_year = $this->checkYear(OrderProduct::query())->count();



        $bestSellingProducts = Order::where('orders.status', 'completed')
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->select('products.name',
            'products.thumb_image',
             DB::raw('SUM(order_products.quantity) as total_sold'),
             DB::raw('SUM(order_products.quantity * products.price)  as total_income'))
            ->groupBy('products.name','products.thumb_image')
            ->orderByDesc('total_sold')
            ->limit(5);


            $order_pending = Order::where('status','pending');
            $order_processing =Order::where('status','processing');
            $order_shipped = Order::where('status','shipped');
            $order_completed = Order::where('status','completed');
            $order_canceled = Order::where('status','canceled');

        $selectDate = $request->input('selectDate', 'all');
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if( $startDate != null && $endDate != null){
            $bestSellingProducts = $this->dateRangeFilter($bestSellingProducts,$startDate,$endDate,'orders.created_at')->get();

            $order_pending = $this->dateRangeFilter($order_pending,$startDate,$endDate)->count();
            $order_processing = $this->dateRangeFilter($order_processing,$startDate,$endDate)->count();
            $order_shipped = $this->dateRangeFilter($order_shipped,$startDate,$endDate)->count();
            $order_completed = $this->dateRangeFilter($order_completed,$startDate,$endDate)->count();
            $order_canceled = $this->dateRangeFilter($order_canceled,$startDate,$endDate)->count();

        }else{
            $bestSellingProducts = $this->applyTimeFilter($bestSellingProducts, $selectDate, 'orders.created_at')->get();

            $order_pending = $this->applyTimeFilter($order_pending,$selectDate)->count();
            $order_processing = $this->applyTimeFilter($order_processing,$selectDate)->count();
            $order_shipped = $this->applyTimeFilter($order_shipped,$selectDate)->count();
            $order_completed = $this->applyTimeFilter($order_completed,$selectDate)->count();
            $order_canceled = $this->applyTimeFilter($order_canceled,$selectDate)->count();

            }

        $labels = ['Pending','Processing','Shipped','Completed','Canceled'];
        $data = [$order_pending,$order_processing,$order_shipped,$order_completed,$order_canceled];
        
   
        return response()->view('admin.dashboard', 
        compact(
        'order_today','order_week','order_month','order_year',
        'pending_today','pending_week','pending_month','pending_year',
        'completed_today','completed_week','completed_month','completed_year',
        'canceled_today','canceled_week','canceled_month','canceled_year',
        'bestSellingProducts','total_income_today',
        'total_income_week','total_income_month','total_income_year',
        'product_today','product_week','product_month','product_year',
        'labels','data'
    ));
    }


    public function checkToday($query,$dateColumn = 'created_at')
    {
        $query->whereDate($dateColumn, Carbon::today());
        return $query;
    }

    public function checkWeek($query,$dateColumn = 'created_at')
    {
        $query->whereBetween($dateColumn, [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);    
        return $query;
    }

    public function checkMonth($query,$dateColumn = 'created_at')
    {
        $query->whereMonth($dateColumn, Carbon::now()->month)
            ->whereYear($dateColumn, Carbon::now()->year);  
        return $query;
    }

    public function checkYear($query,$dateColumn = 'created_at')
    {
        $query->whereYear($dateColumn, Carbon::now()->year);
        return $query;
    }

   
}
