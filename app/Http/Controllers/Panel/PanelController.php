<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Attribute;
use App\Order;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{

    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'داشبورد';
        } elseif ('single') {
            return 'داشبورد';
        }
    }

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        if ($user->hasRole('کاربر')){
            return redirect()->route('order-list')->with(['title' => 'سفارشات']);
        }
        return redirect()->route('basket-list')->with(['title' => 'سفارشات']);

//        return view('panel.index', ['title' => $this->controller_title('sum')]);
    }

    public function status($id)
    {
        $cities = Attribute::where('id', $id)->get(['id', 'name']);

        $data = Attribute::where('name', $cities[0]->name)->get(['id', 'unit']);
        $options = array();
        foreach ($data as $city) {
            $options += array($city->id => $city->unit);
        }
        return $options;
    }


}
