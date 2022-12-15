@extends('layouts.front')
@section('content')
    @php
        $banner = App\Banner::orderBy('sort'  , 'ASC')->get();
    @endphp

    <style>
        @media (min-width: 1200px) {
            * + .uk-grid-margin, .uk-grid + .uk-grid, .uk-grid > .uk-grid-margin {
                margin-top: unset !important;
            }
        }

        * + .uk-grid-margin, .uk-grid + .uk-grid, .uk-grid > .uk-grid-margin {
            margin-top: unset !important;
        }

        @media (min-width: 1200px) {
            .uk-grid > * {
                margin-left: unset !important;
                padding-left: unset !important;
            }
        }

        @media (max-width: 1200px) {
            .uk-grid > * {
                margin-left: unset !important;
                padding-left: unset !important;
                margin-top: 5px !important;
            }
        }

        @media (min-width: 1200px) {
            .uk-grid {
                margin-left: unset !important;
                padding-left: 10px !important;
            }
        }

        .uk-grid {
            margin-left: unset !important;
            padding-left: 10px !important;;
        }

        .row {
            padding-right: 10px !important;
            padding-left: 10px !important;
        }

        .ads {
            padding: 0 5px !important;
            text-align: center;
        }

        .ads > a > img {
            width: 100%;
            height: 250px;
            box-shadow: 0 0 2px 2px #d6d6d6;
            border-radius: 2px !important;
        }

        .ads > a > img:hover {
            /*-webkit-transform: scale3d(0.9, 0.9, 0.5);*/
            /*transform: scale3d(0.9, 0.9, 0.5);*/
            width: 97% !important;
            margin-top: 3px;
            height: 244px;
            border-radius: 10px !important;
            box-shadow: 0 0 3px 2px #6d6d6d;
            -webkit-transition: all 0.3s linear;
            transition: all 0.3s linear;
        }

        @media (max-width: 1200px) and (min-width: 640px) {
            .ads3 {
                text-align: center;
            }

            .ads3 > a > img {
                width: 50%;
                height: 250px;
            }
        }

        .ul_propsal {
            box-shadow: 0 0 1px 1px #d6d6d6;
        }

        .li_propsal {
            text-align: center;
            padding: 20px 0;
        }

        .img_propsal {
            width: 65% !important;
            height: 65%;
        }

        .sel1 {
            position: absolute;
            width: 65px;
            top: 0;
            left: -3px !important;
        }

        .li_propsal > a > h4 {
            color: #202020;
            text-align: center;
            font-family: iransans !important;
            margin-top: 20px !important;
        }

        .li_propsal > a > p {
            color: #202020;
            font-size: 16px !important;
        }

        .p_user {
            color: red;
        }

        .p_vip {
            color: #004a11;
            margin-right: 10px;
            font-size: 17px !important;
        }

        .li_propsal > a:hover .img_propsal {
            -webkit-transform: scale3d(1.1, 1.1, 1);
            transform: scale3d(1.1, 1.1, 1);

            border-radius: 10px !important;
            box-shadow: 0 0 3px 2px #6d6d6d;
            -webkit-transition: all 0.3s linear;
            transition: all 0.3s linear;
        }

        .li_propsal > a:hover .li_propsal > a > h4, .li_propsal > a > p {
            text-shadow: 0 1px 2px #6d6d6d;
            /*border-radius: 10px!important;*/
            /*box-shadow: 0 0 3px 2px #6d6d6d;*/
            -webkit-transition: all 0.3s linear;
            transition: all 0.3s linear;
        }

        .titr {
            width: 100%;
            height: 50px !important;
            line-height: 50px;
            font-size: 17px !important;
            background: #7c0304;
            color: white !important;
            text-align: center;
        }

        .uk-card-title {
            text-align: center;
            font-family: iransans;
            font-size: 17px !important;
        }

        .uk-card-body > p {
            color: #202020;
            text-align: center !important;
        }

        .btn_cat {
            width: 100%;
            text-align: center;
            padding: 7px 10px;
            font-size: 13px !important;
            border: 2px #7c0304 solid;
            border-radius: 25px !important;
            color: #7c0304 !important;
            text-decoration: none !important;
        }

        h6 {
            font-family: iransans !important;
        }

        .owl-item {
            padding-right: 5px !important;
        }

        .uk-width-3-4 {
            width: 100% !important;
        }

        .uk-slideshow-items {
            position: relative;
            z-index: 0;
            margin: 0;
            padding: 0;
            list-style: none;
            overflow: hidden;
            -webkit-touch-callout: none;
            /*min-height: 380.143px !important;*/
        }

        /*Lets create the magnifying glass*/
        .large {
            width: 175px;
            height: 175px;
            position: absolute;
            border-radius: 100%;

            /*Multiple box shadows to achieve the glass effect*/
            box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85),
            0 0 7px 7px rgba(0, 0, 0, 0.25),
            inset 0 0 40px 2px rgba(0, 0, 0, 0.25);

            /*hide the glass by default*/
            display: none;
        }

        /*To solve overlap bug at the edges during magnification*/
        .small {
            display: block;
        }

    </style>
    <!-- Main Content-->

    <div class="uk-grid pt-2" style="background:none;">
        {{--<div class="uk-width-3-4@s  order-lg-2 mb-2 uk-hidden@s" style="padding-right:7px">--}}
        {{--<!-- Main Slider-->--}}


        {{--<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="autoplay:true;ratio: 8:3;animation:push">--}}

        {{--<ul class="uk-slideshow-items">--}}
        {{--@foreach($sliders as $key => $slider)--}}

        {{--<li>--}}
        {{--<a href="{{$slider->link}}"  rel="nofollow">--}}
        {{--<img src="{{url($slider->photo->path)}}" alt="" style="width: 100%;height: 100%">--}}
        {{--</a>--}}
        {{--</li>--}}

        {{--@endforeach--}}

        {{--</ul>--}}

        {{--<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>--}}
        {{--<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>--}}

        {{--</div>--}}

        {{--</div>--}}
        {{--<div class="uk-width-1-4@s order-lg-2 mb-2" style="padding-right:7px">--}}
        {{--<!-- Main Slider-->--}}


        {{--<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="autoplay:true;ratio: 8:8;animation:scale">--}}
        {{--<div class="titr">پیشنهادات شگفت انگیز</div>--}}

        {{--<ul class="uk-slideshow-items ul_propsal">--}}
        {{--@foreach($sliders as $key => $slider)--}}

        {{--<li class="li_propsal">--}}
        {{--<a href=""  rel="nofollow">--}}
        {{--<img class="img_propsal" src="{{url($slider->photo->path)}}" alt="">--}}

        {{--<img src="{{asset('source/assets/sel.png')}}" class="sel1">--}}
        {{--<h4>نام کالا</h4>--}}
        {{--<p> قیمت : <del class="numberPrice p_user">22000</del> <span class="numberPrice p_vip">20000</span> تومان  </p>--}}
        {{--</a>--}}

        {{--</li>--}}

        {{--@endforeach--}}

        {{--</ul>--}}

        {{--<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>--}}
        {{--<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>--}}

        {{--</div>--}}

        {{--</div>--}}

        {{--    <div class="uk-width-1-4  order-lg-2 mb-2" style="padding-right:7px">
                <ul class="uk-nav-default uk-nav-parent-icon" uk-nav="multiple: true">
                   @foreach($categories as $cat)
                    <li class="uk-parent uk-active">
                        <a href="#">Parent</a>
                        <ul class="uk-nav-sub">
                            <li><a href="#">Sub item</a></li>
                            <li>
                                <a href="#">Sub item</a>
                                <ul>
                                    <li><a href="#">Sub item</a></li>
                                    <li><a href="#">Sub item</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                       @endforeach
                </ul>
            </div>--}}
        <div class="uk-width-3-4  order-lg-2 mb-2" style="padding-right:7px">
            <!-- Main Slider-->
            <style>
                @media (min-width: 900px) {
                    .uk-slideshow-items {
                        height: 700px !important;
                    }

                }

                @media (max-width: 900px) {
                    .uk-slideshow-items {
                        height: 300px !important;
                    }

                }

            </style>

            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
                 uk-slider>


                <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m" style="direction: ltr">
                    @foreach($sliders as $key => $slider)

                        <li>
                            <a href="{{$slider->link}}" rel="nofollow">
                                <img src="{{url($slider->photo->path)}}" alt=""
                                     style="width: 100%;height: auto">

                            </a>
                            <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center">
                                <h5 class="uk-margin-remove">{{$slider->title}}</h5>
                                <p class="uk-margin-remove">{!! $slider->text !!}</p>

                            </div>
                        </li>

                    @endforeach

                </ul>
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>


            </div>

        </div>


    </div>
    <!-- Services-->
    <section class="" style="padding: 0 25px">
        <div class="uk-grid"
             style="border-bottom: 1px solid rgba(196,198,199,0.82)!important;padding-bottom: 20px!important;">
            <div class="uk-width-1-5@m uk-width-1-2@s uk-width-1-1 uk-text-center">
                <img style="margin-top: 10px;width: 58px;margin-bottom : 10px;"
                     src="{{asset('source/assets/img/p/1.png')}}" alt="Shipping">
                <p>تحویل اکسپرس</p>
                <p class="text-muted margin-bottom-none font-small">سفارش خود را بسرعت تحویل بگیرید</p>

            </div>
            <div class="uk-width-1-5@m uk-width-1-2@s uk-width-1-1 uk-text-center">
                <img style="width: 58px;margin-bottom : 10px;;margin-top: 10px"
                     src="{{asset('source/assets/img/p/2.png')}}" alt="Shipping">
                <p>پشتیبانی 24ساعته</p>
                <p class="text-muted margin-bottom-none font-small">پاسخگوی تماس شما بصورت 24 ساعته</p>
            </div>
            <div class="uk-width-1-5@m uk-width-1-2@s uk-width-1-1 uk-text-center">
                <img style="width: 58px;margin-bottom : 10px;;margin-top: 10px"
                     src="{{asset('source/assets/img/p/3.png')}}" alt="Shipping">
                <p>پرداخت در محل</p>
                <p class="text-muted margin-bottom-none font-small">پس از دریافت و اطمینان از کالا پرداخت کنید</p>
            </div>
            <div class="uk-width-1-5@m uk-width-1-2@s uk-width-1-1 uk-text-center">
                <img style="width: 58px;margin-bottom : 10px;;margin-top: 10px"
                     src="{{asset('source/assets/img/p/4.png')}}" alt="Shipping">
                <p>7 روز ضمانت بازگشت</p>
                <p class="text-muted margin-bottom-none font-small">برگشت کالا در صورت نارضایتی مشتری</p>
            </div>
            <div class="uk-width-1-5@m uk-width-1-2@s uk-width-1-1 uk-text-center">
                <img style="width: 58px;margin-bottom : 10px;;margin-top: 10px"
                     src="{{asset('source/assets/img/p/5.png')}}" alt="Shipping">
                <p>ضمانت اصل بودن کالا</p>
                <p class="text-muted margin-bottom-none font-small">مطمئن باشید کالایی اصل و با کیفیت خواهید داشت</p>
            </div>
        </div>
    </section>
    <!--End Container Row-->
    <div class="uk-grid pt-2" style="margin-top: 10px!important;padding-right: 10px">

        <div class="uk-width-3-4@m uk-width-1-2@s" style="width: 100%">


            {{--<section>--}}
            {{--<div class="row">--}}
            {{--<div class="col-md-4">--}}
            {{--<div class="col-md-12">--}}
            {{--<img src="http://tasisat.ir/img/cms/7.png" alt="">--}}
            {{--</div>--}}
            {{--<div class="col-md-12">--}}
            {{--<img src="http://tasisat.ir/img/cms/7.png" alt="">--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
            {{--<img src="https://tasisat.ir/img/cms/gif-koler-abi-energi.gif" alt="">--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
            {{--<div class="col-md-12">--}}
            {{--<img src="http://tasisat.ir/img/cms/7.png" alt="">--}}
            {{--</div>--}}
            {{--<div class="col-md-12">--}}
            {{--<img src="http://tasisat.ir/img/cms/7.png" alt="">--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
            {{--<div class="col-md-6"></div>--}}
            {{--<div class="col-md-6"></div>--}}
            {{--</div>--}}
            {{--</section>--}}
            <section class="pr-2 pl-2 pt-2 pb-2 rounded-5 soft-shadow mb-2" style="background:#fff">
                <h6 style="font-family: iransans!important" class="text-right border-title mb-3"> &#1583;&#1587;&#1578;&#1607;
                    &#1576;&#1606;&#1583;&#1740;
                    &#1605;&#1581;&#1589;&#1608;&#1604;&#1575;&#1578; </h6>
                <div class="uk-grid pt-2">
                    @foreach($categories as $key =>  $value)
                        @if($key <= 5)
                            <div class="uk-width-1-6@l uk-width-1-4@m uk-width-1-3@s "
                                 style="padding: 10px 7px!important;">
                                <div class="card mb-15 cat_hover">
                                    <a class="card-img-tiles" href="{{route('products',$value->slug)}}">
                                        <div class="inner">
                                            <div class="main-img">
                                                <img style="height: 150px" src="{{url($value->photo->path )}}"
                                                     alt="Category">
                                            </div>
                                        </div>
                                    </a>
                                    <div class="card-body uk-text-center">
                                        <h4 class="card-title"
                                            style="font-family: iransans!important">{{$value->name}}</h4>
                                        <a
                                                class="btn btn-outline-primary btn-sm"
                                                href="{{route('products',$value->slug)}}">&#1606;&#1605;&#1575;&#1740;&#1588;
                                            &#1605;&#1581;&#1589;&#1608;&#1604;&#1575;&#1578;</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>


            @if(count($vip_products)>0)
                <section class=" pr-2 pl-2 pt-2 pb-2 rounded-5 soft-shadow mb-2"
                         style="background:#fff">
                    {{--<h6 class="text-right border-title mb-3" style="font-family: iran-sans"> &#1604;&#1740;&#1587;&#1578; &#1605;&#1581;&#1589;&#1608;&#1604;&#1575;&#1578; &#1711;&#1585;&#1608;&#1607; {{$category->name}} </h6>--}}
                    <div class="o-headline border-title">
                    <span>
                      فروش ویژه
                    </span>

                    </div>
                    <div class="owl-carousel"
                         data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;margin&quot;: 10, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:5}} }">

                        @foreach($vip_products->take(20) as $key => $pro)
                            <?php
                            $product = App\Product::find($pro->product_id);
                            ?>

                            @if($product)

                                <div class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover"
                                     style="width: 100%; overflow: hidden;height: auto">
                                    @if($pro->discount_price!=null or $pro->discount_price!=0 and $pro->discount_price<$pro->price)
                                        <img class="offer" src="{{asset('source/assets/offer1.png')}}"
                                             style="width: 60px!important;">
                                        <span class="offer_span">%{{round(((intval($pro->price)-intval($pro->discount_price))/intval($pro->price))*100,1)}}</span>
                                    @endif
                                    <a href="{{route('product-info',$product->slug)}}" uk-tooltip="دیدن همه مدل ها">
                                        <div class="img_div"><img
                                                    src="{{$pro->pic!=null ? url('/'.$pro->pic):url('/'.$product->pic) }}"
                                                    alt="{{$pro->name}}" style="width: 100%;max-height: 290px"></div>
                                        <div class="px-2 py-2">
                                            <p class="">
                                                {{$pro->name}}
                                            </p>
                                            @if($pro->count>0)
                                                <p class="" style="margin-bottom: 50px">
                                                    @if($pro->discount_price!=null)
                                                        <del class="numberPrice"
                                                             style="margin-left: 10px">{{$pro->price}}</del>
                                                        <span class="numberPrice">{{$pro->discount_price}}</span>
                                                        <span> تومان </span>
                                                    @else
                                                        <span class="numberPrice">{{$pro->price}}</span>
                                                        <span> تومان </span>
                                                    @endif
                                                </p>
                                            @else
                                                <p style="padding-bottom: 51px"></p>
                                            @endif

                                        </div>
                                    </a>
                                    @if($pro->count>0)
                                        <a href="{{route('add-to-basket-model',$pro->id)}}"
                                           class="text-uppercase text-center styled-link"
                                           style="font-size: 12px!important;">
                                            <i uk-icon="cart" style="background: unset!important"></i>افزودن به سبد خرید
                                        </a>
                                    @elseif($pro->count==0)
                                        <a
                                                class="text-uppercase text-center styled-link10"
                                                style="font-size: 12px!important;">
                                            <i uk-icon="ban" style="background: unset!important"></i>ناموجود
                                        </a>
                                    @elseif($pro->count<0)
                                        <a
                                                class="text-uppercase text-center styled-link10"
                                                style="font-size: 12px!important;">
                                            <i uk-icon="refresh" style="background: unset!important"></i>بزودی
                                        </a>
                                    @endif
                                    {{--<a href="{{route('add-to-compare',$pro->id)}}" title="افزودن به لیست مقایسه"--}}
                                    {{--class="text-uppercase text-center styled-link1">--}}
                                    {{--<i uk-icon="expand"--}}
                                    {{--style="background: unset!important;color: #00967f!important;"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="{{route('add-to-favorite',$pro->id)}}" title="افزودن به لیست علاقه مندی ها"--}}
                                    {{--class="text-uppercase text-center styled-link2">--}}
                                    {{--<i uk-icon="heart"--}}
                                    {{--style="background: unset!important;color: #00967f!important;"></i>--}}
                                    {{--</a>--}}


                                </div>

                            @endif


                        @endforeach

                    </div>
                </section>
            @endif
            @if(count($new_products)>0)
                <section class=" pr-2 pl-2 pt-2 pb-2 rounded-5 soft-shadow mb-2"
                         style="background:#fff">
                    {{--<h6 class="text-right border-title mb-3" style="font-family: iran-sans"> &#1604;&#1740;&#1587;&#1578; &#1605;&#1581;&#1589;&#1608;&#1604;&#1575;&#1578; &#1711;&#1585;&#1608;&#1607; {{$category->name}} </h6>--}}
                    <div class="o-headline border-title">
                    <span>
                      جدیدترین ها
                    </span>

                    </div>
                    <div class="owl-carousel"
                         data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;margin&quot;: 10, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:5}} }">

                        @foreach($new_products->take(20) as $key => $pro)
                            <?php
                            $product = App\Product::find($pro->product_id);
                            ?>
                            @if($product)

                                <div class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover"
                                     style="width: 100%; overflow: hidden;height: auto">
                                    @if($pro->discount_price!=null or $pro->discount_price!=0 and $pro->discount_price<$pro->price)
                                        <img class="offer" src="{{asset('source/assets/offer1.png')}}"
                                             style="width: 60px!important;">
                                        <span class="offer_span">%{{round(((intval($pro->price)-intval($pro->discount_price))/intval($pro->price))*100,1)}}</span>
                                    @endif
                                    <a href="{{route('product-info',$product->slug)}}" uk-tooltip="دیدن همه مدل ها">
                                        <div class="img_div"><img
                                                    src="{{$pro->pic!=null ? url('/'.$pro->pic):url('/'.$product->pic) }}"
                                                    alt="{{$pro->name}}" style="width: 100%;max-height: 290px"></div>
                                        <div class="px-2 py-2">
                                            <p class="">
                                                {{$pro->name}}
                                            </p>
                                            @if($pro->count>0)
                                                <p class="" style="margin-bottom: 50px">
                                                    @if($pro->discount_price!=null)
                                                        <del class="numberPrice"
                                                             style="margin-left: 10px">{{$pro->price}}</del>
                                                        <span class="numberPrice">{{$pro->discount_price}}</span>
                                                        <span> تومان </span>
                                                    @else
                                                        <span class="numberPrice">{{$pro->price}}</span>
                                                        <span> تومان </span>
                                                    @endif
                                                </p>
                                            @else
                                                <p style="padding-bottom: 51px"></p>
                                            @endif

                                        </div>
                                    </a>
                                    @if($pro->count>0)
                                        <a href="{{route('add-to-basket-model',$pro->id)}}"
                                           class="text-uppercase text-center styled-link"
                                           style="font-size: 12px!important;">
                                            <i uk-icon="cart" style="background: unset!important"></i>افزودن به سبد خرید
                                        </a>
                                    @elseif($pro->count==0)
                                        <a
                                                class="text-uppercase text-center styled-link10"
                                                style="font-size: 12px!important;">
                                            <i uk-icon="ban" style="background: unset!important"></i>ناموجود
                                        </a>
                                    @elseif($pro->count<0)
                                        <a
                                                class="text-uppercase text-center styled-link10"
                                                style="font-size: 12px!important;">
                                            <i uk-icon="refresh" style="background: unset!important"></i>بزودی
                                        </a>
                                    @endif
                                    {{--<a href="{{route('add-to-compare',$pro->id)}}" title="افزودن به لیست مقایسه"--}}
                                    {{--class="text-uppercase text-center styled-link1">--}}
                                    {{--<i uk-icon="expand"--}}
                                    {{--style="background: unset!important;color: #00967f!important;"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="{{route('add-to-favorite',$pro->id)}}" title="افزودن به لیست علاقه مندی ها"--}}
                                    {{--class="text-uppercase text-center styled-link2">--}}
                                    {{--<i uk-icon="heart"--}}
                                    {{--style="background: unset!important;color: #00967f!important;"></i>--}}
                                    {{--</a>--}}


                                </div>



                            @endif

                            {{--<div class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover"--}}
                            {{--style="width: 100%; overflow: hidden; border-radius: 5px;height: auto">--}}
                            {{--@if($pro->price_vip!=null or $pro->price_vip!=0 and $pro->price_vip<$pro->price_user)--}}
                            {{--<img class="offer" src="{{asset('source/assets/offer1.png')}}"--}}
                            {{--style="width: 80px!important;">--}}
                            {{--<span class="offer_span">%{{round(((intval($pro->price_user)-intval($pro->price_vip))/intval($pro->price_user))*100,1)}}</span>--}}
                            {{--@endif--}}
                            {{--<a href="{{route('product-info',$pro->slug)}}">--}}
                            {{--<div class="img_div"><img--}}
                            {{--src="{{$pro->pic!=null ? url('/'.$pro->pic):asset('source/assets/logo.png') }}"--}}
                            {{--alt="{{$pro->title}}" style="width: 100%;max-height: 290px"></div>--}}
                            {{--<div class="px-2 py-2">--}}
                            {{--<p class="">--}}
                            {{--{{$pro->title}}--}}
                            {{--</p>--}}
                            {{--<p class="" style="margin-bottom: 50px">--}}
                            {{--@if($pro->price_vip!=null)--}}
                            {{--<del class="numberPrice"--}}
                            {{--style="margin-left: 10px">{{$pro->price_user}}</del>--}}
                            {{--<span class="numberPrice">{{$pro->price_vip}}</span>--}}
                            {{--<span> تومان </span>--}}
                            {{--@else--}}
                            {{--<span class="numberPrice">{{$pro->price_user}}</span>--}}
                            {{--<span> تومان </span>--}}
                            {{--@endif--}}
                            {{--</p>--}}

                            {{--</div>--}}
                            {{--</a>--}}
                            {{--<a href="{{route('product-info',$pro->slug)}}"--}}
                            {{--class="text-uppercase text-center styled-link">--}}
                            {{--<i uk-icon="cart" style="background: unset!important"></i>جزئیات--}}
                            {{--</a>--}}
                            {{--<a href="{{route('add-to-compare',$pro->id)}}" title="افزودن به لیست مقایسه"--}}
                            {{--class="text-uppercase text-center styled-link1">--}}
                            {{--<i uk-icon="expand"--}}
                            {{--style="background: unset!important;color: #00967f!important;"></i>--}}
                            {{--</a>--}}
                            {{--<a href="{{route('add-to-favorite',$pro->id)}}" title="افزودن به لیست علاقه مندی ها"--}}
                            {{--class="text-uppercase text-center styled-link2">--}}
                            {{--<i uk-icon="heart"--}}
                            {{--style="background: unset!important;color: #00967f!important;"></i>--}}
                            {{--</a>--}}


                            {{--</div>--}}


                        @endforeach

                    </div>
                </section>
            @endif
            @if(count($visit_products)>0)
                <section class=" pr-2 pl-2 pt-2 pb-2 rounded-5 soft-shadow mb-2"
                         style="background:#fff">
                    {{--<h6 class="text-right border-title mb-3" style="font-family: iran-sans"> &#1604;&#1740;&#1587;&#1578; &#1605;&#1581;&#1589;&#1608;&#1604;&#1575;&#1578; &#1711;&#1585;&#1608;&#1607; {{$category->name}} </h6>--}}
                    <div class="o-headline border-title">
                    <span>
                      پربازدیدترین ها
                    </span>

                    </div>
                    <div class="owl-carousel"
                         data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;margin&quot;: 10, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:5}} }">

                        @foreach($visit_products->take(20) as $key => $pro)
                            <?php
                            $product = App\Product::find($pro->product_id);
                            ?>

                            @if($product)

                                <div class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover"
                                     style="width: 100%; overflow: hidden;height: auto">
                                    @if($pro->discount_price!=null or $pro->discount_price!=0 and $pro->discount_price<$pro->price)
                                        <img class="offer" src="{{asset('source/assets/offer1.png')}}"
                                             style="width: 60px!important;">
                                        <span class="offer_span">%{{round(((intval($pro->price)-intval($pro->discount_price))/intval($pro->price))*100,1)}}</span>
                                    @endif
                                    <a href="{{route('product-info',$product->slug)}}" uk-tooltip="دیدن همه مدل ها">
                                        <div class="img_div"><img
                                                    src="{{$pro->pic!=null ? url('/'.$pro->pic):url('/'.$product->pic) }}"
                                                    alt="{{$pro->name}}" style="width: 100%;max-height: 290px"></div>
                                        <div class="px-2 py-2">
                                            <p class="">
                                                {{$pro->name}}
                                            </p>
                                            @if($pro->count>0)
                                                <p class="" style="margin-bottom: 50px">
                                                    @if($pro->discount_price!=null)
                                                        <del class="numberPrice"
                                                             style="margin-left: 10px">{{$pro->price}}</del>
                                                        <span class="numberPrice">{{$pro->discount_price}}</span>
                                                        <span> تومان </span>
                                                    @else
                                                        <span class="numberPrice">{{$pro->price}}</span>
                                                        <span> تومان </span>
                                                    @endif
                                                </p>
                                            @else
                                                <p style="padding-bottom: 51px"></p>
                                            @endif

                                        </div>
                                    </a>
                                    @if($pro->count>0)
                                        <a href="{{route('add-to-basket-model',$pro->id)}}"
                                           class="text-uppercase text-center styled-link"
                                           style="font-size: 12px!important;">
                                            <i uk-icon="cart" style="background: unset!important"></i>افزودن به سبد خرید
                                        </a>
                                    @elseif($pro->count==0)
                                        <a
                                                class="text-uppercase text-center styled-link10"
                                                style="font-size: 12px!important;">
                                            <i uk-icon="ban" style="background: unset!important"></i>ناموجود
                                        </a>
                                    @elseif($pro->count<0)
                                        <a
                                                class="text-uppercase text-center styled-link10"
                                                style="font-size: 12px!important;">
                                            <i uk-icon="refresh" style="background: unset!important"></i>بزودی
                                        </a>
                                    @endif
                                    {{--<a href="{{route('add-to-compare',$pro->id)}}" title="افزودن به لیست مقایسه"--}}
                                    {{--class="text-uppercase text-center styled-link1">--}}
                                    {{--<i uk-icon="expand"--}}
                                    {{--style="background: unset!important;color: #00967f!important;"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="{{route('add-to-favorite',$pro->id)}}" title="افزودن به لیست علاقه مندی ها"--}}
                                    {{--class="text-uppercase text-center styled-link2">--}}
                                    {{--<i uk-icon="heart"--}}
                                    {{--style="background: unset!important;color: #00967f!important;"></i>--}}
                                    {{--</a>--}}


                                </div>


                            @endif
                        @endforeach

                    </div>
                </section>
            @endif
            @if(count($basket_products)>0)
                <section class=" pr-2 pl-2 pt-2 pb-2 rounded-5 soft-shadow mb-2"
                         style="background:#fff">
                    {{--<h6 class="text-right border-title mb-3" style="font-family: iran-sans"> &#1604;&#1740;&#1587;&#1578; &#1605;&#1581;&#1589;&#1608;&#1604;&#1575;&#1578; &#1711;&#1585;&#1608;&#1607; {{$category->name}} </h6>--}}
                    <div class="o-headline border-title">
                    <span>
                      پرفروش ترین ها
                    </span>

                    </div>
                    <div class="owl-carousel"
                         data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;margin&quot;: 10, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:5}} }">

                        @foreach($basket_products->take(20) as $key => $pro)
                            <?php
                            $product = App\Product::find($pro->product_id);
                            ?>
                            @if($product)

                                <div class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover"
                                     style="width: 100%; overflow: hidden;height: auto">
                                    @if($pro->discount_price!=null or $pro->discount_price!=0 and $pro->discount_price<$pro->price)
                                        <img class="offer" src="{{asset('source/assets/offer1.png')}}"
                                             style="width: 60px!important;">
                                        <span class="offer_span">%{{round(((intval($pro->price)-intval($pro->discount_price))/intval($pro->price))*100,1)}}</span>
                                    @endif
                                    <a href="{{route('product-info',$product->slug)}}" uk-tooltip="دیدن همه مدل ها">
                                        <div class="img_div"><img
                                                    src="{{$pro->pic!=null ? url('/'.$pro->pic):url('/'.$product->pic) }}"
                                                    alt="{{$pro->name}}" style="width: 100%;max-height: 290px"></div>
                                        <div class="px-2 py-2">
                                            <p class="">
                                                {{$pro->name}}
                                            </p>
                                            @if($pro->count>0)
                                                <p class="" style="margin-bottom: 50px">
                                                    @if($pro->discount_price!=null)
                                                        <del class="numberPrice"
                                                             style="margin-left: 10px">{{$pro->price}}</del>
                                                        <span class="numberPrice">{{$pro->discount_price}}</span>
                                                        <span> تومان </span>
                                                    @else
                                                        <span class="numberPrice">{{$pro->price}}</span>
                                                        <span> تومان </span>
                                                    @endif
                                                </p>
                                            @else
                                                <p style="padding-bottom: 51px"></p>
                                            @endif

                                        </div>
                                    </a>
                                    @if($pro->count>0)
                                        <a href="{{route('add-to-basket-model',$pro->id)}}"
                                           class="text-uppercase text-center styled-link"
                                           style="font-size: 12px!important;">
                                            <i uk-icon="cart" style="background: unset!important"></i>افزودن به سبد خرید
                                        </a>
                                    @elseif($pro->count==0)
                                        <a
                                                class="text-uppercase text-center styled-link10"
                                                style="font-size: 12px!important;">
                                            <i uk-icon="ban" style="background: unset!important"></i>ناموجود
                                        </a>
                                    @elseif($pro->count<0)
                                        <a
                                                class="text-uppercase text-center styled-link10"
                                                style="font-size: 12px!important;">
                                            <i uk-icon="refresh" style="background: unset!important"></i>بزودی
                                        </a>
                                    @endif
                                    {{--<a href="{{route('add-to-compare',$pro->id)}}" title="افزودن به لیست مقایسه"--}}
                                    {{--class="text-uppercase text-center styled-link1">--}}
                                    {{--<i uk-icon="expand"--}}
                                    {{--style="background: unset!important;color: #00967f!important;"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="{{route('add-to-favorite',$pro->id)}}" title="افزودن به لیست علاقه مندی ها"--}}
                                    {{--class="text-uppercase text-center styled-link2">--}}
                                    {{--<i uk-icon="heart"--}}
                                    {{--style="background: unset!important;color: #00967f!important;"></i>--}}
                                    {{--</a>--}}


                                </div>

                            @endif
                        @endforeach

                    </div>
                </section>
            @endif


        </div>


    </div>
    <style>
        .pp_p > * {
            font-size: 11px !important;
            line-height: 20px;
            text-align: justify;
        }
    </style>
    <div class="uk-grid pt-2" style="margin-top: 10px!important;padding-right: 10px">
        <div class="uk-width-1-2@s" style="padding-left: 10px!important;">
            <div class="widget widget-featured-products widget-border" style="box-shadow: 0px 0px 7px rgba(0,0,0,.2)">
                <h3 class="widget-title"> مقالات</h3>

            @foreach($article as $key => $value)
                <!-- Entry-->
                    @if($key<4)
                        <div class="entry">
                            <div class="entry-thumb">
                                <a href="{{route('article' , $value->id)}}">
                                    <img src="{{url($value->photo->path)}}"
                                         alt="Product">
                                </a>

                            </div>
                            <div class="entry-content"><a
                                        href="{{route('article' , $value->id)}}">
                                    <h4 class="entry-title">{{$value->title}}
                                    </h4>
                                    <div class="pp_p">{!! str_limit($value->text,250) !!}</div>
                                    {{--<span class="entry-meta">{{my_jdate($value->created_at , 'Y-m-D H:i')}}</span>--}}
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
                <p style="text-align: left">
                    <a href="{{route('articles')}}">ادامه مطلب...</a>
                </p>

            </div>
        </div>
        <div class="uk-width-1-2@s" style="padding-left: 10px!important;">
            <div class="widget widget-featured-products widget-border" style="box-shadow: 0px 0px 7px rgba(0,0,0,.2)">
                <h3 class="widget-title"> اخبار</h3>

            @foreach($news as $key => $value)
                @if($key<=5)
                    <!-- Entry-->
                        <div class="entry">
                            <div class="entry-thumb">
                                <a href="{{route('news' , $value->id)}}">
                                    <img src="{{url($value->photo->path)}}"
                                         alt="Product">
                                </a>

                            </div>
                            <div class="entry-content">
                                <div class="entry-title"><a
                                            href="{{route('news' , $value->id)}}">
                                        <h4 class="entry-title">{{$value->title}}
                                        </h4>
                                        <div class="pp_p">{!! str_limit($value->text,250) !!}</div>
                                        {{--<span class="entry-meta">{{my_jdate($value->created_at , 'Y-m-D H:i')}}</span>--}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <p style="text-align: left">
                    <a href="{{route('news_all')}}">ادامه مطلب...</a>
                </p>
            </div>
        </div>
    </div>
    <aside class="uk-grid pt-2 padding-bottom-8x" style="margin-top: 10px!important;padding-right: 10px">

        <?$x = 1?>
        @foreach($banner as $item)

            <div class="uk-width-1-4@m uk-width-1-2@s ads" style="padding: 0 5px;margin-top: 10px">
                <a href="{{$item->link}}" class="c-adplacement__item" data-id="8720" target="_blank"
                   title="&#1605;&#1602;&#1575;&#1604;&#1575;&#1578;">
                    <img class="w-100" src="{{$item->photo->path}}"
                         alt="&#1587;&#1585;&#1605;&#1575;&#1740;&#1588;&#1740;">
                </a>
            </div>

            <?$x++?>
        @endforeach
        {{--@if(isset($banner[2]))--}}
        {{--<div class="uk-width-1-4@m uk-width-1-2@s ads" style="padding: 0 5px">--}}
        {{--<a href="{{$banner[2]->link}}" class="c-adplacement__item" data-id="8720" target="_blank"--}}
        {{--title="&#1605;&#1602;&#1575;&#1604;&#1575;&#1578;">--}}
        {{--<img class="w-100" src="{{$banner[2]->photo->path}}"--}}
        {{--alt="&#1587;&#1585;&#1605;&#1575;&#1740;&#1588;&#1740;">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--@endif--}}
        {{--@if(isset($banner[3]))--}}
        {{--<div class="uk-width-1-4@m uk-width-1-2@s ads" style="padding: 0 5px">--}}
        {{--<a href="{{$banner[3]->link}}" class="c-adplacement__item" data-id="8720" target="_blank"--}}
        {{--title="&#1605;&#1602;&#1575;&#1604;&#1575;&#1578;">--}}
        {{--<img class="w-100" src="{{$banner[3]->photo->path}}"--}}
        {{--alt="&#1587;&#1585;&#1605;&#1575;&#1740;&#1588;&#1740;">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--@endif--}}
        {{--@if(isset($banner[4]))--}}
        {{--<div class="uk-width-1-4@m uk-width-1-2@s ads" style="padding: 0 5px">--}}
        {{--<a href="{{$banner[4]->link}}" class="c-adplacement__item" data-id="8720" target="_blank"--}}
        {{--title="&#1605;&#1602;&#1575;&#1604;&#1575;&#1578;">--}}
        {{--<img class="w-100" src="{{$banner[4]->photo->path}}"--}}
        {{--alt="&#1587;&#1585;&#1605;&#1575;&#1740;&#1588;&#1740;">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--@endif--}}
        {{--@if(isset($banner[5]))--}}
        {{--<div class="uk-width-1-4@m uk-width-1-2@s ads" style="padding: 0 5px">--}}
        {{--<a href="{{$banner[5]->link}}" class="c-adplacement__item" data-id="8720" target="_blank"--}}
        {{--title="&#1605;&#1602;&#1575;&#1604;&#1575;&#1578;">--}}
        {{--<img class="w-100" src="{{$banner[5]->photo->path}}"--}}
        {{--alt="&#1587;&#1585;&#1605;&#1575;&#1740;&#1588;&#1740;">--}}
        {{--</a>--}}
        {{--</div>--}}

        {{--@endif--}}
    </aside>

    </section><!-- container -->

    {{--<!-- Popular Brands-->--}}
    {{--<section class="bg-faded padding-top-2x padding-bottom-8x"--}}
    {{--style="background:url('{{asset('source/assets/shop/img/brand-pattern.jpg')}}');border:solid 1px #e1e7ec">--}}
    {{--<div class="container">--}}
    {{--<h5 class="text-center mb-30 pb-2">&#1576;&#1585;&#1606;&#1583; &#1607;&#1575; &#1608; &#1607;&#1605;&#1705;&#1575;&#1585;&#1575;&#1606;--}}
    {{--&#1605;&#1575;</h5>--}}
    {{--<div class="owl-carousel"--}}
    {{--data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:6}} }">--}}
    {{--@foreach($brand as $value)--}}
    {{--<img src="{{$value->photo ? $value->photo->path : ""}}"--}}
    {{--title="{{$value->title}}" alt="Adidas">--}}
    {{--@endforeach--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
    {{--<!-- Services-->--}}



    @if(count($sliders) == 0 && count($products) ==0)
        <div class="mk-nodata">
            <h1 class="h2-header">&#1583;&#1575;&#1583;&#1607; &#1575;&#1740; &#1740;&#1575;&#1601;&#1578; &#1606;&#1588;&#1583;
                )-:</h1>
        </div>
    @else
        @if(count($sliders)>0)
            <section class="mainslider  hidden-sm hidden-xs" style="margin-top: -180px">
                <div class="owl-carousel owl-theme fullwidth">

                    @foreach($sliders as $slider)
                        <div class="item">
                            <div class="cover" style="background: url('{{url($slider->photo->path)}}') 50% 100%;">
                                <span class="gif">{{$slider->title}}</span>
                                <a href="{{$slider->link}}"></a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>
            <section class="mainslider  hidden-md hidden-lg hidden-xs" style="margin-top: -200px">
                <div class="owl-carousel owl-theme fullwidth">

                    @foreach($sliders as $slider)
                        <div class="item">
                            <div class="cover" style="background: url('{{url($slider->photo->path)}}') 50% 100%;">
                                <span class="gif">{{$slider->title}}</span>
                                <a href="{{$slider->link}}"></a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>
            <section class="mainslider  hidden-md hidden-lg hidden-sm" style="margin-top: -70px;margin-bottom: 30px">
                <div class="owl-carousel owl-theme fullwidth">

                    @foreach($sliders as $slider)
                        <div class="item">
                            <div class="cover" style="background: url('{{url($slider->photo->path)}}') 100% 70%;">
                                <span class="gif">{{$slider->title}}</span>
                                <a href="{{$slider->link}}"></a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>
        @endif



    @endif

@endsection
@section('script')
@endsection
