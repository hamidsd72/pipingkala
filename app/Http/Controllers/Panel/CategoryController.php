<?php

namespace App\Http\Controllers\Panel;

use App\Setting;
use App\Category;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'دسته بندی ها';
        } elseif ('single') {
            return 'دسته بندی';
        }
    }

    public function controller_paginate()
    {
        $settings = Setting::select('paginate')->latest()->firstOrFail();
        return $settings->paginate;
    }

    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id', null)->orderBy('sort_id', 'ASC')->with('children')->paginate($this->controller_paginate());
        return view('panel.categories.index', compact('categories'), ['title' => $this->controller_title('sum')]);
    }

    /**
     * Sort Item.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function sort_item(Request $request)
    {
        $category_item_sort = json_decode($request->sort);
        $this->sort_category($category_item_sort, null);
    }

    /**
     * Sort Category.
     *
     *
     * @param $category_items
     * @param $parent_id
     */
    private function sort_category(array $category_items, $parent_id)
    {
        foreach ($category_items as $index => $category_item) {
            $item = Category::findOrFail($category_item->id);
            $item->sort_id = $index + 1;
            $item->parent_id = $parent_id;
            $item->save();
            if (isset($category_item->children)) {
                $this->sort_category($category_item->children, $item->id);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.categories.create', ['title' => $this->controller_title('single')]);
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
            'name' => 'required|max:191',
            'photo' => 'required',
            'slug' => 'required|unique:categories|max:191'
        ]);

        try {
            $m='';
            if ($request->hasFile('icon')) {

                $files = $request->file('icon');
                $file_name = $files->getClientOriginalName();
                $m= $files->move('source/assets/uploads/category/icon', $file_name);

            }
           $category = new Category();
            if ($request->parent_id!='null') {
                $category->parent_id = $request->parent_id;
            }
            $category->name=$request->name;
            $category->slug=$request->slug;
            $category->active=$request->active;
            $category->text=$request->text;
            $category->text1=$request->text1;
            $category->icon=$m;
            $category->save();

            if ($request->hasFile('photo')) {
                $photo = new Photo();
                $photo->path = file_store($request->photo, 'source/assets/uploads/category/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
                $category->photo()->save($photo);
            }


            return redirect()->route('category-list')->with('flash_message', 'دسته بندی با موفقیت افزوده شد.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('panel.categories.edit', compact('category'), ['title' => $this->controller_title('single')]);
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
        $category = Category::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:191',
            'slug' => 'required|max:191|unique:categories,slug,' . $id
        ]);
        try {



            if ($request->hasFile('photo')) {
                if ($category->photo) {
                    File::delete($category->photo->path);
                    $category->photo->delete();
                }
                $photo = new Photo();
                $photo->path = file_store($request->photo, 'source/assets/uploads/category/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $category->photo()->save($photo);
            }

            if ($request->hasFile('icon')) {

                $files = $request->file('icon');
                $file_name = $files->getClientOriginalName();
                $m= $files->move('source/assets/uploads/category/icon', $file_name);

                $category->icon=$m;
            }
            
            $category->parent_id = $request->parent_id;
            if ($request->parent_id=='null') {
                $category->parent_id = '';
            }
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->text = $request->text;
            $category->text1 = $request->text1;
            $category->active = $request->active;
            $category->save();

            return redirect()->route('category-list')->with('flash_message', 'دسته بندی با موفقیت ویرایش شد.');

        } catch (\Exception $e) {

            echo $e;
            dd(true);

            return redirect()->back()->withInput();

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
        $category = Category::findOrFail($id);

        try {

            if (count($category->children)){
                return redirect()->back()->with('err_message' , 'دسته شامل زیر دسته می باشد');
            }
            if (count($category->products)){
                return redirect()->back()->with('err_message' , 'دسته شامل محصول دسته می باشد');
            }

            $category->delete();
            return redirect()->route('category-list')->with('flash_message', 'دسته بندی با موفقیت حذف شد.');

        } catch (\Exception $e) {

            return redirect()->back();

        }
    }
}
