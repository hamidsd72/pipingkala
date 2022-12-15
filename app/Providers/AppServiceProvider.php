<?php

namespace App\Providers;

use App\Setting;
use App\Product;
use App\News;
use App\Basket;
use App\Factor;
use App\Footer;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
        $this->url = $request->fullUrl();

        Schema::defaultStringLength(191);
        Carbon::setLocale('fa');
        view()->composer('panel.particle.nav', function ($view) {
            $view->with('setting', Setting::select('title')->latest()->firstOrFail());
        });
        view()->composer('layouts.front', function ($view) {
            if (Auth::user() and !session()->has('basket_user')) {

                session(['basket_user' => Auth::user()->id]);

            }

            $baskets = null;

            if (session()->has('basket_user')) {

                if (Auth::user()) {

                    if (Auth::user()->id != session('basket_user')) {

                        $basks = Basket::where('user_id', session('basket_user'))->get();

                        foreach ($basks as $bask) {

                            $bask->user_id = Auth::user()->id;

                            $bask->save();

                        }

                        session(['basket_user' => Auth::user()->id]);

                    }

                }

                $user = session('basket_user');

                $basket_count = Basket::where('user_id', $user)->where('status', 0)->get();
            } else {
                $basket_count = [];
            }
//                $basket_count=\App\Basket::where('order_code',session('order_code'))->where('status',0)->count();

            $categories = Category::where('parent_id', null)->orderBy('sort_id', 'asc')->get();

            $view->with(['news' => News::orderBy('id', 'desc')->paginate(3), 'categories' => $categories, 'footer' => Footer::where('footer', 1)->get()])->with(['basket_count' => $basket_count]);
        });
        view()->composer('layouts.back', function ($view) {

            $count = 0;

            $factors = Factor::where('status', 0)->orderBy('created_at', 'DESC')->paginate(20);

            foreach ($factors as $val) {
                if ($val->pay_mode == 'melat') {
                    if ($val->pay_status == 1) {

                        $count++;

                    }
                } else {
                    $count++;
                }
            }


            $view->with(['less_inventory' => Product::whereRaw('inventory <= order_point')->get(), 'count' => $count]);
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
