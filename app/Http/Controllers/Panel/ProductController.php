<?php

namespace App\Http\Controllers\Panel;

use App\Brand;
use App\Seller;
use App\Category;
use App\Attribute;
use App\AttributeProductJoin;
use App\Comparison;
use App\ComparisonProductJoin;
use App\Photo;
use App\Price;
use App\Setting;
use App\Product;
use App\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'محصولات';
        } elseif ('single') {
            return 'محصول';
        }
    }

    public function controller_paginate()
    {
        $settings = Setting::select('paginate')->latest()->firstOrFail();
        return $settings->paginate;
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
        $products = Product::orderByDesc('created_at')->paginate($this->controller_paginate());
        return view('panel.product.index', compact('products'), ['title' => $this->controller_title('sum')]);
    }

    public function search(Request $request)
    {
        $products = Product::all();
        if ($request->product) {
            $products = Product::where('title', 'LIKE', '%' . $request->product . '%')->get();
        }
        if ($request->id) {
            $products = $products->where('id', $request->id);
        }
        if ($request->barcode) {
            $products = $products->where('barcode', $request->barcode);
        }
        if ($request->brand) {
            $brands = Brand::where('brand', 'LIKE', '%' . $request->brand . '%')->get();
            $b = array();
            foreach ($brands as $brand) {
                array_push($b, $brand->id);
            }

            $products = $products->whereIn('brand_id', $b);
        }
        if ($request->category) {
            $categories = Category::where('name', 'LIKE', '%' . $request->category . '%')->get();
            $c = array();
            foreach ($categories as $category) {
                array_push($c, $category->id);
            }

            $products = $products->whereIn('category_id', $c);
        }

        return view('panel.product.search', compact('products'), ['title' => $this->controller_title('sum')]);
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $sellers = Seller::all();
        $attributes = Attribute::all();
        $compars = Comparison::all();
        $types = Type::all();
        if (count($types)) {
            $values = unserialize($types[0]->value);
        }
        return view('panel.product.create', compact('categories', 'brands', 'sellers', 'attributes', 'compars', 'types', 'values'), ['title' => $this->controller_title('sum')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:191',
            'slug' => 'required|unique:products|max:191',
            'description' => 'required',
            'pic' => 'required',
            'unit'=>'required'
        ],[
            'category_id.required'=>'دسته بندی فیلد الزامی',
            'title.required'=>'عنوان فیلد الزامی',
            'slug.required'=>'نامک فیلد الزامی',
            'description.required'=>'توضیحات فیلد الزامی',
            'pic.required'=>'تصویر شاخص فیلد الزامی',
            'unit.required'=>'واحد فروش فیلد الزامی',
        ]);

        try {
            $article = null;
            if ($request->hasFile('article')) {
                $article = file_store($request->article, 'source/assets/uploads/products/articles/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
            }

            $video = null;
            if ($request->hasFile('video')) {
                $video = file_store($request->video, 'source/assets/uploads/products/videos/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
            }
            $flag = null;
            if ($request->hasFile('flag')) {
                $flag = file_store($request->flag, 'source/assets/uploads/products/flags/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
            }

            $pic = null;
            if ($request->hasFile('pic')) {
                $pic = file_store($request->pic, 'source/assets/uploads/products/products/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
            }

            $post = Product::create([
                'brand_id' => $request->brand_id,
                'seller_id' => $request->seller_id,
                'category_id' => $request->category_id,
                'barcode' => $request->get('barcode', ' '),
                'provider_id' => Auth::user()->id,
                'country' => $request->country,
                'flag' => $flag,
                'title' => $request->title,
                'status'=> 1,
                'title_en' => $request->title_en,
                'slug' => $request->slug,
                'size' => $request->size,
                'weight' => $request->weight,
                'number' => $request->number,
                'value' => $request->value,
                'unit' => $request->unit,
                'description' => $request->description,
                //                'phisical_text' => $request->phisical_text,
                //                'other_job' => $request->other_job,
                //                'inventory' => $request->inventory,
                            
                //                'price_store' => $request->price_store,
                //                'price_user' => $request->price_user,
                //                'price_vip' => $request->price_vip,
                'off' => $request->off,
                'vip' => $request->vip,
                //                'incredible' => $request->incredible,
                //                'vip_info' => $request->vip_info,
                'article' => $article,
                'video' => $video,
                'tables' => $request->tables,
                'best' => $request->best,
                'likes' => $request->likes,
                'articles' => $request->articles,
                'pic' => $pic,
                'labels' => $request->labels,
                'text' => $request->text,
                //                'maximum' => $request->maximum,
            ]);


            if (!empty($request->tags)) {
                \DB::table('product_tags')->insert(['tag_name' => $request->tags, 'product_id' => $post->id]);
            }


            if ($request->hasFile('photo')) {
                foreach ($request->photo as $pic) {
                    $photo = new Photo();
                    $photo->path = file_store($pic, 'source/assets/uploads/products/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                    $post->photo()->save($photo);
                }
            }
            // filter
            if ($request->val1&&count($request->val1)) {
                foreach ($request->val1 as $key => $val1) {
                    $item = new AttributeProductJoin();
                    $item->product_id = $post->id;
                    $item->attribute_id = $request->attr1[$key];
                    $item->value = $val1;
                    $item->save();
                }
            }
            // end filter

            //cmp
            if ($request->val11&&count($request->val11)) {
                foreach ($request->val11 as $key => $val11) {
                    $item = new ComparisonProductJoin();
                    $item->product_id = $post->id;
                    $item->comparison_id = $request->attr11[$key];
                    $item->value = $val11;
                    $item->save();
                }
            }
            //end cmp

            //cmp
            if ($request->type_desc&&count($request->type_desc)) {
                foreach ($request->type as $key => $type) {
                    $item = new Price();
                    $item->product_id = $post->id;
                    $item->type = $type;
                    $item->price = $request->price[$key];
                    $item->off = $request->price_off[$key];
                    $item->description = $request->type_desc[$key];
                    $item->num_in_packet = $request->num_in_packet[$key];
                    $item->value_in_packet = $request->value_in_packet[$key];
                    $item->inventory = $request->price_inventory[$key];
                    $item->save();
                }
            }
            //end cmp

            return redirect()->route('product-list')->with('flash_message', 'محصول با موفقیت افزوده شد.');

        } catch (\Exception $e) {
         dd($e);
            return redirect()->back()->withInput()->with('err_message', 'خطا در افزودن محصول, لطفا مجددا امتحان کنید');;
        }
    }

    public function edit($id)
    {
        $item = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $sellers = Seller::all();
        $attributes = Attribute::all();
        $comarisons = Comparison::all();
        $attributejoins = AttributeProductJoin::where('product_id', $id)->get();
        $comparejoins = ComparisonProductJoin::where('product_id', $id)->get();
        $prices = Price::where('product_id', $id)->get();
        //        $values=$prices->where('product_id',$id)->get();

        $types = Type::all();
        if (count($types)) {
            $p_type = $prices->where('product_id', $id)->first();
            // wroong
            // $p_type = $p_type['type'];
            // $p_value = Type::find($p_type);
            // $values = unserialize($p_value['value']);
            // edited
            $values = null;
            if ($p_type) {
                $p_type = $p_type['type'];
                $p_value = Type::find($p_type);
                $values = unserialize($p_value['value']);
            }
        }
        return view('panel.product.edit', compact('item', 'categories', 'brands', 'sellers', 'attributes', 'comarisons', 'attributejoins', 'comparejoins', 'prices', 'types', 'values'), ['title' => $this->controller_title('sum')]);
    }

    public function gallery($id)
    {
        $item = Product::findOrFail($id);
        return view('panel.product.gallery', compact('item'), ['title' => $this->controller_title('single')]);
    }

    public function gallery_sort(Request $request)
    {
        try {
            $item = Photo::findOrFail($request->id);
            $item->sort_id = $request->sort;
            $item->save();
            return 1;
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:191',
            'slug' => 'required|max:191',
            'description' => 'required',
        ]);

        try {

            $product->best = $request->best;
            $product->brand_id = $request->brand_id;
            $product->seller_id = $request->seller_id;
            $product->category_id = $request->category_id;
            $product->barcode = $request->barcode;
            $product->country = $request->country;
            $product->title = $request->title;
            $product->unit = $request->unit;
            $product->status = 1;
            $product->title_en = $request->title_en;
            $product->slug = $request->slug;
            $product->size = $request->size;
            $product->weight = $request->weight;
            $product->number = $request->number;
            $product->value = $request->value;
            $product->description = $request->description;
            //            $product->phisical_text = $request->phisical_text;
            //            $product->other_job = $request->other_job;
            //            $product->inventory = $request->inventory;
            //     
            //            $product->price_store = $request->price_store;
            //            $product->price_user = $request->price_user;
            //            $product->price_vip = $request->price_vip;
            $product->off = $request->off;
            $product->vip = $request->vip;
            //            $product->incredible = $request->incredible;
            //        $product->vip_info = $request->vip_info;
            $product->tables = $request->tables;
            $product->likes = $request->likes;
            $product->articles = $request->articles;
            $product->text = $request->text;

            if ($request->hasFile('article')) {
                if ($product->article) {
                    File::delete($product->article);
                }
                $article = file_store($request->article, 'source/assets/uploads/products/articles/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $product->article = $article;
            }

            if ($request->hasFile('video')) {
                if ($product->video) {
                    File::delete($product->video);
                }
                $video = file_store($request->video, 'source/assets/uploads/products/videos/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $product->video = $video;
            }

            if ($request->hasFile('flag')) {
                if ($product->flag) {
                    File::delete($product->flag);
                }
                $flag = file_store($request->flag, 'source/assets/uploads/products/flags/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $product->flag = $flag;
            }

            if ($request->hasFile('pic')) {
                if ($product->pic) {
                    File::delete($product->pic);
                }
                $pic = file_store($request->pic, 'source/assets/uploads/products/products/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $product->pic = $pic;
            }

            $product->labels = $request->labels;
//            $product->maximum = $request->maximum;

            $product->save();


            if (!empty($request->tags)) {
                \DB::table('product_tags')->where('product_id', $product->id)->update(['tag_name' => $request->tags]);
            }


            if ($request->hasFile('photo')) {
//             
                foreach ($request->photo as $pic) {
                    $photo = new Photo();
                    $photo->path = file_store($pic, 'source/assets/uploads/products/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                    $product->photo()->save($photo);
                }
            }

            if ($request->type) {
                $old_prices = Price::where('product_id', $id)->get();



                if (count($old_prices) > 0) {



                    foreach ($request->iden as $key => $index) {

                        $serach = Price::where('id', $index)->first();


                        try{

                            $serach->type = $request->type[$key];
                            $serach->price = $request->price[$key];
                            $serach->off = $request->price_off[$key];
                            $serach->description = $request->type_desc[$key];
                            $serach->num_in_packet = $request->num_in_packet[$key];
                            $serach->value_in_packet = $request->value_in_packet[$key];
                            $serach->inventory = $request->price_inventory[$key];
                            $serach->save();

                            $type = $request->type;
                            $type[$key] = "set";

                            $request->type = $type;



                        }catch (\Exception $e){

                            return redirect()->back()->with('err_message' , 'عملیات شکست خورد');
                        }




                    }

                    

                    foreach ($request->type as $key => $type) {
                        if ($type != 'set') {
                            $price = new Price();
                            $price->product_id = $id;
                            $price->type = $type;
                            $price->price = $request->price[$key];
                            $price->off = $request->price_off[$key];
                            $price->description = $request->type_desc[$key];
                            $price->num_in_packet = $request->num_in_packet[$key];
                            $price->value_in_packet = $request->value_in_packet[$key];
                            $price->inventory = $request->price_inventory[$key];
                            $price->save();
                        }
                    }


                } else {
                    foreach ($request->type as $key => $type) {
                        $price = new Price();
                        $price->product_id = $id;
                        $price->type = $type;
                        $price->price = $request->price[$key];
                        $price->off = $request->price_off[$key];
                        $price->description = $request->type_desc[$key];
                        $price->num_in_packet = $request->num_in_packet[$key];
                        $price->value_in_packet = $request->value_in_packet[$key];
                        $price->inventory = $request->price_inventory[$key];
                        $price->save();
                    }
                }

            }

            if ($request->attr) {
                $old_attrs = AttributeProductJoin::where('product_id', $id)->delete();
                foreach ($request->attr as $key => $attr) {
                    $attr1 = new AttributeProductJoin();
                    $attr1->product_id = $id;
                    $attr1->attribute_id = $attr;
                    $attr1->category_id = $request->category_id;
                    $attr1->value = $request->val[$key];
                    $attr1->save();
                }
            }

            if ($request->attr1) {
                $old_attrs = ComparisonProductJoin::where('product_id', $id)->delete();
                foreach ($request->attr1 as $key => $attr) {
                    $attr1 = new ComparisonProductJoin();
                    $attr1->product_id = $id;
                    $attr1->comparison_id = $attr;
                    $attr1->value = $request->val1[$key];
                    $attr1->save();
                }
            }


            return redirect()->route('product-list')->with('flash_message', 'محصول با موفقیت ویرایش شد.');

        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('err_message', 'خطا در ویرایش محصول, لطفا مجددا امتحان کنید');;

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        try {
            AttributeProductJoin::where('product_id', $product->id)->delete();
            ComparisonProductJoin::where('product_id', $product->id)->delete();
            $product->delete();
            \DB::table('product_tags')->where('product_id', $product->id)->delete();
            return redirect()->route('product-list')->with('flash_message', 'محصول با موفقیت حذف شد.');

        } catch (\Exception $e) {

            return redirect()->back();

        }
    }

    public function type_del($id)
    {
        $price = Price::findOrfail($id);
        try {
            $price->delete();
            return redirect()->back()->with('flash_message', 'با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    public function attr_del($id)
    {
        $attr = AttributeProductJoin::findOrfail($id);
        try {
            $attr->delete();
            return redirect()->back()->with('flash_message', 'با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    public function comp_del($id)
    {
        $comp = ComparisonProductJoin::findOrfail($id);
        try {
            $comp->delete();
            return redirect()->back()->with('flash_message', 'با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }
}