<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<?php
$set=App\Setting::find(1);
?>
<head>
    <meta charset="utf-8">
    <title><?php echo e($titlt_page??$set->title); ?></title>
    <meta name="description" content="<?php echo e($set->description); ?> ">
    <link rel="canonical" href="http://iioco.co"/>
    <meta property="og:type" content="ecommerce"/>
    <meta property="og:title" content="<?php echo e($set->title); ?>"/>
    <?php $__currentLoopData = explode("،",$set->keywords); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key125): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <meta name="keywords" content="<?php echo e($key125); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <meta property="og:description" content="<?php echo e($set->description); ?> "/>
    <meta property="og:image" content="<?php echo e(url($set->about_pic)); ?>"/>
    <meta property="og:url" content="http://iioco.co"/>
    <meta property="og:site_name" content="<?php echo e($set->title); ?>"/>
    <meta name="revisit-after" content="7 days"/>
    <meta id="csrf" name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo e($set->description); ?>">
    <?php $__currentLoopData = explode("،",$set->keywords); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key125): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <meta name="keywords" content="<?php echo e($key125); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4774264488206253" crossorigin="anonymous"></script>
    
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon and Apple Icons-->
    <link rel="icon" type="image/png" href="<?php echo e(url('favlogo.png')); ?>">
    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="<?php echo e(asset('source/assets/shop/css/vendor.min.css')); ?>">
    <!-- Main Template Styles-->
    <link id="mainStyles" rel="stylesheet" media="screen" href="<?php echo e(asset('source/assets/shop/css/styles.css?ver=1')); ?>">
    <link id="mainStyles" rel="stylesheet" media="screen" href="<?php echo e(asset('source/assets/shop/css/rtl.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('source/assets/shop/css/fancy-slider/style.css')); ?>">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.25/css/uikit.min.css"/>
    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.25/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.25/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Modernizr-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('source/assets/css/jgrowl.min.css')); ?>"/>
    <script src="<?php echo e(asset('source/assets/shop/js/document.min.js')); ?>"></script>


    <!-- product slider -->
    <link rel='stylesheet' href="<?php echo e(asset('source/assets/css/slick.css')); ?>">
    <link rel='stylesheet' href="<?php echo e(asset('source/assets/css/jquery.fancybox.min.css')); ?>">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo e(asset('source/assets/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('source/assets/js/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('source/assets/js/jquery.fancybox.min.js')); ?>"></script>
    <script id="rendered-js">

        <?php echo $__env->yieldContent('css'); ?>
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

        @keyframes  move {
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
            <form action="<?php echo e(route('login')); ?>" method="post">

                <?php echo e(csrf_field()); ?>

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
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-rounded btn-primary btn-sm w-100"
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
        <div class="user-ava"><img src="<?php echo e(asset('source/assets/shop/img/man.png')); ?>" alt="Daniel Adams"></div>
        <div class="user-info">
            <?php if(Auth::check()): ?>
                <span style="color: white"><?php echo e(Auth::user()->first_name . ' ' . Auth::user()->last_name); ?></span>
            <?php else: ?>
                <span style="color: white">کاربر مهمان</span>

            <?php endif; ?>
        </div>
    </a>
    <nav class="offcanvas-menu">
        <ul class="menu">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="has-children">
                <span>
                    <a href="<?php echo e(route('products',$category->slug)); ?>"><?php echo e($category->name); ?></a>
                    <?php if(!empty($category->children)): ?>
                        <?php if(count($category->children)): ?>
                            <span class="sub-menu-toggle"></span>
                        <?php endif; ?>
                    <?php endif; ?>

                </span>
                    <!--                --><?php
                                               //                $child=App\ProductCategory::where('parent_id',$category->id)->get();
                                               //                ?>
                    <?php if(!empty($category->children)): ?>
                        <?php if(count($category->children)): ?>
                            <ul class="offcanvas-submenu">

                                <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('products',$child->slug)); ?>"><?php echo e($child->name); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>
</div>
<!-- Off-Canvas Mobile Menu-->
<div class="offcanvas-container" id="mobile-menu">
    <a class="account-link" <?php if(Auth::check()): ?> href="/panel" <?php else: ?> href="#" data-toggle="modal" data-target="#modalLogin" <?php endif; ?> >
        <div class="user-ava"><img src="<?php echo e(asset('source/assets/shop/img/man.png')); ?>" alt="Daniel Adams"></div>
        <div class="user-info">
            <?php if(Auth::check()): ?>
                <span style="color: white"><?php echo e(Auth::user()->first_name . ' ' . Auth::user()->last_name); ?></span>
            <?php else: ?>
                <span style="color: white">ورود / عضویت</span>

            <?php endif; ?>
        </div>
    </a>
    <nav class="offcanvas-menu">
        <ul class="menu">
            <?php
            $categori=App\Category::where('parent_id', null)->orderBy('sort_id', 'asc')->get();
            ?>
            <?php $__currentLoopData = $categori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="has-children">
                <span>
                    <a href="<?php echo e(route('products',$category->slug)); ?>"><?php echo e($category->name); ?></a>
                    <?php if(!empty($category->children)): ?>
                        <?php if(count($category->children)): ?>
                            <span class="sub-menu-toggle"></span>
                        <?php endif; ?>
                    <?php endif; ?>

                </span>
                        <?php
                        $child=App\Category::where('parent_id',$category->id)->orderby('sort_id','asc')->get();
                        ?>
                    <?php if(!empty($child)): ?>
                        <?php if(count($child)): ?>
                            <ul class="offcanvas-submenu">

                                <?php $__currentLoopData = $child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('products',$child->slug)); ?>"><?php echo e($child->name); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        
        
        
        <a  href="#modal_1" uk-toggle>
            <i class="icon-map"></i>&nbsp; قوانین و مقررات فروش
        </a>
        <a href="<?php echo e(route('contact-us')); ?>" class="hidden-md-down">
            <i uk-icon="receiver" style="background: unset!important;"></i>&nbsp; تماس با ما
        </a>
        <a class="hidden-md-down">
            <i uk-icon="user" style="background: unset!important;"></i>&nbsp; درباره ما
        </a>
        <div uk-dropdown>
            <ul class="uk-nav uk-dropdown-nav">
                <li class="uk-active"><a href="<?php echo e(route('about-us',1)); ?>"><?php echo e($aboutss->titr1); ?></a></li>
                <li class="uk-active"><a href="<?php echo e(route('about-us',2)); ?>"><?php echo e($aboutss->titr2); ?></a></li>
                <li class="uk-active"><a href="<?php echo e(route('about-us',3)); ?>"><?php echo e($aboutss->titr3); ?></a></li>
                <li class="uk-active"><a href="<?php echo e(route('about-us',4)); ?>"><?php echo e($aboutss->titr4); ?></a></li>
                <li class="uk-active"><a href="<?php echo e(route('about-us',5)); ?>"><?php echo e($aboutss->titr5); ?></a></li>
                <li class="uk-active"><a href="<?php echo e(route('about-us',6)); ?>"><?php echo e($aboutss->titr6); ?></a></li>
                <li class="uk-active"><a href="<?php echo e(route('about-us',7)); ?>"><?php echo e($aboutss->titr7); ?></a></li>
                <li class="uk-active"><a href="<?php echo e(route('about-us',8)); ?>"><?php echo e($aboutss->titr8); ?></a></li>
                <li class="uk-active"><a href="<?php echo e(route('about-us',9)); ?>"><?php echo e($aboutss->titr9); ?></a></li>
                <li class="uk-active"><a href="<?php echo e(route('about-us',10)); ?>"><?php echo e($aboutss->titr10); ?></a></li>
                <li class="uk-active"><a href="<?php echo e(route('about-us',11)); ?>"><?php echo e($aboutss->titr11); ?></a></li>

            </ul>
        </div>
        
        
        












        <!-- Toolbar-->
        <div class="toolbar">
            <div class="inner">
                <span class="uk-visible@m">تلفن (شرکت) : ۸۶ – ۰۲۱۶۵۰۱۰۲۸۵  </span>
                <a  class="social-button shape-circle sb-facebook sb-light-skin uk-visible@m" href="http://www.facebook.com/."><i style="font-size: 13px" class="socicon-facebook"></i></a>
                <a  class="social-button shape-circle sb-whatsapp sb-light-skin uk-visible@m" href="http://www.whatsapp.com/"><i style="font-size: 13px" class="socicon-whatsapp"></i></a>
                <a  class="social-button shape-circle sb-instagram sb-light-skin uk-visible@m" href="https://www.instagram.com/"><i style="font-size: 13px" class="socicon-instagram"></i></a>
                <div class="tools">
                    <div id="clockbox" class="uk-visible@m" style="    font: normal 11px verdana;color: #333; float: right; margin-top: 4px;margin-left: 20px;background: #11DDBF;padding: 8px; border-radius: 20px;">12:50:24 PM</div>
                    <form class="uk-search uk-search-default"  action="<?php echo e(route('search-box')); ?>" method="get">
                        <button class="uk-search-icon" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
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
                                    <h6 class="user-name"><?php if(Auth::check()): ?> <?php echo e(Auth::user()->first_name . ' ' . Auth::user()->last_name); ?> <?php else: ?>
                                            کاربر مهمان  <?php endif; ?></h6>
                                </div>
                            </li>
                            <?php if(Auth::check()): ?>
                                <li><a href="<?php echo e(route('order-list')); ?>">لیست سفارشات</a></li>
                                <li><a href="<?php echo e(route('favorite')); ?>">لیست علاقه مندی</a></li>
                                <li><a href="<?php echo e(route('profile-show' , Auth::user()->id)); ?>">صفحه پروفایل</a></li>
                            <?php else: ?>
                                <li><a href="<?php echo e(route('basket')); ?>">سبد خرید</a></li>

                            <?php endif; ?>

                            <li class="sub-menu-separator"></li>
                            <?php if(Auth::check()): ?>
                                <li><a href="<?php echo e(route('logout')); ?>"> <i class="icon-unlock"></i>خروج</a></li>
                            <?php else: ?>

                                <li><a href="#" data-toggle="modal" data-target="#modalLogin"><i
                                                class="icon-unlock"></i>ورود/عضویت
                                    </a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php
                        $all_price = 0;
                    ?>

                    <?php $__currentLoopData = $basket_count; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($value->model&&$value->model->count()): ?>
                            <?php $all_price += $value->price * $value->num ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="cart"><a href="<?php echo e(route('basket')); ?>"></a><i class="icon-bag"></i><span
                                class="count"><?php echo e(count($basket_count)); ?></span><span
                                class="subtotal"><span class="numberPrice" style="color: white"><?php echo e($all_price); ?></span> تومان</span>
                        <div class="toolbar-dropdown">
                            <?php if(count($basket_count)): ?>
                                <?php $__currentLoopData = $basket_count; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($value->model&&$value->model->count()): ?>
                                        <div class="dropdown-product-item"><span class="dropdown-product-remove"></span>
                                            <a class="dropdown-product-thumb" href="#">
                                                <img src="<?php echo e(url($value->product->pic!=null?$value->product->pic : $value->product->photo[0]->path)); ?>" alt="عکس محصول">

                                            </a>
                                            <div class="dropdown-product-info"><a class="dropdown-product-title"
                                                                                  href="#"><?php echo e($value->product->title." مدل :  ".$value->model->name); ?></a><span
                                                        class="dropdown-product-details"><span class="numberPrice"><?php echo e($value->price); ?></span> تومان</span> <span
                                                        class="dropdown-product-details"> - <?php echo e($value->num); ?></span></div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="toolbar-dropdown-group">
                                <div class="column"><a class="btn btn-sm btn-block btn-secondary uk-text-center"
                                                       href="<?php echo e(route('basket')); ?>">نمایش
                                        سبد</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="topbar-column">

        
    </div>
</div>
<!-- Navbar-->
<!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
<!-- search -->






















<header class="navbar navbar-sticky">
    <!-- Search-->
    <form class="site-search" action="<?php echo e(route('search-box')); ?>" method="get">
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
            <!-- Site Logo--><a class="site-logo" href="<?php echo e(url('/')); ?>"><img
                        src="<?php echo e(asset('source/assets/logo.png?v2')); ?>" alt="TopShop"></a>
        </div>
    </div>

    <!-- Main Navigation-->
    <nav class="site-menu">
        <ul>
            <li class="<?php echo e((\Request::route()->getName() == 'home') ? 'active' : ''); ?> "><a href="<?php echo e(route('home')); ?>"><span><i style="background: unset!important;" uk-icon="home"></i> خانه </span></a></li>
            <li class="<?php echo e((\Request::route()->getName() == 'articles') ? 'active' : ''); ?> "><a href="<?php echo e(route('articles')); ?>">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journals" viewBox="0 0 16 16">                               <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z"/>                               <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z"/>                             </svg>
               مقالات </span>
                </a>
            </li>

            <?php
            $categori=App\Category::where('parent_id', null)->orderBy('sort_id', 'asc')->get();
            ?>
            <?php $__currentLoopData = $categori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <li  class="has-megamenu"><a href="<?php echo e(route('products',$category->slug)); ?>">
                        <span>
                            <?php if(!is_null($category->icon)): ?>
                                <img style="width: 20px" src="<?php echo e(url($category->icon)); ?>">
                            <?php endif; ?>
                            <?php echo e($category->name); ?>

                        </span></a>
                    <ul class="mega-menu">
                        <?php if(!empty($category->children)): ?>
                            <?php if(count($category->children)): ?>
                                <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $child2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('products',$category->slug)); ?>">
                                            <a class="mega-menu-title"
                                               href="<?php echo e(route('products',$child2->slug)); ?>"><?php echo e($child2->name); ?></a>
                                        </a>
                                        <ul class="sub-menu">

                                            <?php if(!empty($child2->children)): ?>
                                                <?php if(count($child2->children)): ?>
                                                    <?php $__currentLoopData = $child2->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $child3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <a href="<?php echo e(route('products',$child3->slug)); ?>"><?php echo e($child3->name); ?></a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endif; ?>


                        <li>
                            <section class="promo-box" style="background-image: url(<?php echo e(url($category->photo->path)); ?>);width: 200px;float: left"><span
                                        class="overlay-dark" style="opacity: .4;"></span>
                                <div class="promo-box-content text-center padding-top-2x padding-bottom-2x">
                                    <h3 class="text-bold text-light text-shadow"><?php echo e($category->name); ?></h3>
                                    <a class="btn btn-sm btn-primary" href="<?php echo e(route('products',$category->slug)); ?>">همین
                                        حالا خرید کنید</a>
                                </div>
                            </section>
                        </li>
                    </ul>
                </li>






            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            
            
            
            
            
            
            
            


        </ul>
    </nav>

</header>

<?php echo $__env->yieldContent('content'); ?>





<!-- Site Footer-->
<footer class="site-footer" style="padding-top: 25px;padding-bottom: 5px;box-shadow: 0 2px 2px 2px #d6d6d6">
    <div class="">
        <div class="uk-grid" style="padding: 0 40px">
            <div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s" style="padding-left: 25px!important;margin-top: 20px">
                <!-- About Us-->
                <section class="widget widget-links widget-light-skin">
                    <h3 class="widget-title">صفحات</h3>
                    <ul>
                        <li><a href="<?php echo e(route('news_all')); ?>"><i uk-icon="chevron-left" style="background: unset!important;"></i> اخبار</a></li>
                        <li><a href="<?php echo e(route('articles')); ?>"><i uk-icon="chevron-left" style="background: unset!important;"></i> مقالات  </a></li>
                        <li><a href="<?php echo e(route('contact-us')); ?>"><i uk-icon="chevron-left" style="background: unset!important;"></i> تماس با ما </a></li>
                        <li><a href="<?php echo e(route('about-us',1)); ?>"><i uk-icon="chevron-left" style="background: unset!important;"></i> درباره ما </a></li>
                        <li><a href="<?php echo e(route('employment_show')); ?>"><i uk-icon="chevron-left" style="background: unset!important;"></i> فرم درخواست همکاری </a></li>
                        <li><a href="<?php echo e(route('gallerys_photo')); ?>"><i uk-icon="chevron-left" style="background: unset!important;"></i> گالری تصاویر </a></li>
                        <li><a href="<?php echo e(route('gallerys_videos')); ?>"><i uk-icon="chevron-left" style="background: unset!important;"></i> ویدئوها </a></li>


                    </ul>
                </section>
            </div>

            <div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s" style="padding-left: 25px!important;margin-top: 20px">
                <!-- Mobile App Buttons-->
                <section class="widget widget-links widget-light-skin">
                    <h3 class="widget-title">صفحات جانبی</h3>

                    <ul>
                        <li><a href="<?php echo e(route('complaint')); ?>"><i uk-icon="chevron-left" style="background: unset!important;"></i> ثبت شکایات</a></li>
                        <?php $__currentLoopData = App\Footer::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li><a href="<?php echo e(route('static' , $value->slug)); ?>"><i uk-icon="chevron-left" style="background: unset!important;"></i> <?php echo e($value->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
            <div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s" style="padding-left: 15px!important;margin-top: 20px">
                <!-- Contact Info-->
                <section class="widget widget-light-skin">
                    <h3 class="widget-title">شبکه های اجتماعی</h3>
                    <a style="background-color: #11ddbf;line-height: 1.1;padding-right: 2px;" class="social-button shape-circle sb-facebook sb-light-skin uk-visible@m" href="http://www.facebook.com/."><i style="font-size: 13px" class="socicon-facebook"></i></a>
                    <a style="background-color: #11ddbf;line-height: 2.5;padding-right: 1px;" class="social-button shape-circle sb-whatsapp sb-light-skin uk-visible@m" href="http://www.whatsapp.com/"><i style="font-size: 13px" class="socicon-whatsapp"></i></a>
                    <a style="background-color: #11ddbf;line-height: 1.1;padding-right: 2px;" class="social-button shape-circle sb-instagram sb-light-skin uk-visible@m" href="https://www.instagram.com/"><i style="font-size: 13px" class="socicon-instagram"></i></a>
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
                
                
                
                
                
                
                
                
                
                

                

                </section>

            </div>
        </div>

        
        
        <!--                --><?php
//                $about=App\About::find(3);
//                ?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        <!-- Copyright-->
        <p class="footer-copyright">© کلیه حقوق محفوظ است , طراحی و توسعه توسط &nbsp;<a href="https://adib-it.com/" target="_blank">
                &nbsp;ادیب گستر عصر نوین</a></p>
    
    


</footer>


























<div class="site-backdrop"></div>

</body>
<script type="text/javascript" src="<?php echo e(asset('source/assets/js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('source/assets/shop/js/vendor.min.js')); ?>"></script>

<script src="<?php echo e(asset('source/assets/shop/js/scripts.min.js')); ?>"></script>
<script src="<?php echo e(asset('source/assets/shop/js/fancy-slider/index.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('source/assets/js/jgrowl.min.js')); ?>"></script>

<script>
    $(document).ready(function () {
        $('.numberPrice').text(function (index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","); });
    });

</script>

<?php if(count($errors) > 0): ?>

    <script type="text/javascript">
        $.jGrowl('<ul> <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <li><?php echo e($error); ?></li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul>', {
            life: 5000,
            position: 'bottom-right',
            theme: 'bg-danger'
        });
    </script>

<?php endif; ?>
<?php if(Session::has('flash_message')): ?>
    <script type="text/javascript">
        $.jGrowl('<?php echo session("flash_message"); ?>', {life: 5000, position: 'bottom-right', theme: 'bg-success'});
    </script>

<?php endif; ?>

<?php if(Session::has('err_message')): ?>

    <script type="text/javascript">
        $.jGrowl('<?php echo session("err_message"); ?>', {life: 5000, position: 'bottom-right', theme: 'bg-danger'});
    </script>

<?php endif; ?>
<?php echo $__env->yieldContent('scripts'); ?>


</html>
