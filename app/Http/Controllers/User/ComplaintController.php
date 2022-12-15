<?php

namespace App\Http\Controllers\User;

use App\Complaint;
use App\Setting;
use App\Work;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{
    public function controller_title() {
        return 'شکایات';
    }

    public function index()
    {
        $titlt_page = $this->controller_title();
        return view('complaint' , compact('titlt_page'));
    }

    public function store(Request $request)
    {
        try {
            $item = Complaint::create([
                'name' => $request->name,
                'subject' => $request->subject,
                'descriptions' => $request->descriptions,
            ]);
            return redirect()->back()->with('flash_message' , 'شکایت شما با موفقیت ارسال شد و در اسرع وقت پیگیری می شود. با تشکر');
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