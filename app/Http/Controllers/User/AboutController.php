<?php

namespace App\Http\Controllers\User;

use App\Setting;
use App\Category;
use App\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index($id)
    {
        $a = About::all();
        $titlt_page = '';
        if ($a->first()&&$a->first()->titr1) {
            $titlt_page = $a->first()->titr1;
        }
        return view('about', compact('titlt_page','a' , 'id'));
    }
}