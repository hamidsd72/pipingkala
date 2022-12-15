<?php

namespace App\Http\Controllers\User;

use App\Contact;
use App\Setting;
use App\Work;
use App\Employment;
use App\Employmentsform;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'one') {
            return 'همکاری با ما';
        } elseif ('two') {
            return 'تماس با ما';
        }
    }
    public function index()
    {
        $titlt_page = $this->controller_title('two');
        return view('contact' , compact('titlt_page'));
    }
    public function employment_show()
    {
        $titlt_page = $this->controller_title('one');
        $items=Employmentsform::where('active',1)->get();
        return view('employment',compact('titlt_page','items'));
    }
    public function employment_store(Request $request)
    {
        $this->validate($request, [
            'experts' => 'required',
            'name' => 'required',
            'age' => 'required',
            'mobile' => 'required',
            'text' => 'required',
        ],[
            'experts.required'=>'همه فیلدها الزامیست',
            'name.required'=>'همه فیلدها الزامیست',
            'age.required'=>'همه فیلدها الزامیست',
            'mobile.required'=>'همه فیلدها الزامیست',
            'text.required'=>'همه فیلدها الزامیست',

        ]);
        try {
            $item=new Employment();
            $item->job_id=$request->job_id;
            $item->experts=$request->experts;
            $item->name=$request->name;
            $item->age=$request->age;
            $item->education=$request->education;
            $item->mobile=$request->mobile;
            $item->text=$request->text;
            $item->save();
            return redirect()->route('home')->with('flash_message' , 'درخواست همکاری شما با موفقیت ارسال شد');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message' , 'خطلایی رخ داده است، لطفا مجددا تلاش نمایید');
        }


    }
    public function store(Request $request)
    {
        try {
            $item = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone'=>$request->phone,
                'descriptions' => $request->descriptions,
            ]);
            $item->save();
            return redirect()->back()->with('flash_message' , 'پیام شما با موفقیت ارسال شد، با تشکر');
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message' , 'خطلایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    public function storeWork(Request $request)
    {

        try {

            $item = Work::create([
                'name' => $request->name,
                'email' => $request->email,
                'eag' => $request->eag,
                'mobile' => $request->mobile,
                'haspend' => $request->haspend,
                'city' => $request->city,
                'student' => $request->student,
                'workBefore' => $request->workBefore,
                'address' => $request->address,
                'time' => $request->time,
                'text' => $request->text,
                'icdl' => $request->icdl,
            ]);


            $files = [];
            if ($request->hasFile('file')) {

                foreach ($request->file as $val){

                    $pic = file_store($val, 'source/assets/uploads/products/works/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');

                    array_push($files , $pic);
                }
            }

            $item->file = json_encode($files);

            $item->save();


            return redirect()->back()->with(['status' => 'success', 'message' => 'عملیات با موفقیت انجام شد و در صورت لزوم با شما تماس حاصل می گردد']);
        } catch (\Exception $e) {

            echo $e;
            dd(true);
            return redirect()->back()->with(['status' => 'danger', 'message' => 'خطلایی رخ داده است، لطفا مجددا تلاش نمایید']);
        }
    }
}