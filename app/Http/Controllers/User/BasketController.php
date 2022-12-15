<?php


namespace App\Http\Controllers\User;

use App\Price;
use App\News;
use Illuminate\Support\Facades\Facade;
use Illuminate\View\View;
use function Symfony\Component\VarDumper\Dumper\esc;
use App\Factor;
use App\Http\Controllers\Controller;
use App\Basket;
use App\Modell;
use App\Models;
use App\Order;
use App\Setting;
use App\Product;
use App\ProvinceCity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use App\Code;
use phplusir\smsir\Smsir;
use Carbon\Carbon;

use Illuminate\Support\Collection;

use PhpParser\Node\Stmt\TraitUseAdaptation\Precedence;


class BasketController extends Controller
{
    public function up_to_basket($id,Request $request)
    {
        $bas = Basket::find($id);

        if ($request->num < 1) {
            return redirect()->back()->with('err_message', 'تعداد نامعتبر می باشد');
        } else
        {
            $num=$request->num;
            if($bas->model_id==0)
            {
                if($bas->product->inventory<$num)
                {
                    return redirect()->back()->with('err_message', 'موجودی این محصول از درخواست شما کمتر است');
                }
                else
                {
                    $bas->num=$request->num;
                    $bas->save();
                    return redirect()->back()->with('flash_message', 'انجام شد');
                }
            }
            else
            {
                if($bas->model->count<$num)
                {
                    return redirect()->back()->with('err_message', 'موجودی این محصول از درخواست شما کمتر است');
                }
                else
                {
                    $bas->num=$request->num;
                    $bas->save();
                    return redirect()->back()->with('flash_message', 'انجام شد');
                }
            }


        }
    }
    public function fetchBaskets()
    {
        if (Auth::check()) {
            $baskets = Basket::where('user_id', Auth::user()->id)->where('status', 0)->get();
            if (count($baskets)){
                // To Initialize All Orders That MayBe Have Different Order Code
                $order_code=$baskets->last()->order_code;
                $duplicate_arrays=array();
                foreach ($baskets as $basket){

                    // update product price in basket
                    $product = Product::find($basket->product_id);
                    if (!is_null($product->price_vip) && $product->price_vip != 0 && $product->price_vip > 0) {
                        $price = $product->price_vip;
                    } else {
                        $price = $product->price_user;
                    }

                    $product_id=$basket->product_id;
                    // Begin Removing Duplicate Baskets With Similar Product Id
                    $basket_count=count($baskets->where('product_id',$product_id));
                    $basket_product=$baskets->where('product_id',$product_id)->last();
                    if ($basket_count>1){
                        // Push Last Duplicate Basket As Newest Record To Keep It Stored
                        array_push($duplicate_arrays,$basket_product->id);
                    }
                    $basket->order_code=$order_code;
                    $basket->price=$price;
//                    $basket->touch();
                    $basket->update();
                }
                // If Duplicate Array Has Duplicate Baskets That Have Similar Product Id
                if (count($duplicate_arrays)){
                    $duplicate_arrays=array_unique($duplicate_arrays);
                    foreach ($duplicate_arrays as $basket_id){
                        $basket=Basket::find($basket_id);
                        $items=Basket::where('user_id', Auth::user()->id)->where('id','!=',$basket_id)->where('product_id',$basket->product_id)->get();
                        foreach ($items as $item){
                            $item->delete();
                        }
                    }
                }
            }
            // Re Fetch The Basket If Duplicate Records Are Removed
            $baskets = Basket::where('user_id', Auth::user()->id)->where('status', 0)->get();

        } else {


            if (session()->has('basket_user')) {

                $user = session('basket_user');

                $baskets = Basket::where('user_id', $user)->where('status', 0)->get();


            }else{
                $baskets = null;
            }
        }

        return $baskets;
    }
    public function basket()
    {

        if (Auth::check()) {
            $baskets = Basket::where('user_id', Auth::user()->id)->where('status', 0)->get();

        } else {

            if (session()->has('basket_user')) {

                $user = session('basket_user');

                $baskets = Basket::where('user_id', $user)->where('status', 0)->get();


            } else {
                $baskets = null;
            }
        }
        
        $passedMinutes=null;
        if (is_null($baskets->last())) {
            $baskets = null;
        } else {
            $currentTime = Carbon::now();
            $passedMinutes=$currentTime->diffInMinutes($baskets->last()->created_at);
            if ($passedMinutes>29){
                foreach ($baskets as $basket){
                    $basket->delete();
                }
                $baskets = null;
            }
        }

        return view('basket.basket', compact('baskets'), ['title' => 'سبد خرید من','expire_time'=>$passedMinutes]);

    }



    public function update3(Request $request, $id)
    {

        try {
            if (!session('basket_user')) {

                if (Auth::user()) {

                    session(['basket_user' => Auth::user()->id]);

                } else {

                    $key = Code::orderUser();
                    session(['basket_user' => $key]);

                }
            }

            $user = session('basket_user');


            $productCheck = Product::find($id);


            if (!is_null($productCheck->order_point)) {

                if ((int)$productCheck->order_point < (int)$request->num) {
                    return redirect()->back()->with('err_message', 'این محصول داری محدودیت سفارش می باشد');

                }
            }

            if (count($productCheck->prices) > 0) {


                $modelCheck = Price::find($request->model);


                if (is_null($modelCheck)) {
                    return redirect()->back()->with('err_message', 'لطفا ابتدا مدل  محصول را انتخاب کنید');

                }

                if (count($modelCheck->children) > 0) {
                    return redirect()->back()->with('err_message', 'لطفا مدل  محصول را انتخاب کنید');
                }

            }

            $basket = Basket::where('product_id', $id)->where('user_id', $user)->where('model_id', $request->model)->where('status', 0)->first();

            if ($basket) {

                $final_num = ($request->num) + ($basket->num);

                if (!$basket->model_id and count($basket->product->prices) and !$request->model) {

                    return redirect()->back()->with('err_message', 'لطفا مدل را انتخاب نمایید');

                }

                if ($request->model) {

                    if (($basket->prices->inventory) < $final_num) {

                        return redirect()->back()->with('err_message', 'موجودی این مدل از درخواست شما کمتر است');

                    }

                } else {

                    if (($basket->product->inventory) < $final_num) {

                        return redirect()->back()->with('err_message', 'موجودی این محصول از درخواست شما کمتر است');

                    }

                }

                $basket->num += $request->num;

                $basket->save();


                return redirect()->route('basket')->with('flash_message', 'انجام شد');

            } else {

                $product = Product::find($id);

                if (count($product->prices) and !$request->model) {

                    return redirect()->back()->with('err_message', 'لطفا مدل را انتخاب نمایید');

                }


                if ($request->model) {

                    $model = Price::find($request->model);

                    if ($model and $model->inventory) {

                        if ($model->inventory < $request->num) {

                            return redirect()->back()->with('err_message', 'موجودی این مدل از درخواست شما کمتر است');

                        }

                    } else {

                        if ($product->inventory < $request->num) {

                            return redirect()->back()->with('err_message', 'موجودی این محصول از درخواست شما کمتر است');

                        }

                    }

                } else {

                    if ($product->inventory < $request->num) {

                        return redirect()->back()->with('err_message', 'موجودی این محصول از درخواست شما کمتر است');

                    }

                }


                if ($request->model) {

                    $model = Price::find($request->model);


                    $product = Product::find($id);


                    if (!is_null($product->off) && $product->off != 0 && $product->off > 0) {

                        $price = $model->off;

                    } else {

                        $price = $model->price;

                    }


                    $orderCode = 0;

                    if (Auth::check()) {

                        $basketold = Basket::where('user_id', Auth::user()->id)->where('status', 0)->first();


                        if (!is_null($basketold)) {
                            $orderCode = $basketold->order_code;
                        } else {
                            $orderCode = Code::orderCode();
                        }

                    }


                    try {

                        $item = new Basket();
                        $item->user_id = $user;
                        $item->product_id = $id;
                        $item->model_id = $request->model;
                        $item->num = $request->num;
                        $item->order_code = $orderCode;
                        $item->price = $price;
                        $item->save();


                        return redirect()->route('basket')->with(['flash_message' => 'با موفقیت افزوده شد', 'basket_add' => 'با موفقیت افزوده شد']);


                    } catch (\Exception $e) {


                        return redirect()->back()->with('err_message', 'خطایی رخ داد لطفا با پشتیبانی تماس بگیرید');

                    }


                } else {


                    $product = Product::find($id);


                    if (!is_null($product->price_vip) && $product->price_vip != 0 && $product->price_vip > 0) {

                        $price = $product->price_vip;

                    } else {

                        $price = $product->price_user;

                    }


                    $orderCode = 0;

                    if (Auth::check()) {

                        $basketold = Basket::where('user_id', Auth::user()->id)->where('status', 0)->first();


                        if (!is_null($basketold)) {
                            $orderCode = $basketold->order_code;
                        } else {
                            $orderCode = Code::orderCode();
                        }

                    }


                    try {

                        $item = new Basket();
                        $item->user_id = $user;
                        $item->product_id = $id;
                        $item->model_id = null;
                        $item->num = $request->num;
                        $item->order_code = $orderCode;
                        $item->price = (int)str_replace(',', '', $price);
                        $item->save();


                        return redirect()->route('basket')->with(['flash_message' => 'با موفقیت افزوده شد', 'basket_add' => 'با موفقیت افزوده شد']);


                    } catch (\Exception $e) {

                        return redirect()->back()->with('err_message', 'خطایی رخ داد لطفا با پشتیبانی تماس بگیرید');

                    }


                }

            }

        } catch (Exception $e) {

            return redirect()->back()->with('err_message', 'خطایی رخ داده');

        }

    }

    public function update2(Request $request, $id)
    {

        try {
            if (!session('basket_user')) {

                if (Auth::user()) {

                    session(['basket_user' => Auth::user()->id]);

                } else {

                    $key = Code::orderUser();
                    session(['basket_user' => $key]);

                }
            }

            $user = session('basket_user');


            $productCheck = Product::find($id);


            if (count($productCheck->prices) > 0) {


                foreach ($request->model as $key => $value) {

                    $modelCheck = Price::find($key);


                    if (is_null($modelCheck)) {
                        return redirect()->back()->with('err_message', 'لطفا ابتدا مدل  محصول را انتخاب کنید');

                    }
                    $inventory = Modell::where('model', json_encode($request->model))->where('product_id', $id)->first();


                    if (!is_null($inventory)) {
                        if ($inventory->inventory < $request->num) {
                            return redirect()->back()->with('err_message', 'موجودی محصول کمتر از در خواست شما می باشد');
                        }
                    } else {
                        return redirect()->back()->with('err_message', 'متاسفانه محصولی با این ویژگی در انبار موجود نمی باشد');

                    }
                }


            } else {
                if ($productCheck->inventory < $request->num) {
                    return redirect()->back()->with('err_message', 'موجودی محصول کمتر از در خواست شما می باشد');

                }
            }


            if ($request->model) {
                $basket = Basket::where('product_id', $id)->where('user_id', $user)->where('model_id', json_encode($request->model))->where('status', 0)->first();

            } else {
                $basket = Basket::where('product_id', $id)->where('user_id', $user)->where('model_id', null)->where('status', 0)->first();

            }


            if ($basket) {

                $final_num = $request->num + $basket->num;


                $basket->num = $final_num;

                $basket->save();


                return redirect()->back()->with('flash_message', 'با موفقیت به سبد خرید افزوده شد');

            } else {

                $product = Product::find($id);

                if (count($product->prices) and !$request->model) {

                    return redirect()->back()->with('err_message', 'لطفا مدل را انتخاب نمایید');

                }


                if ($request->model && count($request->model) > 0) {

                    $priceModel = 0;

                    foreach ($request->model as $key => $value) {

                        $model = Price::find($key);

                        $priceModel += $model->price;

                    }

                    $product = Product::find($id);


                    if (!is_null($product->price_vip) && $product->price_vip != 0 && $product->price_vip > 0) {

                        $price = (int)str_replace(',', '', $product->price_vip) + (int)$priceModel;

                    } else {

                        $price = (int)str_replace(',', '', $product->price_user) + (int)$priceModel;

                    }


                    $basketold = Basket::where('user_id', $user)->where('status', 0)->first();


                    if (!is_null($basketold)) {
                        $orderCode = $basketold->order_code;
                    } else {
                        $orderCode = Code::orderCode();
                    }


                    try {

                        $item = new Basket();
                        $item->user_id = $user;
                        $item->product_id = $id;
                        $item->model_id = json_encode($request->model);
                        $item->num = $request->num;

                        $item->order_code = $orderCode;
                        $item->price = $price;
                        $item->save();


                        return redirect()->back()->with(['flash_message' => 'با موفقیت افزوده شد', 'data-toast-message' => 'با موفقیت افزوده شد']);


                    } catch (\Exception $e) {

                        return redirect()->back()->with('err_message', 'خطایی رخ داد لطفا با پشتیبانی تماس بگیرید');

                    }


                } else {


                    $product = Product::find($id);


                    if (!is_null($product->price_vip) && $product->price_vip != 0 && $product->price_vip > 0) {

                        $price = $product->price_vip;

                    } else {

                        $price = $product->price_user;

                    }


                    $basketold = Basket::where('user_id', $user)->where('status', 0)->first();


                    if (!is_null($basketold)) {
                        $orderCode = $basketold->order_code;
                    } else {
                        $orderCode = Code::orderCode();
                    }


                    try {

                        $item = new Basket();
                        $item->user_id = $user;
                        $item->product_id = $id;
                        $item->model_id = null;
                        $item->num = $request->num;
                        $item->order_code = $orderCode;
                        $item->price = (int)str_replace(',', '', $price);
                        $item->save();


                        return redirect()->back()->with(['flash_message' => 'با موفقیت افزوده شد', 'data-toast-message' => 'با موفقیت افزوده شد']);


                    } catch (\Exception $e) {

                        return redirect()->back()->with('err_message', 'خطایی رخ داد لطفا با پشتیبانی تماس بگیرید');

                    }


                }

            }

        } catch (Exception $e) {

            return redirect()->back()->with('err_message', 'خطایی رخ داده');

        }

    }


    public function Add_to_basket($id)

    {

        try {

            if (!session('basket_user')) {

                if (Auth::user()) {

                    session(['basket_user' => Auth::user()->id]);

                } else {

                    $key = rand(11111, 9999999999);

                    session(['basket_user' => $key]);

                }

            }


            if (!session()->has('order_code')) {

                $val = rand(1111, 99999999);

                session(['order_code' => $val]);

            } else {
                if (session('order_code') == 0 || session('order_code') == '') {

                    $val = rand(1111, 99999999);

                    session(['order_code' => $val]);
                }
            }


            $user = session('basket_user');

            $order = session('order_code');


            $basket = Basket::where('user_id', $user)->where('product_id', $id)->first();

            if ($basket) {
                if (($basket->num) < ($basket->order_point)) {
                    $basket->num += 1;

                    if ($basket->product->inventory < $basket->num) {

                        return redirect()->back()->with('err_message', 'موجودی این محصول از درخواست شما کمتر است');

                    }

                    $basket->save();

                    return redirect()->back()->with('flash_message', 'افزوده شد');
                } else {
                    return redirect()->back()->with('err_message', 'حداکثر تعداد سفارش این محصول در سبد خرید شما قرار دارد');
                }

            } else {

                $product = Product::find($id);

                if (!$product->inventory) {

                    return redirect()->back()->with('err_message', 'موجودی این محصول از درخواست شما کمتر است');

                }

                $item = new Basket();

                $item->user_id = $user;

                $item->product_id = $id;

                $item->order_code = $order;

                $item->save();

                return redirect()->back()->with('flash_message', 'افزوده شد');

            }

        } catch (Exception $e) {

            return redirect()->back()->with('err_message', 'خطایی رخ داده');

        }

    }

//    add to bascet model product
    public function Add_to_basket_model(Request $request,$id)

    {

        try {

            if (!session('basket_user')) {

                if (Auth::user()) {

                    session(['basket_user' => Auth::user()->id]);

                } else {

                    $key = rand(11111, 9999999999);

                    session(['basket_user' => $key]);

                }

            }


            if (!session()->has('order_code')) {

                $val = rand(1111, 99999999);

                session(['order_code' => $val]);

            } else {
                if (session('order_code') == 0 || session('order_code') == '') {

                    $val = rand(1111, 99999999);

                    session(['order_code' => $val]);
                }
            }

            $num=1;
            $user = session('basket_user');

            $order = session('order_code');
            $model=Models::where('id',$id)->first();
            $pr=Product::where('id',$model->product_id)->first();
            $basket = Basket::where('user_id', $user)->where('product_id', $pr->id)->where('status',0)->where('model_id',$id)->first();
            if ($basket) {
//                if (($basket->num) < ($basket->order_point)) {
                if ($num<1){
                    return redirect()->back()->with('err_message', 'تعداد وارد شده نا معتبر می باشد');
                }
                    $basket->num +=$num;

                    if ($model->count < $basket->num) {


                        return redirect()->back()->with('err_message', 'موجودی این محصول از درخواست شما کمتر است');

                    }

                    $basket->save();

                    return redirect()->back()->with('flash_message', 'افزوده شد');
//                } else {
//                    return redirect()->back()->with('err_message', 'حداکثر تعداد سفارش این محصول در سبد خرید شما قرار دارد');
//                }

            } else {

                if ($num<1){
                    return redirect()->back()->with('err_message', 'تعداد وارد شده نا معتبر می باشد');
                }
                $product = Product::find($pr->id);
                $model1=Models::where('id',$id)->first();

                if (!$model1->count) {

                    return redirect()->back()->with('err_message', 'موجودی این محصول از درخواست شما کمتر است');

                }

                $item = new Basket();

                $item->user_id = $user;
                $item->num =$num;

                $item->product_id = $pr->id;
                $item->model_id = $id;
                if($model->discount_price==0)
                {
                    $item->price =$model1->price ;
                }
                else
                {
                    $item->price =$model1->discount_price ;
                }
                $item->discount_price=$model1->discount_price;

                $item->order_code = $order;

                $item->save();

                return redirect()->back()->with('flash_message', 'افزوده شد');

            }

        } catch (Exception $e) {

            return redirect()->back()->with('err_message', 'خطایی رخ داده');

        }

    }
    public function del_from_basket($id)

    {

        try {

            if ($id != 'all') {
                $item = Basket::find($id);

                if (is_null($item)) {

                    return redirect()->back()->with('err_message', 'محصولی یافت نشد');

                }

                $item->delete();
            } else {

                if (!session('basket_user')) {

                    if (Auth::user()) {

                        session(['basket_user' => Auth::user()->id]);

                    } else {

                        $key = Code::orderUser();
                        session(['basket_user' => $key]);

                    }
                }

                $user = session('basket_user');

                $items = Basket::where('user_id', $user)->where('status', 0)->get();

                foreach ($items as $value) {
                    $value->delete();
                }


            }


            return redirect()->back()->with('flash_message', 'با موفقیت حذف شد');

        } catch (Exception $e) {

            return redirect()->back()->with('err_message', 'عملیات شکست خورد لطفا مجددا سعی کنید');

        }

    }


    public function confirm($orderCode)
    {
        $factor = Factor::where('order_code', $orderCode)->where('status', 0)->first();

        $baskets = Basket::where('user_id', Auth::user()->id)->where('status', 0)->get();

        $news = News::paginate(12);

        return view('basket.confirm', compact('factor', 'baskets', 'news', 'orderCode'));


    }


    public function checkout()
    {

        if (!Auth::user()) {
            return redirect()->back('err_message', 'لطفا ابتدا وارد سایت شوید');
        }

        $baskets = null;


        $baskets = Basket::where('user_id', Auth::user()->id)->where('status', 0)->get();


        if (count($baskets) <= 0) {
            return redirect()->route('basket')->with('err_message', 'سبد خرید شما خالی است');
        }


        $factor_id = $baskets[0]->order_code;
        $user = Auth::user();


        $factorCheck = Factor::where('status', 0)->where('pay_status', 0)->where('user_id', $user->id)->first();


        $totalPrice = 0;
        foreach ($baskets as $value) {

            $totalPrice += $value->price * $value->num;

        }


        if (is_null($factorCheck)) {

            $factor = new Factor();
            $factor->order_code = $factor_id;
            $factor->user_id = $user->id;
            $factor->fname = $user->first_name;
            $factor->lname = $user->last_name;
            $factor->state = $user->state;
            $factor->city = $user->city;
            $factor->address = $user->address;
            $factor->postcode = $user->postcode;
            $factor->mobile = $user->mobile;
            $factor->email = $user->email;
            $factor->total_price = $totalPrice;

            $factor->save();


        } else {
            $factor = Factor::where('status', 0)->where('pay_status', 0)->where('user_id', $user->id)->first();
            $factor->order_code = $factor_id;
            $factor->total_price = $totalPrice;

            $factor->save();

        }

        foreach ($baskets as $value) {

            $value->factor_id = $factor->id;
            $value->save();

        }



        $provinces = ProvinceCity::where('parent_id', null)->orderBy('sort_id', 'asc')->get();

        if (Auth::user() and Auth::user()->state) {

            $citys = ProvinceCity::where('parent_id', Auth::user()->state)->get();

        } else {

            $citys = 0;

        }

        $news = News::paginate(12);

        return view('basket.checkout', compact('baskets', 'provinces', 'citys', 'factor_id', 'news', 'factor'), ['title' => 'پرداخت']);

    }


    public function address(Request $request, $orderCode)
    {
        $factor = Factor::where('order_code', $orderCode)->where('status', 0)->first();

        try {
            $factor->fname = $request->fname;
            $factor->lname = $request->lname;
            $factor->email = $request->email;
            $factor->mobile = $request->mobile;
            $factor->state = $request->state;
            $factor->city = $request->city;
            $factor->postcode = $request->postcode;
            $factor->address = $request->address;
            $factor->save();

            return redirect()->route('checkout-pay', $orderCode)->with('flash_message', 'لطفا روش پرداخت را انتخاب کنید');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'عملیات شکست خورد لطفا مجددا امتحان  کنید');
        }


    }

    public function pay($orderCode)
    {
        $news = News::paginate(12);

        return view('basket.baskets', compact('orderCode', 'news'));
    }

    public function payUpdate(Request $request, $orderCode)
    {
        $factor = Factor::where('order_code', $orderCode)->where('status', 0)->first();

        try {

            $factor->pay_mode = $request->pay_mode;
            $factor->save();


            return redirect()->route('checkout-confirm', $orderCode);

        } catch (\Exception $e) {

            return redirect()->back()->with('err_message', 'عملیات شکست خورد لطفا مجددا امتحان  کنید');

        }

    }

    public function checkout_confirm(Request $request, $orderCode)
    {
        try {

            $factor = Factor::where('order_code', $orderCode)->where('status', 0)->first();

            $baskets = Basket::where('user_id', Auth::user()->id)->where('status', 0)->get();


            $all_price = 0;

            foreach ($baskets as $val) {


                $productCheck = Product::find($val->product_id);


                if (count($productCheck->modell) > 0) {

                    $inventory = Models::where('id', $val->model_id)->where('product_id', $val->product_id)->first();


                    if (!is_null($inventory)) {
                        if ($inventory->count < $val->num) {
                            return redirect()->back()->with('err_message', 'موجودی محصول کمتر از در خواست شما می باشد');
                        }
                    } else {
                        return redirect()->back()->with('err_message', 'متاسفانه محصولی با این ویژگی در انبار موجود نمی باشد');

                    }

                    if ($factor->pay_mode != 'mellat') {

                        $inventory->count -= $val->num;

                        $inventory->save();
                    }

                } else {
                    if ($productCheck->inventory < $val->num) {
                        return redirect()->back()->with('err_message', 'موجودی محصول کمتر از در خواست شما می باشد');

                    }
                }



                $all_price += $val->price * $val->num;
            }

            session()->forget('order_code');
            session()->forget('basket_user');

            $setting=Setting::find(1);
            if($factor->city==342)
            {
                if($setting->send1>10000)
                {
                    if(intval($setting->send1)<intval($factor->total_price))
                    {
                        $factor->post_price=0;
                    }
                    else{
                        $factor->post_price=$factor->citys->leading_post;
                    }
                }
                else{
                    $factor->post_price=$factor->citys->leading_post;
                }
            }
            else
            {
                if($setting->send2>10000)
                {
                    if(intval($setting->send2)<intval($factor->total_price))
                    {
                        $factor->post_price=0;
                    }
                    else{
                        $factor->post_price=$factor->states->leading_post;
                    }
                }
                else{
                    $factor->post_price=$factor->states->leading_post;
                }
            }

            if($factor->city==342)
            {
                $factor->send_type='1';
            }
            else
            {
                $factor->send_type='2';
            }
            $factor->save();
            if ($factor->pay_mode == 'mellat') {
                return redirect()->route('mellat-pay', [$orderCode, $all_price, Auth::user()->id])->with('flash_message', 'با موفقیت ثبت شد، جهت مشاهده وضعیت سفارش به پنل کاربری خود مراجعه نمایید');
            }

            $factor->status = 1;
            $factor->save();

            foreach ($baskets as $value) {
                $value->status = 1;
                $value->save();
            }


            return view('basket.complate', compact('orderCode', 'factor'));

        } catch
        (Exception $e) {

            return redirect()->back()->with('err_message', 'مشکلی پیش آمده لطفا با پشتیبانی تماس بگیرید');

        }

    }

}