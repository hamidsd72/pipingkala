<?php namespace App\Http\Controllers\Panel;

use App\Activity;
use App\Http\Controllers\Controller;
use App\Category;
use App\ItemsHelper;
use App\Basket;
use App\Order;
use App\User;
use App\Register;
use App\Factor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BasketsExport;

class BasketController extends Controller
{    // Construct Function
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $factors = Factor::where('status' , 1)->orderBy('created_at' , 'DESC')->paginate(20);
        return view('panel.orders.index', compact('factors'), ['title' => 'سبد خرید کاربران']);
    }

    public function draftWait()
    {
        $factors = Factor::where('status' , 2)->orderBy('created_at' , 'DESC')->paginate(20);
        return view('panel.orders.draftWait', compact('factors'), ['title' => 'سبد خرید کاربران']);
    }
    public function sendFactor()
    {
        $factors = Factor::where('status' , 3)->orderBy('created_at' , 'DESC')->paginate(20);
        return view('panel.orders.send', compact('factors'), ['title' => 'سبد خرید کاربران']);
    }
    public function giveFactor()
    {
        $factors = Factor::where('status' , 4)->orderBy('created_at' , 'DESC')->paginate(20);
        return view('panel.orders.give', compact('factors'), ['title' => 'سبد خرید کاربران']);
    }

    public function cancelFactors(){
        $factors = Factor::where('status' , -1)->orderBy('created_at' , 'DESC')->paginate(20);
        return view('panel.orders.cancel', compact('factors'), ['title' => 'سبد خرید کاربران']);
    }

    public function allFactor(){
        $factors = Factor::orderBy('created_at' , 'DESC')->paginate(20);
        return view('panel.orders.all', compact('factors'), ['title' => 'سبد خرید کاربران']);
    }

    public function backPay(){
        $factors = Factor::where('pay_mode' , 'melat')->where('pay_status' , 0)->where('status' , 0)->orderBy('created_at' , 'DESC')->paginate(20);
        return view('panel.orders.backpay', compact('factors'), ['title' => 'سبد خرید کاربران']);
    }



    public function factor_show($id)
    {
        $factor = Factor::where('id', $id)->first();
        $baskets = Basket::where('order_code', $factor->order_code)->get();
        return view('panel.orders.factor', compact('baskets', 'factor'), ['title' => 'نمایش فاکتور']);
    }


    public function all()
    {
        $baskets = Basket::where('status', 3)->get();
        return view('panel.orders.all', compact('baskets'), ['title' => 'سفارشات تحویل داده شده']);
    }

    public function confirm($id)
    {
        try {
            $item = Factor::find($id);

            $item->status = 2;

            $item->save();

            return redirect()->back()->with('flash_message', 'انتقال به حواله انبار با موفقیت انجام شد');

        } catch (\Exception $e) {


            return redirect()->back()->with('err_message', 'خطلایی رخ داده است، لطفا مجددا تلاش نمایید');

        }
    }

    public function okay($id)
    {
        try {
            $item = Factor::find($id);
            $item->status = 4;
            $item->save();
            return redirect()->back()->with('flash_message', 'سفارش مورد نظر در وضعیت تحویل به مشتری قرار داده شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'خطلایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    public function basket_return($id)
    {
        try {

            $item = Factor::find($id);
            $baskets = Basket::where('order_code', $item->order_code)->get();

            foreach ($baskets as $basket) {
                $basket->product->inventory += $basket->num;
                $basket->product->save();
            }

            $item->status = -1;
            $item->save();

            return redirect()->back()->with('flash_message', 'سفارش مورد نظر با موفقیت لغو شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'خطلایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    public function basket_re_run($id)
    {
        try {
            $item = Factor::find($id);
            $baskets = Basket::where('order_code', $item->order_code)->get();
            foreach ($baskets as $basket) {
                if ($basket->product->inventory < $basket->num) {
                    return redirect()->back()->with('err_message', 'موجودی برای تایید این فاکتور کافی نمی باشد');
                }
            }
            foreach ($baskets as $basket) {
                $basket->product->inventory -= $basket->num;
                $basket->product->save();
            }
            foreach ($item->orders as $order) {
                $order->status = 3;
                $order->save();
            }
            $item->status = 3;
            $item->save();
            $order = Order::create(['factor_id' => $id, 'status' => 0,]);
            return redirect()->back()->with('flash_message', 'سفارش تایید شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'خطلایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    public function user_info($id)
    {
        $item = User::find($id);
        return view('panel.orders.user_info', compact('item'), ['title' => 'اطلاعات کاربر']);
    }

    public function destroy($id)
    {
        $category = Basket::findOrFail($id);
        try {
            $category->delete();
            return redirect()->route('basket-all')->with('flash_message', 'با موفقیت حذف شد.');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function excel()
    {
        return Excel::download(new BasketsExport, 'basketsFromFirst.xlsx');
    }
}