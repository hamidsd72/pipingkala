<?php


namespace App\Http\Controllers\User;


use App\Ads;
use App\Article;
use App\ArticleCategory;
use App\Attribute;
use App\AttributeProductJoin;
use App\Basket;
use App\Brand;
use App\Category;
use App\GalleryCategory;
use App\Galery;
use App\Video_cat;
use App\Video;
use App\Comment;
use App\Footer;
use App\Http\Controllers\Controller;
use App\News;
use App\NewsCategory;
use App\Notice;
use App\Off;
use App\Prate;
use App\Prize;
use App\Product;
use App\ProductVisit;
use App\ProvinceCity;
use App\Setting;
use App\Slider;
use App\User;
use App\Viewpoint;
use App\Word;
use App\Worked;
use App\Inquiry;
use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;


class HomeController extends Controller

{
    public function gallerys()
    {
        $cats=GalleryCategory::all();
        $titlt_page = 'گالری تصاویر';

        return view('photo',compact('titlt_page','cats'));
    }
    public function videos()
    {
        $cats=Video_cat::all();
        $titlt_page = 'ویدیوها';
        return view('video',compact('titlt_page','cats'));
    }
    public function filtering(Request $request,$id)
    {
        dd($request);
        $chec=[];
        if($request->has('checking'))
        {
            $chec= $request->get('checking');
        }
        $models=Models::where('product_id',$id)->get();

        $data=array();
        foreach ($models as $model)
        {
            array_push($data,$model->id);
        }
        $attr=AttributeProductJoin::wherein('value',$chec)->whereIn('model_id',$data)->get();
        dd($attr);
        $model1=array();
        foreach ($attr as $at)
        {
            array_push($model1,$at->product_id);
        }
        $model1=array_unique($model1);
        $model=Models::whereIn('id',$model1)->where('product_id',$id)->get();
        dd($model);
    }
    public function ajax_like(Request $request)
    {

        $p_id = $request->get('p_id');
        $star = $request->get('value_star');


        if (auth()->check()) {
            $rate = Prate::where('user_id', auth()->user()->id)->where('product_id', $p_id)->first();
            if (count($rate)) {

                $rate->rate = $star;
                $rate->save();
                return response()->json(['success2' => true]);
            } else {
                $rate = new Prate();
                $rate->user_id = auth()->user()->id;
                $rate->product_id = $p_id;
                $rate->rate = $star;
                $rate->save();
                return response()->json(['success' => true]);
            }
        } else {
            return response()->json(['success1' => true]);
        }


    }

    public function catgallery()
    {
        $cat_gallery = GalleryCategory::all();
        $cat_video = Video_cat::all();
        return view('gallery.gallerycat', compact('cat_gallery', 'cat_video'));
    }

    public function pic_gall($slug)
    {
        $cat = GalleryCategory::where('slug', $slug)->first();
        $pic = Galery::where('category_id', $cat->id)->get();
        return view('gallery.pic', compact('cat', 'pic'));
    }

    public function video_gall($slug)
    {
        $cat = Video_cat::where('slug', $slug)->first();
        $video = Video::where('category_id', $cat->id)->get();
        return view('gallery.video', compact('cat', 'video'));
    }

    public function bests()

    {

        $category = 1;

        $products = Product::where('status', 1)->where('best', 1)->orderBy('id', 'updated_at')->paginate(16);

        return view('vip_best', compact('products', 'category'));

    }

    public function news($id)
    {
        $article = News::find($id);
        $titlt_page = $article->title;

        return view('news', compact('titlt_page','article'));
    }

    public function newest()

    {

        $category = 3;

        $products = Product::where('status', 1)->orderBy('id', 'updated_at')->paginate(16);

        return view('vip_best', compact('products', 'category'));

    }


    public function vips()

    {

        $category = 2;

        $products = Product::where('status', 1)->where('vip', 1)->orderBy('id', 'updated_at')->paginate(16);

        return view('vip_best', compact('products', 'category'));

    }


    public function product_label($value)
    {
        $products = Product::where('status', 1)->where('labels', 'LIKE', '%' . $value . '%')->orderBy('id', 'updated_at')->paginate(16);

        return view('search', compact('products'));
    }

    public function static_show($slug)
    {

        $footer = Footer::where('slug', $slug)->first();
        $titlt_page = $footer->title;
        return view('statics', compact('titlt_page','footer'));

    }


    public function all()

    {

        return view('products.index');

    }


    public function complaint()
    {


        return view('complaint');


    }


    public function brands()
    {

        $brands = Brand::all()->sortBy('sort')->load('photo');
        return view('brands', compact('brands'))->with(['title' => '&#1576;&#1585;&#1606;&#1583;&#1607;&#1575;']);

    }

    public function brand($id)

    {
        $brand = Brand::find($id);

        $products = Product::where('status', 1)->where('brand_id', $brand->id)->paginate(20);
        $p = Product::where('status', 1)->where('brand_id', $brand->id)->max('price_user');
        $p1 = Product::where('status', 1)->where('brand_id', $brand->id)->min('price_user');
        $price1 = intval($p) * 1000 + 1000;
        $price2 = intval($p1) * 1000 - 1000;
        return view('search', compact('brand', 'products', 'price1', 'price2', 'id'));

    }


    public function products_ajax()

    {

        $products = Product::where('status', 1)->get();

        $data = array();

        foreach ($products as $product) {

            if ($product->title) {

                array_push($data, $product->title);

            }

            if ($product->title_en) {

                array_push($data, $product->title_en);

            }

        }

        $words = Word::all();

        foreach ($words as $word) {

            array_push($data, $word->word);

        }


        return $data;

    }


    public function search_index(Request $request)
    {

        $bs = Brand::where('brand', 'LIKE', '%' . $request->search . '%')->get();

        $brands = array();

        foreach ($bs as $b) {

            if (!in_array($b->id, $brands)) {

                array_push($brands, $b->id);

            }

        }

        $products = Product::where('status', 1)->where('title', $request->search)->orWhere('title_en', $request->search)->orWhere('description', 'LIKE', '%' . $request->search . '%')->orWhereIn('brand_id', $brands)->get();


        return view('search', compact('products'));

    }


    public function search_barcode(Request $request)

    {

        try {

            if ($request->search) {

                $products = Product::where('status', 1)->where('barcode', $request->search)->orWhere('id', $request->search)->get();

            } else {

                $products = null;

            }


            return view('search', compact('products'));

        } catch (\Exception $e) {

            return redirect()->back();

        }

    }


    public function blog_site($slug)

    {
        $titlt_page = $slug;

        if ($slug == '&#1607;&#1605;&#1607;') {
            $articles = Article::all();

        } else {
            $category = ArticleCategory::where('slug', $slug)->first();

            $articles = Article::where('category_id', $category->id)->get();

        }
        return view('blog.index', compact('titlt_page','articles', 'category'));

    }


    public function blog_show($slug)

    {

        $article = Article::where('slug', $slug)->first();

        return view('blog.show', compact('article'));

    }


    public function index()
    {

        $i = 0;
        $j = 0;
        $k = 0;
        $l = 0;


        $categories = Category::where('parent_id', null)->orderBy('sort_id', 'asc')->get();

        $ArticleCategory = ArticleCategory::where('parent_id', null)->orderBy('sort_id', 'asc')->paginate(7);

        $sliders = Slider::all();


        $all_products = Product::where('status', 1)->get();


        $products = Product::where('status', 1)->orderBy('id', 'desc')->paginate(10);

        $new_products = Models::orderBy('id', 'desc')->paginate(50);


        $vip_products = Models::where('discount_price','!=',null)->orderBy('id', 'updated_at')->paginate(12);


        $best_products = Product::where('status', 1)->where('best', 1)->orderBy('id', 'updated_at')->paginate(12);


        $proposals = Product::where('status', 1)->where('price_vip', '>', 0)->get();


        $viewpoints = Viewpoint::where('status', 1)->get();


        $prizes = Prize::orderBy('id', 'desc')->get();


        $baskets = Basket::all();

        $basket_array = array();

        foreach ($baskets as $basket) {

            array_push($basket_array, $basket->model_id);

        }

        $basket_products = Models::whereIn('id', $basket_array)->paginate(20);


        $visits = ProductVisit::all();

        $visit_array = array();

        foreach ($visits as $visit) {

            array_push($visit_array, $visit->product_id);

        }

        $visit_product = Product::where('status', 1)->whereIn('id', $visit_array)->get();
        $p_id=array();
        foreach ($visit_product as $visits) {

            array_push($p_id, $visits->id);

        }

        $visit_products=Models::whereIn('product_id',$p_id)->paginate(20);

        $ads_right_up = Ads::find(4);
        $ads_right_down = Ads::find(5);
        $ads_center_up = Ads::find(6);
        $ads_center_down = Ads::find(7);
        $ads_left_up = Ads::find(8);
        $ads_left_down = Ads::find(9);
        $article = Article::paginate(12);
        $news = News::paginate(12);
        $brand = Brand::where('footer', 1)->get();
        return view('index', compact('prizes', 'best_products', 'article', 'news', 'ArticleCategory', 'categories', 'sliders', 'products', 'all_products', 'new_products', 'vip_products', 'proposals', 'viewpoints', 'basket_products', 'visit_products', 'i', 'j', 'k', 'l', 'ads_right_up', 'ads_right_down', 'ads_center_up', 'ads_center_down', 'ads_left_up', 'ads_left_down', 'brand'));
    }


    public function products($slug, Request $request)

    {
        $titlt_page = $slug;
        $category = Category::where('slug', $slug)->first();
        $new_products = Product::where('status', 1)->orderBy('id', 'desc')->paginate(50);
        $vip_products = Product::where('status', 1)->where('vip', 1)->orderBy('id', 'updated_at')->paginate(12);
        $best_products = Product::where('status', 1)->where('best', 1)->orderBy('id', 'updated_at')->paginate(12);

        if (count($category->children) == 0) {

            if ($category) {

                if ($request->has('est')) {
                    $est = $request->get('est');
                    switch ($est) {
                        case 'best':
                            $products = Product::where('status', 1)->where([
                                ['category_id', $category->id],
                                ['best', 1]
                            ])->orderBy('created_at', 'desc')->get();
                            break;
                        case 'sell':
                            $products = Product::where('status', 1)->where('category_id', $category->id)->orderBy('sell', 'desc')->get();
                            break;
                        case 'new':
                            $products = Product::where('status', 1)->where('category_id', $category->id)->orderBy('updated_at', 'desc')->get();
                            break;
                        case 'cheap':
                            $products = Product::where('status', 1)->where('category_id', $category->id)->orderBy('price_user', 'asc')->get();
                            break;
                        default:
                            $products = Product::where('status', 1)->where('category_id', $category->id)->orderBy('created_at', 'desc')->get();
                            break;
                    }
                } else {
                    $products = Product::where('status', 1)->where('category_id', $category->id)->orderBy('created_at', 'desc')->get();
                    $brands=array();
                    foreach ($products as $p)
                    {
                        $brands1=Brand::find($p->brand_id);
                        array_push($brands, $brands1->id);
                    }
                    $brands = array_unique($brands);
                    $brand125=Brand::whereIn('id',$brands)->get();
                }
                $pricemax = Product::where('status', 1)->where('category_id', $category->id)->max('price_user');
                $pricemin = Product::where('status', 1)->where('category_id', $category->id)->min('price_user');

                $filter = AttributeProductJoin::where('category_id', $category->id)->get()->groupBy('attribute_id');
                $price1 = intval($pricemax);
                $price2 = intval($pricemin);


            } else {

                $products = null;

            }

            return view('products.cat', compact('titlt_page','products','brand125', 'category', 'filter', 'price2', 'price1', 'slug'));

        } else {

            return view('products.category', compact('titlt_page','category'));

        }

    }



    public function products_all()

    {

        $products = Product::where('status', 1)->orderBy('created_at', 'desc')->paginate(16);

        return view('products.all', compact('products'));

    }

    public function product_best()

    {

        $category = Setting::find(1)->link1;

        $categoryId = 1;

        $products = Product::where('status', 1)->where('best', 1)->orderBy('created_at', 'desc')->paginate(16);

        return view('products.index', compact('products', 'category', 'categoryId', 'num', 'order', 'dir', 'attributes', 'visits'));


    }


    public function product_vip()

    {

        $category = Setting::find(1)->link2;

        $categoryId = 1;

        $products = Product::where('status', 1)->where('vip', 1)->orderBy('created_at', 'desc')->paginate(16);

        return view('products.index', compact('products', 'category', 'categoryId', 'num', 'order', 'dir', 'attributes', 'visits'));


    }

    public function filters(Request $request, $category)
    {
        $product = Product::where('status', 1)->where('id', $category)->first();
        $pricemax = Models::where('product_id', $category)->max('price');
        $pricemin = Models::where('product_id', $category)->min('price');

        $price1 = intval($pricemax);
        $price2 = intval($pricemin);
        $price3 = intval($pricemax);
        $price4 = intval($pricemin);
        $rates = Prate::where('product_id', $product->id)->get();

        $sum = 0;

        $count = count($rates);

        foreach ($rates as $rate) {

            $sum += $rate->rate;

        }


        if ($count != 0) {

            $rate = ($sum) / ($count);

        } else {

            $rate = 0;

        }
        $models = [];

        $all = [];

        foreach ($request->all() as $key => $value) {

            $attr = AttributeProductJoin::where('attribute_id', $key)->where('product_id', $category)->whereIn('value', $value)->select('model_id')->get();


            foreach ($value as $in) {
                array_push($all, $in);
            }

            foreach ($attr as $val) {
                if (!in_array($val->model_id, $models)) {
                    array_push($models, $val->model_id);
                }
            }

        }
        if(count($models)>0)
        {
            $model = Models::whereIn('id', $models)->get();
        }
        else{
            $model=Models::where('product_id',$product->id)->get();
        }


        $categoryId = $category;

        $category = Category::find($product->category_id);

        $filter = AttributeProductJoin::where('product_id', $categoryId)->get()->groupBy('attribute_id');


        return view('products.p_show', compact('price3','price4','model','product', 'category', 'categoryId', 'filter', 'price1', 'price2', 'all'));


    }
    public function mk_search(Request $request, $slug)
    {

        $product = Product::where('slug', $slug)->first();
        $models=Models::where('product_id',$product->id)->get();
//        $products =Product::whereRaw("MATCH(title,description,phisical_text) AGAINST(? IN BOOLEAN MODE)", array($request->get('search')))->paginate(15);
        $pricemax = Models::where('product_id',$product->id)->max('price');
        $pricemin = Models::where('product_id',$product->id)->min('price');
        $price1 = intval($pricemax);
        $price2 = intval($pricemin);
        $price3 = intval($pricemax);
        $price4 = intval($pricemin);
//        $products = Product::search($request->get('search'))->paginate(20);
        $model = Models::where('product_id', $product->id)->whereBetween('price', [$request->min_price-1, $request->max_peice+1])->get();



        $filter = AttributeProductJoin::where('product_id', $product->id)->get()->groupBy('attribute_id');

        $category = Category::where('id', $product->category_id)->first();

        return view('products.p_show', compact('price3','price4','model','product', 'category', 'filter', 'price2', 'price1', 'slug'));
    }
    public function searchfilters(Request $request,$all)
    {


        $s=null;
        if($all=='all')
        {
            $search=null;
            $models1 = Models::where('description', 'LIKE', '%' . $s . '%')->orWhere('name', 'LIKE', '%' . $s . '%')->orderBy('id', 'desc')->get();

            $pricemax = Models::where('description', 'LIKE', '%' . $s . '%')->orWhere('name', 'LIKE', '%' . $s . '%')->max('price');
            $pricemin = Models::where('description', 'LIKE', '%' . $s . '%')->orWhere('name', 'LIKE', '%' . $s . '%')->min('price');

            $price1 = intval($pricemax);
            $price2 = intval($pricemin);
            $price3 = intval($pricemax);
            $price4 = intval($pricemin);


            $models = [];

            $all = [];

            foreach ($request->all() as $key => $value) {

                $attr = AttributeProductJoin::where('attribute_id', $key)->whereIn('value', $value)->select('model_id')->get();


                foreach ($value as $in) {
                    array_push($all, $in);
                }

                foreach ($attr as $val) {
                    if (!in_array($val->model_id, $models)) {
                        array_push($models, $val->model_id);
                    }
                }
                $models=array_unique($models);

            }

            if(count($models)>0)
            {
                $model = Models::where('description', 'LIKE', '%' . $s . '%')->whereIn('id', $models)->orWhere('name', 'LIKE', '%' . $s . '%')->whereIn('id', $models)->get();
            }
            else{
                $model = Models::where('description', 'LIKE', '%' . $s . '%')->orWhere('name', 'LIKE', '%' . $s . '%')->orderBy('id', 'desc')->get();

            }


            $model_id=array();
            foreach ($models1 as $mod)
            {
                array_push($model_id, $mod->id);
            }
            $model_id=array_unique($model_id);
            $filter = AttributeProductJoin::whereIn('model_id', $model_id)->get()->groupBy('attribute_id');

        }
        else
        {
            $search=$all;
            $models1 = Models::where('description', 'LIKE', '%' . $search . '%')->orWhere('name', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->get();
            $pricemax = Models::where('description', 'LIKE', '%' . $search . '%')->orWhere('name', 'LIKE', '%' . $search . '%')->max('price');
            $pricemin = Models::where('description', 'LIKE', '%' . $search . '%')->orWhere('name', 'LIKE', '%' . $search . '%')->min('price');

            $price1 = intval($pricemax);
            $price2 = intval($pricemin);
            $price3 = intval($pricemax);
            $price4 = intval($pricemin);


            $models = [];

            $all = [];

            foreach ($request->all() as $key => $value) {

                $attr = AttributeProductJoin::where('attribute_id', $key)->whereIn('value', $value)->select('model_id')->get();


                foreach ($value as $in) {
                    array_push($all, $in);
                }

                foreach ($attr as $val) {
                    if (!in_array($val->model_id, $models)) {
                        array_push($models, $val->model_id);
                    }
                }
                $models=array_unique($models);

            }

            if(count($models)>0)
            {
                $model = Models::where('description', 'LIKE', '%' . $search . '%')->whereIn('id', $models)->orWhere('name', 'LIKE', '%' . $search . '%')->whereIn('id', $models)->get();
            }
            else{
                $model = Models::where('description', 'LIKE', '%' . $search . '%')->orWhere('name', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->get();
            }


            $model_id=array();
            foreach ($models1 as $mod)
            {
                array_push($model_id, $mod->id);
            }
            $model_id=array_unique($model_id);
            $filter = AttributeProductJoin::whereIn('model_id', $model_id)->get()->groupBy('attribute_id');

        }

        return view('products.search', compact('model', 'price1','price2','filter','search','all'));
    }
    public function mk_search1(Request $request)
    {
        $search=$request->text;
        $pricemax = Models::where('description', 'LIKE', '%' . $request->text . '%')->orWhere('name', 'LIKE', '%' . $request->text . '%')->max('price');
        $pricemin = Models::where('description', 'LIKE', '%' . $request->text . '%')->orWhere('name', 'LIKE', '%' . $request->text . '%')->min('price');

        $price1 = intval($pricemax);
        $price2 = intval($pricemin);
        $price3 = intval($pricemax);
        $price4 = intval($pricemin);


        $model = Models::where('description', 'LIKE', '%' . $request->text . '%')->whereBetween('price', [$request->min_price-1, $request->max_peice+1])->orWhere('name', 'LIKE', '%' . $request->text . '%')->whereBetween('price', [$request->min_price-1, $request->max_peice+1])->orderBy('id','desc')->get();
        $model_id=array();
        foreach ($model as $mod)
        {
            array_push($model_id, $mod->id);
        }
        $model_id=array_unique($model_id);
        $filter = AttributeProductJoin::whereIn('model_id', $model_id)->get()->groupBy('attribute_id');

        return view('products.search', compact('model', 'price1','price2','filter','search'));
    }
    public function searchBox(Request $request)
    {
        $titlt_page = ' جستجوی '.$request->text;
        $search=$request->text;
        $model = Models::where('description', 'LIKE', '%' . $request->text . '%')->orWhere('name', 'LIKE', '%' . $request->text . '%')->orderBy('id', 'desc')->get();
        $pricemax = Models::where('description', 'LIKE', '%' . $request->text . '%')->orWhere('name', 'LIKE', '%' . $request->text . '%')->max('price');
        $pricemin = Models::where('description', 'LIKE', '%' . $request->text . '%')->orWhere('name', 'LIKE', '%' . $request->text . '%')->min('price');
        $model_id=array();
        foreach ($model as $mod)
        {
            array_push($model_id, $mod->id);
        }
        $model_id=array_unique($model_id);
        
        $price1 = intval($pricemax);
        $price2 = intval($pricemin);
        $price3 = intval($pricemax);
        $price4 = intval($pricemin);
        $filter = AttributeProductJoin::whereIn('model_id', $model_id)->get()->groupBy('attribute_id');

        return view('products.search', compact('titlt_page','model', 'price1','price2','filter','search'));

    }
    public function product($slug)

    {
        $titlt_page = $slug;
        $product = Product::where('status', 1)->where('slug', $slug)->first();
        $model=Models::where('product_id',$product->id)->get();
        $pricemax = Models::where('product_id', $product->id)->max('price');
        $pricemin = Models::where('product_id', $product->id)->min('price');

        $price1 = intval($pricemax);
        $price2 = intval($pricemin);
        $price3 = intval($pricemax);
        $price4 = intval($pricemin);
        if (!$product) {
            return redirect()->back()->with('err_message', '&#1575;&#1740;&#1606; &#1605;&#1581;&#1589;&#1608;&#1604; &#1576;&#1607; &#1589;&#1608;&#1585;&#1578; &#1593;&#1583;&#1605; &#1606;&#1605;&#1575;&#1740;&#1588; &#1579;&#1576;&#1578; &#1588;&#1583;&#1607; &#1575;&#1587;&#1578;');
        }

        $product->seen += 1;
        $product->update();

        $product_tags = \DB::table('product_tags')->where('product_id', $product->id)->first();

        if (is_null($product)) {
            return redirect()->back();
        }

        $compares = Product::where('status', 1)->skip(5)->take(2)->where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();

        $rates = Prate::where('product_id', $product->id)->get();

        $products = Product::where('status', 1)->where('category_id', $product->category_id)->where('slug', '!=', $slug)->get();

        $comments = Comment::where('status', 1)->where('product_id', $product->id)->get();

        $rates = Prate::where('product_id', $product->id)->get();

        $sum = 0;

        $count = count($rates);

        foreach ($rates as $rate) {

            $sum += $rate->rate;

        }


        if ($count != 0) {

            $rate = ($sum) / ($count);

        } else {

            $rate = 0;

        }


        $sys = self::systemInfo();


        $vis = ProductVisit::where(['product_id' => $product->id, 'ip' => $sys['ip']])->first();

        if (!$vis) {

            $visit = ProductVisit::create([

                'product_id' => $product->id,

                'ip' => $sys['ip'],

                'device' => $sys['device'],

                'os' => $sys['os'],

            ]);

        }


        $labels = explode(',', str_replace(' ', '', $product->labels));


        $product_visits = ProductVisit::where('ip', $sys['ip'])->get();

        $p_id = array();

        foreach ($product_visits as $product_visit) {

            array_push($p_id, $product_visit->product_id);

        }

        $visits = Product::where('status', 1)->whereIn('id', $p_id)->where('id', '!=', $product->id)->get();


        $sims = explode('&#1548;', $product->likes);

        $similars = Product::where('status', 1)->whereIn('id', $sims)->get();


        $arts = explode(',', $product->articles);

        $articles = Article::whereIn('id', $arts)->paginate(4);



        $filter = AttributeProductJoin::where('product_id', $product->id)->get()->groupBy('attribute_id');



        $comments = Comment::where(['product_id' => $product->id, 'status' => 1, 'parent_id' => 0])->get();


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

            $baskets = Basket::where('user_id', $user)->where('status', 0)->get();

            if (!count($baskets)) {

                $baskets = null;

            }

        }
        $category = Category::where('id', $product->category_id)->first();

        return view('products.p_show', compact('titlt_page','price3','price4','filter','product_tags','model','category', 'product', 'rate', 'count', 'comments', 'baskets', 'products', 'compares', 'visits', 'similars', 'articles', 'labels','price1','price2'));

    }
    public function product_brand($id,$cat)
    {
        $product = Product::where('status', 1)->where('brand_id', $id)->where('category_id',$cat)->first();
        $model=Models::where('product_id',$product->id)->get();
        $pricemax = Models::where('product_id', $product->id)->max('price');
        $pricemin = Models::where('product_id', $product->id)->min('price');
        $titlt_page = $product->title;

        $price1 = intval($pricemax);
        $price2 = intval($pricemin);
        $price3 = intval($pricemax);
        $price4 = intval($pricemin);
        if (!$product) {
            return redirect()->back()->with('err_message', '&#1575;&#1740;&#1606; &#1605;&#1581;&#1589;&#1608;&#1604; &#1576;&#1607; &#1589;&#1608;&#1585;&#1578; &#1593;&#1583;&#1605; &#1606;&#1605;&#1575;&#1740;&#1588; &#1579;&#1576;&#1578; &#1588;&#1583;&#1607; &#1575;&#1587;&#1578;');
        }

        $product->seen += 1;
        $product->update();

        $product_tags = \DB::table('product_tags')->where('product_id', $product->id)->first();

        if (is_null($product)) {
            return redirect()->back();
        }

        $compares = Product::where('status', 1)->skip(5)->take(2)->where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();

        $rates = Prate::where('product_id', $product->id)->get();

//        $products = Product::where('status', 1)->where('category_id', $product->category_id)->where('slug', '!=', $slug)->get();

        $comments = Comment::where('status', 1)->where('product_id', $product->id)->get();

        $rates = Prate::where('product_id', $product->id)->get();

        $sum = 0;

        $count = count($rates);

        foreach ($rates as $rate) {

            $sum += $rate->rate;

        }


        if ($count != 0) {

            $rate = ($sum) / ($count);

        } else {

            $rate = 0;

        }


        $sys = self::systemInfo();


        $vis = ProductVisit::where(['product_id' => $product->id, 'ip' => $sys['ip']])->first();

        if (!$vis) {

            $visit = ProductVisit::create([

                'product_id' => $product->id,

                'ip' => $sys['ip'],

                'device' => $sys['device'],

                'os' => $sys['os'],

            ]);

        }


        $labels = explode(',', str_replace(' ', '', $product->labels));


        $product_visits = ProductVisit::where('ip', $sys['ip'])->get();

        $p_id = array();

        foreach ($product_visits as $product_visit) {

            array_push($p_id, $product_visit->product_id);

        }

        $visits = Product::where('status', 1)->whereIn('id', $p_id)->where('id', '!=', $product->id)->get();


        $sims = explode('&#1548;', $product->likes);

        $similars = Product::where('status', 1)->whereIn('id', $sims)->get();


        $arts = explode(',', $product->articles);

        $articles = Article::whereIn('id', $arts)->paginate(4);



        $filter = AttributeProductJoin::where('product_id', $product->id)->get()->groupBy('attribute_id');



        $comments = Comment::where(['product_id' => $product->id, 'status' => 1, 'parent_id' => 0])->get();


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

            $baskets = Basket::where('user_id', $user)->where('status', 0)->get();

            if (!count($baskets)) {

                $baskets = null;

            }

        }
        $category = Category::where('id', $product->category_id)->first();

        return view('products.p_show_brand', compact('titlt_page','price3','price4','filter','product_tags','model','category', 'product', 'rate', 'count', 'comments', 'baskets', 'compares', 'visits', 'similars', 'articles', 'labels','price1','price2'));

    }
    public function filter(Request $request, $id)

    {

        $attribu = AttributeProductJoin::whereIn('attribute_id', $request->attr_id)->get();

        foreach ($attribu as $a) {

            session()->forget($a->value);

        }

        $attrs = array();

        foreach ($request->attr_id as $key => $item) {

            if ($request->$item) {

                foreach ($request->$item as $at) {

                    session([$at => $at]);

                }

                $attrs[] = AttributeProductJoin::whereIn('value', $request->$item)->get();

            }

        }

        $fin = array();

        $fin1 = array();

        foreach ($attrs as $attr) {

            foreach ($attr as $att) {

                $fin[] = $att->product_id;

            }

            $fin1[] = $fin;

            $fin = null;

        }

        $end = count($fin1);

        if ($end > 1) {

            for ($i = 0; $i < $end - 1;) {

                $fin3 = array_intersect($fin1[$i], $fin1[++$i]);

                $fin1[$i] = $fin3;

            }

            $products = Product::where('status', 1)->whereIn('id', $fin3)->where('category_id', $id)->paginate(16);

        } else {

            if (count($fin1)) {

                $fin3 = $fin1[0];

                $products = Product::where('status', 1)->whereIn('id', $fin3)->where('category_id', $id)->paginate(16);

            } else {

                $products = Product::where('status', 1)->where('category_id', $id)->orderBy('created_at', 'desc')->paginate(16);

            }

        }

        $category = Category::find($id);

        $attributes = Attribute::where('category_id', $id)->get();

        $categoryId = $id;

        $num = 15;

        $order = 'created_at';

        $dir = 'desc';

        return view('products', compact('products', 'category', 'categoryId', 'num', 'order', 'dir', 'attributes'));

    }

    public function tag($slug)

    {

        $products = Product::where('status', 1)->where('labels', 'LIKE', '%' . $slug . '%')->get();


        return view('tag', compact('products', 'slug'));

    }


    public function notice_store(Request $request)

    {

        try {

            $item = Notice::create([

                'email' => $request->email,

                'mobile' => $request->mobile,

                'product_id' => $request->product_id,

            ]);

            return redirect()->back()->with('flash_message', '&#1576;&#1575; &#1605;&#1608;&#1601;&#1602;&#1740;&#1578; &#1579;&#1576;&#1578; &#1588;&#1583;');

        } catch (Exception $e) {

            return redirect()->back()->with('err_message', '&#1582;&#1591;&#1575;&#1740;&#1740; &#1585;&#1582; &#1583;&#1575;&#1583;&#1607; &#1575;&#1587;&#1578;&#1548; &#1604;&#1591;&#1601;&#1575; &#1605;&#1580;&#1583;&#1583;&#1575; &#1578;&#1604;&#1575;&#1588; &#1606;&#1605;&#1575;&#1740;&#1740;&#1583;');

        }

    }




    public function search_est(Request $request)
    {

    }

    public function mk_search_cat($id)
    {
        $products = Product::where('category_id', $id)->where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('search', ['products' => $products]);
//        var_dump($products);
    }

    public function search(Request $request)

    {

        if ($request->category == 1 and $request->text) {

            $category = null;

            $products = Product::where('description', 'LIKE', '%' . $request->text . '%')->orWhere('phisical_text', 'LIKE', '%' . $request->text . '%')->orderBy('created_at', 'desc')->where('status', 1)->get();

        } elseif ($request->category > 1 and $request->text) {

            $category = Category::find($request->category);

            $products = Product::where('category_id', $request->category)->where('description', 'LIKE', '%' . $request->text . '%')->orWhere('phisical_text', 'LIKE', '%' . $request->text . '%')->orderBy('created_at', 'desc')->where('status', 1)->get();

        } elseif ($request->category == 1 and !$request->text) {

            $category = null;

            $products = Product::where('status', 1)->orderBy('created_at', 'desc')->get();

        } elseif ($request->category > 1 and !$request->text) {

            $category = Category::find($request->category);

            $products = Product::where('status', 1)->where('category_id', $request->category)->orderBy('created_at', 'desc')->get();

        }


        return view('products', compact('products', 'category'));

    }




    public function sort(Request $request, $id)

    {

        if ($request->order == 'created_at') {

            if ($request->dir == 'desc') {

                $products = Product::where('status', 1)->where('category_id', $id)->orderBy('created_at', 'desc')->paginate($request->num);

            } else {

                $products = Product::where('status', 1)->where('category_id', $id)->orderBy('created_at', 'asc')->paginate($request->num);

            }

        } else {

            if ($request->dir == 'desc') {

                $products = Product::where('status', 1)->where('category_id', $id)->orderBy('price', 'desc')->paginate($request->num);

            } else {

                $products = Product::where('status', 1)->where('category_id', $id)->orderBy('price', 'asc')->paginate($request->num);

            }

        }


        $category = Category::find($id);

        $attributes = Attribute::where('category_id', $id)->get();

        $categoryId = $id;

        $num = $request->num;

        $order = $request->order;

        $dir = $request->dir;

        return view('products', compact('products', 'attributes', 'category', 'categoryId', 'num', 'order', 'dir'));

    }





    public function cityAjax($id)

    {

        $cities = ProvinceCity::where('parent_id', $id)->get(['id', 'name']);

        $options = array();

        foreach ($cities as $city) {

            $options += array($city->id => $city->name);

        }

        return json_encode($options);

    }

    public function cityAjax2($id)

    {

        $cities = ProvinceCity::find($id);


        return json_encode($cities);

    }


    public function respass(Request $request)

    {


        if (!isset($request->email)) {

            return redirect()->back()->with('err_message', '&#1604;&#1591;&#1601;&#1575; &#1575;&#1740;&#1605;&#1740;&#1604; &#1582;&#1608;&#1583; &#1585;&#1575; &#1608;&#1575;&#1585;&#1583; &#1705;&#1606;&#1740;&#1583;');

        }

        $user = User::where('email', $request->email)->first();

        if (count($user) == 0) {

            return redirect()->back()->with('err_message', '&#1575;&#1740;&#1605;&#1740;&#1604; &#1608;&#1575;&#1585;&#1583; &#1588;&#1583;&#1607; &#1608;&#1580;&#1608;&#1583; &#1606;&#1583;&#1575;&#1585;&#1583; &#1604;&#1591;&#1601;&#1575; &#1575;&#1740;&#1605;&#1740;&#1604; &#1582;&#1608;&#1583; &#1585;&#1575; &#1576;&#1585;&#1585;&#1587;&#1740; &#1705;&#1606;&#1740;&#1583;');

        }

        $hash = mt_rand(100000, 999999);


        try {

            $user->password = $hash;

            $user->save();


        } catch (\Exception $e) {

            return redirect()->back()->with('err_message', '&#1593;&#1605;&#1604;&#1740;&#1575;&#1578; &#1588;&#1705;&#1587;&#1578; &#1582;&#1608;&#1585; &#1604;&#1591;&#1601;&#1575; &#1605;&#1580;&#1583;&#1583;&#1575; &#1587;&#1593;&#1740; &#1705;&#1606;&#1740;&#1583;');


        }

        $to = $request->email;

        $subject = '&#1601;&#1585;&#1608;&#1588;&#1711;&#1575;&#1607; &#1575;&#1740;&#1606;&#1578;&#1585;&#1606;&#1578;&#1740; &#1705;&#1740;&#1607;&#1575;&#1606;';

        $message = '

        <div style="direction: rtl">

        <hr/>

        <p>&#1705;&#1575;&#1585;&#1576;&#1585; &#1711;&#1585;&#1575;&#1605;&#1740; &#1601;&#1585;&#1608;&#1588;&#1711;&#1575;&#1607; &#1575;&#1740;&#1606;&#1578;&#1585;&#1606;&#1578;&#1740; &#1705;&#1740;&#1607;&#1575;&#1606; &#1585;&#1605;&#1586; &#1593;&#1576;&#1608;&#1585; &#1588;&#1605;&#1575; &#1576;&#1607; &#1662;&#1606;&#1604; &#1705;&#1575;&#1585;&#1576;&#1585;&#1740; &#1582;&#1608;&#1583; &#1576;&#1607; &#1588;&#1585;&#1581; &#1586;&#1740;&#1585; &#1605;&#1740; &#1576;&#1575;&#1588;&#1583;  : </p>

        <p>' . $hash . '</p>

        </div>';

        $headers = "From: " . $request->email . "\r\n";

        $headers .= "Reply-To: " . $request->email . "\r\n";

        $headers .= "CC: info@keyhanpharma.com\r\n";

        $headers .= "MIME-Version: 1.0\r\n";

        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


        $mail = mail($to, $subject, $message, $headers);


        if ($mail) {

            return redirect()->back()->with('flash_message', '&#1575;&#1740;&#1605;&#1740;&#1604; &#1576;&#1607; &#1605;&#1608;&#1601;&#1602;&#1740;&#1578; &#1575;&#1585;&#1587;&#1575;&#1604; &#1588;&#1583;');

        } else {

            return redirect()->back()->with('err_message', '&#1593;&#1605;&#1604;&#1740;&#1575;&#1578; &#1588;&#1705;&#1587;&#1578; &#1582;&#1608;&#1585;&#1583; - &#1604;&#1591;&#1601;&#1575; &#1575;&#1740;&#1605;&#1740;&#1604; &#1585;&#1575; &#1605;&#1580;&#1583;&#1583;&#1575; &#1576;&#1585;&#1585;&#1587;&#1740; &#1705;&#1606;&#1740;&#1583;');

        }


    }


    public static function systemInfo()

    {

        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $os_platform = "Unknown OS Platform";

        $os_array = array('/windows phone 8/i' => 'Windows Phone 8',

            '/windows phone os 7/i' => 'Windows Phone 7',

            '/windows nt 6.3/i' => 'Windows 8.1',

            '/windows nt 6.2/i' => 'Windows 8',

            '/windows nt 6.1/i' => 'Windows 7',

            '/windows nt 6.0/i' => 'Windows Vista',

            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',

            '/windows nt 5.1/i' => 'Windows XP',

            '/windows xp/i' => 'Windows XP',

            '/windows nt 5.0/i' => 'Windows 2000',

            '/windows me/i' => 'Windows ME',

            '/win98/i' => 'Windows 98',

            '/win95/i' => 'Windows 95',

            '/win16/i' => 'Windows 3.11',

            '/macintosh|mac os x/i' => 'Mac OS X',

            '/mac_powerpc/i' => 'Mac OS 9',

            '/linux/i' => 'Linux',

            '/ubuntu/i' => 'Ubuntu',

            '/iphone/i' => 'iPhone',

            '/ipod/i' => 'iPod',

            '/ipad/i' => 'iPad',

            '/android/i' => 'Android',

            '/blackberry/i' => 'BlackBerry',

            '/webos/i' => 'Mobile');

        $found = false;

        $device = '';

        foreach ($os_array as $regex => $value) {

            if ($found)

                break;

            else if (preg_match($regex, $user_agent)) {

                $os_platform = $value;

                $device = !preg_match('/(windows|mac|linux|ubuntu)/i', $os_platform)

                    ? 'MOBILE' : (preg_match('/phone/i', $os_platform) ? 'MOBILE' : 'SYSTEM');

            }

        }

        $device = !$device ? 'SYSTEM' : $device;


        $ip = getenv('HTTP_CLIENT_IP') ?:

            getenv('HTTP_X_FORWARDED_FOR') ?:

                getenv('HTTP_X_FORWARDED') ?:

                    getenv('HTTP_FORWARDED_FOR') ?:

                        getenv('HTTP_FORWARDED') ?:

                            getenv('REMOTE_ADDR');


        return array('os' => $os_platform, 'device' => $device, 'ip' => $ip);

    }

    public function offverify($id)

    {

        $item = Off::where('code', $id)->first();

        if ($item) {

            $data = $item->persent;

        } else {

            $data = 0;

        }


        return $data;

    }

    public function inquiryUpload()
    {
        return view('inquiry_upload');
    }

    public function inquiryStore(Request $request)
    {
        $item = new Inquiry($request->all());

        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        $file3 = $request->file('file3');

        //Move Uploaded File
        $destinationPath = 'uploads';

        if (!is_null($file1)) {
            $file1->move($destinationPath, $file1->getClientOriginalName());
            $item->file1 = $file1->getClientOriginalName();
        }
        if (!is_null($file2)) {
            $file2->move($destinationPath, $file2->getClientOriginalName());
            $item->file2 = $file2->getClientOriginalName();
        }
        if (!is_null($file3)) {
            $file3->move($destinationPath, $file3->getClientOriginalName());
            $item->file3 = $file3->getClientOriginalName();
        }

        $item->save();

        return redirect()->back();

    }

}
