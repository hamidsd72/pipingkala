<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<?php
$set=App\Setting::find(1);
?>
<head>
    <meta charset="utf-8">
    <title>{{$titlt_page??$set->title}}</title>
    <meta name="description" content="{{$set->description}} ">
    <link rel="canonical" href="http://iioco.co"/>
    <meta property="og:type" content="ecommerce"/>
    <meta property="og:title" content="{{$set->title}}"/>
        @foreach(explode("،",$set->keywords) as $key125)
            <meta name="keywords" content="{{$key125}}">
        @endforeach
    <meta property="og:description" content="{{$set->description}} "/>
    <meta property="og:image" content="{{url($set->about_pic)}}"/>
    <meta property="og:url" content="http://iioco.co"/>
    <meta property="og:site_name" content="{{$set->title}}"/>
    <meta name="revisit-after" content="7 days"/>
    <meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{$set->description}}">
    @foreach(explode("،",$set->keywords) as $key125)
        <meta name="keywords" content="{{$key125}}">
    @endforeach

    {{--<meta name="author" content="adib-it">--}}
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon and Apple Icons-->
    <link rel="icon" type="image/png" href="{{ url('favlogo.png') }}">
    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{asset('source/assets/shop/css/vendor.min.css')}}">
    <!-- Main Template Styles-->
    <link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('source/assets/shop/css/styles.css?ver=1')}}">
    <link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('source/assets/shop/css/rtl.css')}}">
    <link rel="stylesheet" href="{{asset('source/assets/shop/css/fancy-slider/style.css')}}">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.25/css/uikit.min.css"/>
    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.25/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.25/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Modernizr-->
    <link rel="stylesheet" type="text/css" href="{{ asset('source/assets/css/jgrowl.min.css') }}"/>
    <script src="{{asset('source/assets/shop/js/document.min.js')}}"></script>
    @yield('css')
    <style>
        .btn-outline-secondary
        {
            padding: 13px!important;
        }
        /*scrool start*/
        /* width */
        ::-webkit-scrollbar {
            width: 3px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #fff;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #11ddbf;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        /*scrool end*/
        a,p,span,strong,h1,h2,h3,h4,h5,h6{
            font-family: iransans!important;
        }
        .modal{
            z-index: 9999!important;
        }
        .uk-search-default{
            width: 240px!important;
        }
        .uk-search-default .uk-search-input{
            height: 35px!important;
            background: white!important;
            padding-left: 63px!important;
            border-radius: 25px;
        }
        .uk-icon {
            background: rgba(0, 0, 0, 0.55) !important;
        }
        .uk-search-default .uk-search-icon{
            background: #11ddbf!important;
            color: #fff!important;
            padding: 0 30px!important;
            font-size: 12px!important;
            border-radius: 25px 0 0 25px;
            height: 33px;
            margin-top: 1px;
            border: unset!important;
        }
        .clock {
            height: 20vh;
            color: white;
            font-size: 22vh;
            font-family: sans-serif;
            line-height: 20.4vh;
            display: flex;
            position: relative;
            /*background: green;*/
            overflow: hidden;
        }
        .clock::before, .clock::after {
            content: '';
            width: 7ch;
            height: 3vh;
            background: linear-gradient(to top, transparent, black);
            position: absolute;
            z-index: 2;
        }
        .clock::after {
            bottom: 0;
            background: linear-gradient(to bottom, transparent, black);
        }
        .clock > div {
            display: flex;
        }
        .tick {
            line-height: 17vh;
        }
        .tick-hidden {
            opacity: 0;
        }
        .move {
            animation: move linear 1s infinite;
        }

        @keyframes move {
            from {
                transform: translateY(0vh);
            }
            to {
                transform: translateY(-20vh);
            }
        }

        .social-button
        {
            width: 20px !important;
        }
        .navbar {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            min-height: 90px;
            border-bottom: 1px solid #e1e7ec;
            background-color: #ffffff;
            z-index: 9000;
        }
        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 0.25rem !important;
            margin-top: 10px !important;
        }
        @media (min-width: 1200px)
        {
            .uk-grid {
                margin-left: unset!important;
            }
        }
            .uk-grid {
                 margin-left: unset!important;
            }
        @media (min-width: 1200px)
        {
            .uk-grid>* {
                padding-left: 10px!important;
            }
        }

            .uk-grid>* {
                 padding-left: 10px!important;
            }
        .uk-modal-dialog{
            width: 70%;
            text-align: right;
        }
    </style>
    <!---begin GOFTINO code--->
    <script type="text/javascript">
        !function(){function g(){var g=document.createElement("script"),s="https://www.goftino.com/widget/BJrsaI";g.type="text/javascript", g.async=!0,g.src=localStorage.getItem("goftino")?s+"?o="+localStorage.getItem("goftino"):s;var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(g, e);}
            var a = window;"complete" === document.readyState ? g() : a.attachEvent ? a.attachEvent("onload", g) : a.addEventListener("load", g, !1);}();
    </script>
    <!---end GOFTINO code--->
</head>
<!-- Body-->
<body>

<!-- Default Modal-->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="icon-unlock"></i> - ورود به سایت </h4>
                <button style="position: absolute;left: 5px;top: 10px;" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('login')}}" method="post">

                {{csrf_field()}}
                <div class="modal-body text-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="input-user">موبایل</label>
                                <input name="mobile" class="form-control" type="number" id="input-user"
                                       placeholder="0912XXXXXXX">
                            </div>
                            <div class="form-group">
                                <label for="input-pass">کلمه عبور</label>
                                <input class="form-control" type="password" name="password" id="input-pass"
                                       placeholder="کلمه عبور را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="row padding-top-1x">
                        <div class="col-sm-6">
                            <div class="">
                                <label class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">مرا بخاطر بسپار</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <hr/>
                        </div>
                        <div class="col-sm-4">
                            <a href="{{route('register')}}" class="btn btn-rounded btn-primary btn-sm w-100"
                               type="button">ثبت نام نکرده اید
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <button class="btn btn-rounded btn-success btn-sm w-100" type="submit">ورود به سایت
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Off-Canvas Category Menu-->
<div class="offcanvas-container" id="shop-categories">
    <a class="account-link" href="#">
        <div class="user-ava"><img src="{{asset('source/assets/shop/img/man.png')}}" alt="Daniel Adams"></div>
        <div class="user-info">
            @if(Auth::check())
                <span style="color: white">{{Auth::user()->first_name . ' ' . Auth::user()->last_name}}</span>
            @else
                <span style="color: white">کاربر مهمان</span>

            @endif
        </div>
    </a>
    <nav class="offcanvas-menu">
        <ul class="menu">
            @foreach($categories as $category)
                <li class="has-children">
                <span>
                    <a href="{{route('products',$category->slug)}}">{{$category->name}}</a>
                    @if(!empty($category->children))
                        @if(count($category->children))
                            <span class="sub-menu-toggle"></span>
                        @endif
                    @endif

                </span>
                    <!--                --><?php
                    //                $child=App\ProductCategory::where('parent_id',$category->id)->get();
                    //                ?>
                    @if(!empty($category->children))
                        @if(count($category->children))
                            <ul class="offcanvas-submenu">

                                @foreach($category->children as $key => $child)
                                    <li>
                                        <a href="{{route('products',$child->slug)}}">{{$child->name}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        @endif
                    @endif
                </li>

            @endforeach
        </ul>
    </nav>
</div>
<!-- Off-Canvas Mobile Menu-->
<div class="offcanvas-container" id="mobile-menu">
    <a class="account-link" @if(Auth::check()) href="/panel" @else href="#" data-toggle="modal" data-target="#modalLogin" @endif >
        <div class="user-ava"><img src="{{asset('source/assets/shop/img/man.png')}}" alt="Daniel Adams"></div>
        <div class="user-info">
                @if(Auth::check())
                    <span style="color: white">{{Auth::user()->first_name . ' ' . Auth::user()->last_name}}</span>
                @else
                    <span style="color: white">ورود / عضویت</span>

                @endif
        </div>
    </a>
    <nav class="offcanvas-menu">
        <ul class="menu">
            <?php
            $categori=App\Category::where('parent_id', null)->orderBy('sort_id', 'asc')->get();
            ?>
            @foreach($categori as $category)
                <li class="has-children">
                <span>
                    <a href="{{route('products',$category->slug)}}">{{$category->name}}</a>
                    @if(!empty($category->children))
                        @if(count($category->children))
                            <span class="sub-menu-toggle"></span>
                        @endif
                    @endif

                </span>
                    <?php
                    $child=App\Category::where('parent_id',$category->id)->orderby('sort_id','asc')->get();
                    ?>
                    @if(!empty($child))
                        @if(count($child))
                            <ul class="offcanvas-submenu">

                                @foreach($child as $key => $child)
                                    <li>
                                        <a href="{{route('products',$child->slug)}}">{{$child->name}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        @endif
                    @endif
                </li>

            @endforeach
        </ul>
    </nav>

</div>
<?php
$aboutss=App\About::find(3);
?>
<!-- Topbar-->
<a class="to_top" href="#" uk-totop uk-scroll></a>


<!-- This is the modal with the outside close button -->
<div id="modal_1" uk-modal style="z-index: 9999">
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-outside" type="button" uk-close></button>
        <h2 class="uk-modal-title">قوانین و مقررات سایت</h2>
        <p>
            فروشگاه چشم انداز صنعت تابع قوانین و مقررات جمهوری اسلامی ایران است و درج هرگونه موارد سیاسی، غیر اخلاقی و مغایر با هنجارهای اجتماعی باعث حذف حساب کاربر مورد نظر خواهد شد.
            استفاده از نام و نام‌خانوادگی حقیقی افراد به منظور ثبت نام در سایت الزامی است. در صورت مشاهده کلمات رکیک و الفاظ نامناسب، حساب كاربر حذف خواهد شد.
            هنگام ثبت سفارش ، ثبت یک شماره معتبر و قابل دسترس برای کاربران الزامی است که برای این منظور سیستم برای شما پیامک تایید میفرستد .
            مسئولیت وارد کردن اطلاعات اشتباه و غیر واقعی از قبیل نام و نام خانوادگی، آدرس و شماره تماس به عهده کاربر است.
            در صورت مشاهده تخلف لطفا با ما مکاتبه نمایید.

        </p>
    </div>
</div>
<div class="topbar">
    <div class="topbar-column">
        {{--<a href="#" class="hidden-md-down">--}}
        {{--امروز : {{jdate('Y/n/j') }}--}}
        {{--</a>--}}
        <a  href="#modal_1" uk-toggle>
            <i class="icon-map"></i>&nbsp; قوانین و مقررات فروش
        </a>
        <a href="{{route('contact-us')}}" class="hidden-md-down">
            <i uk-icon="receiver" style="background: unset!important;"></i>&nbsp; تماس با ما
        </a>
        <a class="hidden-md-down">
            <i uk-icon="user" style="background: unset!important;"></i>&nbsp; درباره ما
        </a>
        <div uk-dropdown>
            <ul class="uk-nav uk-dropdown-nav">
                <li class="uk-active"><a href="{{route('about-us',1)}}">{{$aboutss->titr1}}</a></li>
                <li class="uk-active"><a href="{{route('about-us',2)}}">{{$aboutss->titr2}}</a></li>
                <li class="uk-active"><a href="{{route('about-us',3)}}">{{$aboutss->titr3}}</a></li>
                <li class="uk-active"><a href="{{route('about-us',4)}}">{{$aboutss->titr4}}</a></li>
                <li class="uk-active"><a href="{{route('about-us',5)}}">{{$aboutss->titr5}}</a></li>
                <li class="uk-active"><a href="{{route('about-us',6)}}">{{$aboutss->titr6}}</a></li>
                <li class="uk-active"><a href="{{route('about-us',7)}}">{{$aboutss->titr7}}</a></li>
                <li class="uk-active"><a href="{{route('about-us',8)}}">{{$aboutss->titr8}}</a></li>
                <li class="uk-active"><a href="{{route('about-us',9)}}">{{$aboutss->titr9}}</a></li>
                <li class="uk-active"><a href="{{route('about-us',10)}}">{{$aboutss->titr10}}</a></li>
                <li class="uk-active"><a href="{{route('about-us',11)}}">{{$aboutss->titr11}}</a></li>

            </ul>
        </div>
        {{--<a href="{{route('inquiry-upload')}}" class="hidden-md-down">--}}
            {{--<i class="icon-bell"></i>&nbsp; آپلود استعلام--}}
        {{--</a>--}}
        {{--<a class="social-button sb-facebook shape-none sb-dark" href="#" target="_blank">--}}
            {{--<i class="socicon-facebook"></i>--}}
        {{--</a>--}}
        {{--<a class="social-button sb-twitter shape-none sb-dark" href="#" target="_blank">--}}
            {{--<i class="socicon-twitter"></i>--}}
        {{--</a>--}}
        {{--<a class="social-button sb-instagram shape-none sb-dark" href="#" target="_blank">--}}
            {{--<i class="socicon-instagram"></i>--}}
        {{--</a>--}}
        {{--<a class="social-button sb-pinterest shape-none sb-dark" href="#" target="_blank">--}}
            {{--<i class="socicon-pinterest"></i>--}}
        {{--</a>--}}
        <!-- Toolbar-->
        <div class="toolbar">
            <div class="inner">
                <span class="uk-visible@m">تلفن (شرکت) : ۸۶ – ۰۲۱۶۵۰۱۰۲۸۵  </span>
                <a  class="social-button shape-circle sb-facebook sb-light-skin uk-visible@m" href="http://www.facebook.com/."><i style="font-size: 13px" class="socicon-facebook"></i></a>
                <a  class="social-button shape-circle sb-instagram sb-light-skin uk-visible@m" href="https://www.instagram.com/"><i style="font-size: 13px" class="socicon-instagram"></i></a>
                <div class="tools">
                    <div id="clockbox" class="uk-visible@m" style="    font: normal 11px verdana;color: #333; float: right; margin-top: 4px;margin-left: 20px;background: #11DDBF;padding: 8px; border-radius: 20px;">12:50:24 PM</div>
                    <form class="uk-search uk-search-default"  action="{{route('search-box')}}" method="get">
                            <button class="uk-search-icon" type="submit">جستجو</button>
                            <input class="uk-search-input" type="search" name="text" placeholder="" required oninvalid="this.setCustomValidity('دنبال چه میگردید؟؟؟')"
                                   oninput="setCustomValidity('')">

                        </form>
                    <script type="text/javascript">
                        tday  =new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
                        tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

                        function GetClock(){
                            d = new Date();
                            nday   = d.getDay();
                            nmonth = d.getMonth();
                            ndate  = d.getDate();
                            nyear = d.getYear();
                            nhour  = d.getHours();
                            nmin   = d.getMinutes();
                            nsec   = d.getSeconds();

                            if(nyear<1000) nyear=nyear+1900;

                            if(nhour ==  0) {ap = " AM";nhour = 12;}
                            else if(nhour <= 11) {ap = " AM";}
                            else if(nhour == 12) {ap = " PM";}
                            else if(nhour >= 13) {ap = " PM";nhour -= 12;}

                            if(nmin <= 9) {nmin = "0" +nmin;}
                            if(nsec <= 9) {nsec = "0" +nsec;}


                            document.getElementById('clockbox').innerHTML=""+nhour+":"+nmin+":"+nsec+ap+"";
                            setTimeout("GetClock()", 1000);
                        }
                        window.onload=GetClock;
                    </script>
                    <div class="account"><a href="#"></a><i class="icon-head"></i>
                        <ul class="toolbar-dropdown">
                            <li class="sub-menu-user">
                                <div class="user-ava"><img src="https://image.flaticon.com/icons/svg/138/138671.svg"
                                                           alt="آواتار">
                                </div>
                                <div class="user-info">
                                    <h6 class="user-name">@if(Auth::check()) {{Auth::user()->first_name . ' ' . Auth::user()->last_name}} @else
                                            کاربر مهمان  @endif</h6>
                                </div>
                            </li>
                            @if(Auth::check())
                                <li><a href="{{route('order-list')}}">لیست سفارشات</a></li>
                                <li><a href="{{route('favorite')}}">لیست علاقه مندی</a></li>
                                <li><a href="{{route('profile-show' , Auth::user()->id)}}">صفحه پروفایل</a></li>
                            @else
                                <li><a href="{{route('basket')}}">سبد خرید</a></li>

                            @endif

                            <li class="sub-menu-separator"></li>
                            @if(Auth::check())
                                <li><a href="{{route('logout')}}"> <i class="icon-unlock"></i>خروج</a></li>
                            @else

                                <li><a href="#" data-toggle="modal" data-target="#modalLogin"><i
                                                class="icon-unlock"></i>ورود/عضویت
                                        </a></li>
                            @endif
                        </ul>
                    </div>
                    @php
                        $all_price = 0;
                    @endphp

                    @foreach($basket_count as $value)
                        @if(count($value->model))
                        @php $all_price += $value->price * $value->num @endphp
                        @endif
                    @endforeach
                    <div class="cart"><a href="{{route('basket')}}"></a><i class="icon-bag"></i><span
                                class="count">{{count($basket_count)}}</span><span
                                class="subtotal"><span class="numberPrice" style="color: white">{{$all_price}}</span> تومان</span>
                        <div class="toolbar-dropdown">
                            @if(count($basket_count))
                            @foreach($basket_count as $value)
                                @if(count($value->model))
                                <div class="dropdown-product-item"><span class="dropdown-product-remove"></span>
                                    <a class="dropdown-product-thumb" href="#">
                                        <img src="{{url($value->product->pic!=null?$value->product->pic : $value->product->photo[0]->path)}}" alt="عکس محصول">

                                    </a>
                                    <div class="dropdown-product-info"><a class="dropdown-product-title"
                                                                          href="#">{{$value->product->title." مدل :  ".$value->model->name}}</a><span
                                                class="dropdown-product-details"><span class="numberPrice">{{$value->price}}</span> تومان</span> <span
                                                class="dropdown-product-details"> - {{$value->num}}</span></div>
                                </div>
                                    @endif
                            @endforeach
                            @endif
                            <div class="toolbar-dropdown-group">
                                <div class="column"><a class="btn btn-sm btn-block btn-secondary uk-text-center"
                                                       href="{{route('basket')}}">نمایش
                                        سبد</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="topbar-column">

        {{--some code here--}}
    </div>
</div>
<!-- Navbar-->
<!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
<!-- search -->
{{--<div class="journal-search j-min xs-100 sm-50 md-45 lg-45 xl-45" style="width: 50%;">--}}
    {{--<div id="search" class="input-group j-min">--}}

                {{--<div class="search-tools">--}}
                    {{--<span class="clear-search hidden-xs-down">پاک کردن</span>--}}
                    {{--<span class="close-search">--}}
                        {{--<i class="icon-cross"></i>--}}
                    {{--</span>--}}
                {{--</div>--}}

                {{--<div class="button-search"><button type="button"><i class="icon-search"></i></button></div>--}}




       {{--<div class="autocomplete2-suggestions" style="position: absolute; display: none; width: 100%; max-height: 2000px; z-index: 9999;"></div>--}}
    {{--</div>--}}
{{--</div>--}}




<header class="navbar navbar-sticky">
    <!-- Search-->
    <form class="site-search" action="{{route('search-box')}}" method="get">
        <input type="text" name="text" placeholder="عبارت مورد جستجو را تایپ کنید . . .">
        <div class="search-tools"><span class="clear-search hidden-xs-down">پاک کردن</span><span class="close-search"><i
                        class="icon-cross"></i></span></div>
    </form>
    <div class="site-branding">

        <div class="inner">
            <!-- Off-Canvas Toggle (#shop-categories)--><!--<a class="offcanvas-toggle cats-toggle " href="#shop-categories"
                                                           data-toggle="offcanvas"></a>-->
            <!-- Off-Canvas Toggle (#mobile-menu)--><a class="offcanvas-toggle menu-toggle " href="#mobile-menu"
                                                       data-toggle="offcanvas"></a>
            <!-- Site Logo--><a class="site-logo" href="{{url('/')}}"><img
                        src="{{asset('source/assets/logo.png')}}" alt="TopShop"></a>
        </div>
    </div>

    <!-- Main Navigation-->
    <nav class="site-menu">
        <ul>
            <li class="{{ (\Request::route()->getName() == 'home') ? 'active' : ''}} "><a href="{{route('home')}}"><span><i style="background: unset!important;" uk-icon="home"></i> خانه </span></a></li>

            <?php
            $categori=App\Category::where('parent_id', null)->orderBy('sort_id', 'asc')->get();
            ?>
            @foreach($categori as $category)


                <li  class="has-megamenu"><a href="{{route('products',$category->slug)}}">
                        <span>
                            @if(!is_null($category->icon))
                                <img style="width: 20px" src="{{url($category->icon)}}">
                            @endif
                            {{$category->name}}
                        </span></a>
                    <ul class="mega-menu">
                        @if(!empty($category->children))
                            @if(count($category->children))
                                @foreach($category->children as $key => $child2)
                                    <li>
                                        <a href="{{route('products',$category->slug)}}">
                                            <a class="mega-menu-title"
                                               href="{{route('products',$child2->slug)}}">{{$child2->name}}</a>
                                        </a>
                                        <ul class="sub-menu">

                                            @if(!empty($child2->children))
                                                @if(count($child2->children))
                                                    @foreach($child2->children as $key => $child3)
                                                        <li>
                                                            <a href="{{route('products',$child3->slug)}}">{{$child3->name}}</a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </ul>
                                    </li>

                                @endforeach
                            @endif
                        @endif


                        <li>
                            <section class="promo-box" style="background-image: url({{url($category->photo->path)}});width: 200px;float: left"><span
                                        class="overlay-dark" style="opacity: .4;"></span>
                                <div class="promo-box-content text-center padding-top-2x padding-bottom-2x">
                                    <h3 class="text-bold text-light text-shadow">{{$category->name}}</h3>
                                    <a class="btn btn-sm btn-primary" href="{{route('products',$category->slug)}}">همین
                                        حالا خرید کنید</a>
                                </div>
                            </section>
                        </li>
                    </ul>
                </li>






            @endforeach


            {{--<li><a href="#"><span>درباره ما</span></a>--}}
            {{--<ul class="sub-menu">--}}
            {{--<li><a href="{{route('about-us','1')}}">فارسی</a></li>--}}
            {{--<li><a href="{{route('about-us','2')}}">العربی</a></li>--}}
            {{--<li><a href="{{route('about-us','3')}}">English</a></li>--}}
            {{--<li><a href="{{route('about-us','4')}}">Germany</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}


        </ul>
    </nav>

</header>

@yield('content')


{{--<div class="offcanvas-wrapper" style="padding-top: 25px">--}}


    <!-- Site Footer-->
    <footer class="site-footer" style="padding-top: 25px;padding-bottom: 5px;box-shadow: 0 2px 2px 2px #d6d6d6">
        <div class="">
            <div class="uk-grid" style="padding: 0 40px">
                <div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s" style="padding-left: 25px!important;margin-top: 20px">
                    <!-- About Us-->
                    <section class="widget widget-links widget-light-skin">
                        <h3 class="widget-title">صفحات</h3>
                        <ul>
                            <li><a href="{{route('news_all')}}"><i uk-icon="chevron-left" style="background: unset!important;"></i> اخبار</a></li>
                            <li><a href="{{route('articles')}}"><i uk-icon="chevron-left" style="background: unset!important;"></i> مقالات  </a></li>
                            <li><a href="{{route('contact-us')}}"><i uk-icon="chevron-left" style="background: unset!important;"></i> تماس با ما </a></li>
                            <li><a href="{{route('about-us',1)}}"><i uk-icon="chevron-left" style="background: unset!important;"></i> درباره ما </a></li>
                            <li><a href="{{route('employment_show')}}"><i uk-icon="chevron-left" style="background: unset!important;"></i> فرم درخواست همکاری </a></li>
                            <li><a href="{{route('gallerys_photo')}}"><i uk-icon="chevron-left" style="background: unset!important;"></i> گالری تصاویر </a></li>
                            <li><a href="{{route('gallerys_videos')}}"><i uk-icon="chevron-left" style="background: unset!important;"></i> ویدئوها </a></li>


                        </ul>
                    </section>
                </div>

                <div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s" style="padding-left: 25px!important;margin-top: 20px">
                    <!-- Mobile App Buttons-->
                    <section class="widget widget-links widget-light-skin">
                        <h3 class="widget-title">صفحات جانبی</h3>

                        <ul>
                            <li><a href="{{route('complaint')}}"><i uk-icon="chevron-left" style="background: unset!important;"></i> ثبت شکایات</a></li>
                            @foreach(App\Footer::all() as $value)

                                <li><a href="{{route('static' , $value->slug)}}"><i uk-icon="chevron-left" style="background: unset!important;"></i> {{$value->title}}</a></li>
                            @endforeach

                        </ul>


                    </section>
                </div>
                <div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s" style="padding-left: 15px!important;margin-top: 20px">
                    <!-- Contact Info-->
                    <section class="widget widget-light-skin">
                        <h3 class="widget-title">ارتباط با ما</h3>
                        <p style="font-size: 12px">تهران، خیابان آزادی، حد فاصل نواب و اسکندری، پلاک ۱۸۶، مجتمع اداری پانامال، طبقۀ ۴، واحد 408
                        </p>
                        <p style="font-size: 12px">تلفن (شرکت) :  ۸۶ – ۰۲۱۶۵۰۱۰۲۸۵ </p>
                        <p style="font-size: 12px">ایمیل : info@iioco.co
                        </p>
                        <p style="font-size: 12px">شبکه های اجتماعی  : ۰۹۱۲۰۱۲۰۴۶۶ </a>
                        </p>


                    </section>
                </div>
                <style>
                    .class_uk_form{
                        width: 75%!important;
                    }
                    .class_uk_form .class_uk_input
                    {
                        height: 40px!important;
                        border-radius: 5px!important;
                    }
                    .class_uk_form .class_uk_button{
                        height: 38px!important;
                        border-radius: 5px 0 0 5px;
                        padding: 0 30px!important;
                        font-size: 15px!important;
                    }
                </style>

                <div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s uk-text-center" style="padding-left: 10px!important;margin-top: 20px">
                    <div style="width: 100%;text-align: center;">
                    </div>
                    {{--<!-- Account / Shipping Info-->--}}
                    {{--<section class="widget widget-links widget-light-skin uk-text-center">--}}
                    {{--<div class="uk-margin">--}}
                        {{--<form class="uk-search uk-search-default class_uk_form" action="{{route('newsletter_subscription')}}" method="post">--}}
                            {{--{{csrf_field()}}--}}
                            {{--<button href="" uk-search-icon class="class_uk_button">ارسال</button>--}}
                            {{--<input class="uk-search-input class_uk_input" style="font-size: 12px" type="email" name="email" placeholder="آدرس ایمیل خود را وارد کنید" required oninvalid="this.setCustomValidity('آدرس ایمیل را بصورت صحیح وارد کنید')"--}}
                                   {{--oninput="setCustomValidity('')">--}}
                        {{--</form>--}}
                    {{--</div>--}}

                        {{--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3239.024862709308!2d51.436991774276436!3d35.725607057145965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfa!2s!4v1559562777191!5m2!1sfa!2s" width="100%" height="250px" frameborder="0" style="border:0;height: 250px;width: 100%" allowfullscreen></iframe>                        </div>--}}

                </section>

                </div>
            </div>

        {{--<div class="footer2">--}}
            {{--<div class="container">--}}
<!--                --><?php
//                $about=App\About::find(3);
//                ?>
                {{--<div class="uk-grid" style="padding-bottom: 25px!important;">--}}
                    {{--<div class="uk-width-2-3@m uk-width-1-2@s" style="text-align: right">--}}
                        {{--<h4>{{$about->titr2}}</h4>--}}
                        {{--<p style="text-align: justify">{{$about->text2}}</p>--}}
                    {{--</div>--}}
                    {{--<div class="uk-width-1-3@m uk-width-1-2@s">--}}
                        {{--<div class="uk-grid">--}}
                            {{--<div class="uk-width-1-2 nemad">--}}
                                {{--<div class="nemad2">--}}
                                    {{--<img src="{{asset('source/assets/enemad.png')}}" style="width: 100%">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="uk-width-1-2 nemad">--}}
                                {{--<div class="nemad2">--}}
                                    {{--<img src="{{asset('source/assets/samandehi.png')}}" style="width: 100%">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
                <!-- Copyright-->
                <p class="footer-copyright">© کلیه حقوق محفوظ است , طراحی و توسعه توسط &nbsp;<a href="https://adib-it.com/" target="_blank">
                        &nbsp;ادیب گستر عصر نوین</a></p>
            {{--</div>--}}
        {{--</div>--}}


    </footer>
    {{--<footer>--}}
        {{--<div class="row footer-rr">--}}
            {{--<div class="col-md-2 footer-co">--}}
                {{--<img src="https://adibforex.ir/source/assets/samandehi.png" alt="">--}}
            {{--</div>--}}
            {{--<div class="col-md-6 footer-co">آدرس: تهران،خیابان امام خمینی،جنب بیمارستان سینا،کوچه میرزایی،پاساژ محسن،طبقه 4 واحد63--}}
                {{--شماره تماس: 66066072-021--}}
                {{--شماره تماس: 66171486-021--}}
                {{--ساعت کاری: شنبه تا چهارشنبه ساعت 9 الی 18،پنج شنبه 9 الی 13--}}
                {{--ایمیل: info@kifabzar.com</div>--}}
            {{--<div class="col-md-2 footer-co">--}}
                {{--نحوه ارسال کالا--}}
                {{--نحوه پرداخت--}}
                {{--ضمانت بازگشت کالا--}}
                {{--قوانین و مقررات--}}
                {{--درباره ما--}}
            {{--</div>--}}
            {{--<div class="col-md-2 footer-co">--}}
                {{--<a  class="social-button shape-circle sb-facebook sb-light-skin uk-visible@m" href="http://www.facebook.com/."><i style="font-size: 13px" class="socicon-facebook"></i></a>--}}
                {{--<a  class="social-button shape-circle sb-instagram sb-light-skin uk-visible@m" href="https://www.instagram.com/"><i style="font-size: 13px" class="socicon-instagram"></i></a>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</footer>--}}
{{--</div>--}}

<div class="site-backdrop"></div>

</body>
<script type="text/javascript" src="{{ asset('source/assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{asset('source/assets/shop/js/vendor.min.js')}}"></script>
{{--<script src="{{asset('source/assets/shop/js/adib_slider.js')}}"></script>--}}
<script src="{{asset('source/assets/shop/js/scripts.min.js')}}"></script>
<script src="{{asset('source/assets/shop/js/fancy-slider/index.js')}}"></script>
{{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
<script type="text/javascript" src="{{ asset('source/assets/js/jgrowl.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.numberPrice').text(function (index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","); });
    });

</script>

@if (count($errors) > 0)

    <script type="text/javascript">
        $.jGrowl('<ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>', {
            life: 5000,
            position: 'bottom-right',
            theme: 'bg-danger'
        });
    </script>

@endif
@if(Session::has('flash_message'))
    <script type="text/javascript">
        $.jGrowl('{!! session("flash_message") !!}', {life: 5000, position: 'bottom-right', theme: 'bg-success'});
    </script>

@endif

@if(Session::has('err_message'))

    <script type="text/javascript">
        $.jGrowl('{!! session("err_message") !!}', {life: 5000, position: 'bottom-right', theme: 'bg-danger'});
    </script>

@endif
@yield('scripts')


</html>