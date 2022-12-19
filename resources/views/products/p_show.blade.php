@extends('layouts.front')
@section('css')
    <style>
        .title_h3 {
            color: #030877;
            padding-bottom: 15px;
        }

        @media (min-width: 700px) {
            .stl {
                width: 70%;
                float: right;
                text-align: right;
                padding: 2px 15px;
            }

            .pic {
                width: 30%;
                float: left;
                padding: 2px 5px;
            }
        }


        @media (max-width: 700px) {
            .stl {
                width: 100%;
                float: right;
                text-align: right;
                padding: 2px 15px;
                font-size: 12px !important;
            }

            .pic {
                width: 100%;
                float: left;
                padding: 2px 5px;
                margin-bottom: 10px;
            }
        }

        .pic > img {
            width: 70%;
            border-radius: 5px;
        }

        .stl > p, h1, h2, h3, h4, h5, h6, span, strong {
            text-align: justify;
        }

        .h4_name {

            padding: 7px;

            background-color: gainsboro;
            color: blue;

        }

        .block1 {

            background-color: #eee;

            box-shadow: 0px 2px 9px #e6e6e6;

        }

        .c-category-card__list {

            padding-right: 14px;

        }

        .c-category-card__list li {

            list-style-type: none;

            text-align: right;

            padding: 6px;

            text-decoration: none;

        }

        .flot_l {
            float: left;
            margin-bottom: 38px;
        }

        .flot_l > span {
            font-size: 15px !important;
        }

        a {

            text-decoration: none;

        }

        .text_tabel {
            border-radius: 5px;
            width: 60px;
            text-align: center;
            text-align: center;
        }

        .co888 {
            color: #888;

        }

        .box_filter {
            /*border: 1px solid;*/
            border-radius: 3px;
            padding: 0px;
            box-shadow: 0px 0px 1px 1px silver;
            /*max-height: 150px;*/
            margin-bottom: -10px;
        }

        .box_filter ul {
            list-style: none;
            padding-top: 5px;
            max-height: 150px;
            overflow-y: auto;
        }

        .box_filter_titel {
            background-color: #11ddbf;
            border-radius: 5px 5px 0 0;
            text-align: center;
            padding: 5px;
        }

        .box_filter_contant {
            text-align: right;
        }

        .btn_add {
            padding: 5px;
            border-radius: 25px;
            background-color: #11dfbf;
        }

        .btn_add :hover {
            /*padding: 6px;*/
            border-radius: 20px;
            background-color: whitesmoke;

        }

        .filter_chek {
            margin-left: 7px;
        }

        .sst_l {
            background: rgb(240, 248, 255, 0.3);
            box-shadow: 0 0 3px 1px;
            padding: 10px 10px;
            margin-bottom: 25px;
            border-radius: 5px;
        }

    </style>
    <style>
        .price-range-slider .ui-range-slider-footer {
            padding-top: 10px;
        }

        .alls {
            padding: 10px;
        }

        .pic_p {
            background: #fff;
            box-shadow: 0 0 1px 1px silver;
            border-radius: 3px !important;
            padding: 5px 5px;
        }

        .pic_p > img {
            width: 100%;
        }

        .page-title {
            margin-bottom: 6px !important;
        }

        .all {
            width: 100%;
        }

        .all > .name_p {
            border-radius: 3px !important;
            padding: 15px 10px;
            box-shadow: 0 0 1px 1px silver;
        }

        .all > .name_p > h5 {;
            text-align: right;
        }

        .all > .name_p > span {
            text-align: left;
        }

        .dis_p {
            border-radius: 3px !important;
            padding: 15px 10px;
            box-shadow: 0 0 1px 1px silver;
            margin-top: 5px;
            text-align: right;
            padding-bottom: 45px;
        }

        .dis_p > p {
            text-align: justify;
        }

        .dis_p > button {
            float: left;
        }
    </style>

    <!-- product slider -->

    <style>

        .slick-slider .slick-prev, .slick-slider .slick-next {
            z-index: 100;
            font-size: 2.5em;
            height: 40px;
            width: 40px;
            margin-top: -20px;
            color: #B7B7B7;
            position: absolute;
            top: 50%;
            text-align: center;
            color: #000;
            opacity: .3;
            transition: opacity .25s;
            cursor: pointer;
            background: #FFFFFF;
        }

        .slick-slider .slick-prev:hover, .slick-slider .slick-next:hover {
            opacity: .65;
        }

        .slick-slider .slick-prev {
            left: 0;
        }

        .slick-slider .slick-next {
            right: 0;
        }

        #detail .product-images {
            width: 100%;
            margin: 0 auto;
            border: 1px solid #eee;
        }

        #detail .product-images li, #detail .product-images figure, #detail .product-images a, #detail .product-images img {
            display: block;
            outline: none;
            border: none;
        }

        #detail .product-images .main-img-slider figure {
            margin: 0 auto;
            padding: 0 2em;
        }

        #detail .product-images .main-img-slider figure a {
            cursor: pointer;
            cursor: -webkit-zoom-in;
            cursor: -moz-zoom-in;
            cursor: zoom-in;
        }

        #detail .product-images .main-img-slider figure a img {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        #detail .product-images .thumb-nav {
            margin: 0 auto;
            padding: 20px 10px;
            max-width: 600px;
        }

        #detail .product-images .thumb-nav.slick-slider .slick-prev, #detail .product-images .thumb-nav.slick-slider .slick-next {
            font-size: 1.2em;
            height: 20px;
            width: 26px;
            margin-top: -10px;
        }

        #detail .product-images .thumb-nav.slick-slider .slick-prev {
            margin-left: -30px;
        }

        #detail .product-images .thumb-nav.slick-slider .slick-next {
            margin-right: -30px;
        }

        #detail .product-images .thumb-nav li {
            display: block;
            margin: 0 auto;
            cursor: pointer;
        }

        #detail .product-images .thumb-nav li img {
            display: block;
            width: 100%;
            max-width: 75px;
            margin: 0 auto;
            border: 2px solid transparent;
            -webkit-transition: border-color .25s;
            -ms-transition: border-color .25s;
            -moz-transition: border-color .25s;
            transition: border-color .25s;
        }

        #detail .product-images .thumb-nav li:hover, #detail .product-images .thumb-nav li:focus {
            border-color: #999;
        }

        #detail .product-images .thumb-nav li.slick-current img {
            border-color: #d12f81;
        }

        .main_img {
            width: 500px;
            margin: 0 auto
        }
    </style>

@endsection
@section('content')
    <style>
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: white !important;
            background-color: #11ddbf !important;
        }
    </style>
    <section class="new-section">
        <div class="page-title">
            <div class="container-fluid">
                <div class="column">
                    <h1></h1>
                </div>
                <div class="column">
                    <ul class="breadcrumbs">
                        <li><a href="{{route('home')}}">خانه</a>
                        </li>
                        @if($category->parent_id!=null)
                            <?php
                            $cat1 = App\Category::find($category->parent_id);
                            if ($cat1) {
                                $cat2 = App\Category::find($cat1->parent_id);
                            }
                            ?>
                            @if($cat1)
                                @if($cat2)
                                    <li class="separator">&nbsp;</li>
                                    <li><a href="{{route('products',$cat2->slug)}}">{{$cat2->name}}</a></li>
                                @endif
                                <li class="separator">&nbsp;</li>
                                <li><a href="{{route('products',$cat1->slug)}}">{{$cat1->name}}</a></li>
                            @endif
                        @endif
                        <li class="separator">&nbsp;</li>
                        <li><a href="{{route('products',$category->slug)}}">{{$category->name}}</a></li>
                        <li class="separator">&nbsp;</li>
                        <li>{{$product->title}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="alls" uk-grid>
            <div class="uk-width-1-3@l uk-width-3-4@m uk-width-2-3@s">
                <div class="pic_p">
                    {{--                    <img src="{{url($product->pic)}}">--}}
                    <div class="main_img">

                        <div class="product-images demo-gallery">

                            <div class="main-img-slider">
                                <a data-fancybox="gallery" href="{{url($product->pic)}}"><img
                                            src="{{url($product->pic)}}" class="img-fluid"></a>


                                @if($product->photo && $product->photo->count() > 0)
                                    @foreach($product->photo as $photo)
                                        <a data-fancybox="gallery" href="{{url($photo->path)}}"><img height="100" width="100" style="object-fit: cover"
                                                    src="{{url($photo->path)}}"
                                                    class="img-fluid"></a>
                                    @endforeach
                                @endif

                            </div>

                            {{-- <ul class="thumb-nav">
                                <li><img src="{{url($product->pic)}}"></li>
                                <li><img src="img/72x50/photo-1474524955719-b9f87c50ce47.jpg"></li>
                                <li><img src="img/72x50/photo-1465146344425-f00d5f5c8f07.jpg"></li>
                                <li><img src="img/72x50/photo-1453785675141-67637e2d4b5c.jpg"></li>
                                <li><img src="img/72x50/photo-1437422061949-f6efbde0a471.jpg"></li>
                                <li><img src="img/72x50/photo-1418065460487-3e41a6c84dc5.jpg"></li>
                            </ul> --}}

                        </div>

                    </div>


                </div>
                @if(count($model)>0)
                    <div class="filter">
                        <form method="get" action="{{route('filter-product',$product->id)}}">
                            @if(isset($filter))
                                @if(count($filter))
                                    @if(isset($all))
                                        @foreach($filter as $value)
                                            @php
                                                $data = [];
                                            @endphp
                                            @if($value[0])
                                                <div class="" style="padding-top: 5px">
                                                    <div class="box_filter">
                                                        <div class="box_filter_titel">{{$value[0]->attribute->name}}</div>
                                                        <div class="box_filter_contant">

                                                            <ul>
                                                                <!--                                    --><?//$val_attrs = App\AttributeProductJoin::where('attribute_id', $attr->id)->get();
                                                                //                                    $data=array();
                                                                //                                        foreach($val_attrs as  $val_attr)
                                                                //                                            {
                                                                //                                                array_push($data,$val_attr->value);
                                                                //                                            }
                                                                //                                            $data=array_unique($data);
                                                                //
                                                                //                                    ?>
                                                                @foreach($value as $val)
                                                                    @if(!in_array($val->value ,  $data))
                                                                        <li>
                                                                            <input type="checkbox"
                                                                                   onclick="this.form.submit()"
                                                                                   @if(in_array($val->value , $all)) checked
                                                                                   @endif name="{{$val->attribute->id}}[]"
                                                                                   value="{{$val->value}}"
                                                                                   class="uk-checkbox filter_chek">{{$val->value}}
                                                                        </li>
                                                                        @php    array_push($data , $val->value)  @endphp
                                                                    @endif
                                                                @endforeach

                                                            </ul>

                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach($filter as $value)
                                            @php
                                                $data = [];
                                            @endphp
                                            @if($value[0])
                                                <div class="" style="padding-top: 5px">
                                                    <div class="box_filter">
                                                        <div class="box_filter_titel">{{$value[0]->attribute->name}}</div>
                                                        <div class="box_filter_contant">

                                                            <ul>

                                                                @foreach($value as $val)
                                                                    @if(!in_array($val->value ,  $data))
                                                                        <li>
                                                                            <input type="checkbox"
                                                                                   onclick="this.form.submit()"
                                                                                   name="{{$val->attribute->id}}[]"
                                                                                   value="{{$val->value}}"
                                                                                   class="uk-checkbox filter_chek">{{$val->value}}
                                                                        </li>
                                                                        @php    array_push($data , $val->value)  @endphp
                                                                    @endif
                                                                @endforeach

                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    @endif
                                @endif
                            @endif

                        </form>
                    </div>
                    @if($price1!=$price2)
                        <div class=" box_filter">
                            <div class="box_filter_titel">فیلتر قیمت</div>
                            <div class="box_filter_contant">
                                <form class="price-range-slider" method="get"
                                      action="{{route('sss' , $product->slug)}}"
                                      data-start-min="{{$price2}}"
                                      data-start-max="{{$price1}}" data-min="{{$price2}}" data-max="{{$price1}}"
                                      data-step="1" style="padding-left: 15px!important;padding-right: 15px">
                                    <div class="ui-range-slider"></div>
                                    <footer class="ui-range-slider-footer row">
                                        <div class="col-md-12" style="padding-bottom: 5px!important;">
                                            <div class="ui-range-values">
                                                <div class="ui-range-value-min"> از <span class="numberPrice"></span>
                                                    <input type="hidden" name="min_price">
                                                </div>&nbsp; تا &nbsp;
                                                <div class="ui-range-value-max"><span class="numberPrice"></span>
                                                    <input type="hidden" name="max_peice">تومان
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12 text-left" style="padding-bottom: 5px">
                                            <button class="btn btn-outline-primary btn-sm " type="submit"
                                                    style="    margin-left: -35px;box-shadow: 1px 1px 5px #a8a8d8;border: none">
                                                فیلتر
                                            </button>
                                        </div>
                                    </footer>
                                </form>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="uk-width-1-3@l uk-width-3-4@m uk-width-2-3@s">
                <div class="all">
                    <div class="name_p">
                        <div uk-grid>
                            <div class="uk-width-2-3@s">
                                <h5 style="text-align: right;">{{$product->title}}</h5>
                            </div>
                            <div class="uk-width-1-3@s">
                                <span style="text-align: right;">@if(count($model)>0)
                                        {{count($model)}} مدل وجود دارد
                                    @else
                                        مدلی تعریف نشده
                                    @endif</span>
                            </div>
                        </div>
                    </div>
                    <div class="dis_p text-right pt-3">
                        {!! $product->text   !!}
                        {{-- <div id="limit" style="text-align: right;">
                            {!! str_limit($product->text , 100)  !!}
                        </div>
                        <div id="limit" hidden>
                            {!! $product->text   !!}
                        </div>
                        <button class="uk-button uk-button-default" type="button" uk-toggle="target: #limit"><span
                                    id="limit">بیشتر</span><span id="limit" hidden>بستن</span></button> --}}
                    </div>
                    <div class="list_model">
                        <div class="uk-grid" uk-grid>
                            <div class="uk-alert uk-alert-success"
                                 style="position: fixed;bottom: 10px;left: 10px; font-size: 15px !important; font-family: iransans !important; display: none;z-index: 99999999"
                                 id="show_p"></div>
                            <div class="uk-alert uk-alert-danger"
                                 style="position: fixed;bottom: 10px;left: 10px; font-size: 15px !important; font-family: iransans !important; display: none;z-index: 99999999"
                                 id="show_d"></div>
                            @if(count($model)>0)
                                @foreach($model as $key => $pro)
                                    {{--@php--}}

                                    {{--$attribute1=App\AttributeProductJoin::where('model_id',$pro->id)->get();--}}
                                    {{--if(!session('basket_user'))--}}
                                    {{--{--}}
                                    {{--$counter=0;--}}
                                    {{--}--}}
                                    {{--else--}}
                                    {{--{--}}
                                    {{--$bask=App\Basket::where('user_id',session('basket_user'))->where('status',0)->where('model_id',$pro->id)->first();--}}
                                    {{--if($bask!=null)--}}
                                    {{--{--}}
                                    {{--$counter=$bask->num;--}}
                                    {{--}else--}}
                                    {{--{--}}
                                    {{--$counter=0;--}}
                                    {{--}--}}
                                    {{--}--}}



                                    {{--@endphp--}}

                                    <div class="uk-width-1-4@l uk-width-1-3@m uk-width-1-2@s">
                                        <div class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover"
                                             style="width: 100%; overflow: hidden;height: auto">
                                            @if($pro->discount_price!=null or $pro->discount_price!=0 and $pro->discount_price<$pro->price)
                                                <img class="offer" src="{{asset('source/assets/offer1.png')}}"
                                                     style="width: 60px!important;">
                                                <span class="offer_span">%{{round(((intval($pro->price)-intval($pro->discount_price))/intval($pro->price))*100,1)}}</span>
                                            @endif
                                            <a href="#info{{$pro->id}}" uk-toggle>
                                                <div class="img_div"><img
                                                            src="{{$pro->pic!=null ? url('/'.$pro->pic):url('/'.$product->pic) }}"
                                                            alt="{{$pro->name}}" style="width: 100%;max-height: 290px">
                                                </div>
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
                                                    <i uk-icon="cart" style="background: unset!important"></i>افزودن به
                                                    سبد خرید
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
                                    </div>
                                    <style>
                                        .uk-modal-dialog {
                                            background: rgba(255, 255, 255, 0.5) !important;
                                            text-align: right;
                                        }

                                        .info_mm {
                                            background: white !important;
                                            border-radius: 3px !important;
                                            box-shadow: 0 0 2px 2px #6d6d6d !important;
                                            padding: 10px 10px;
                                            padding-bottom: 70px;
                                        }

                                        .info_mm > div {
                                            padding-bottom: 10px;
                                            border-bottom: 1px solid #d6d6d6;
                                        }

                                        .dis {
                                            text-align: right;
                                            height: 175px;
                                            overflow-y: auto;
                                            border-bottom: 1px solid #d6d6d6;
                                        }

                                        .dis > p {
                                            text-align: justify;
                                        }

                                        .compar {
                                            text-decoration: none !important;
                                            color: #000 !important;
                                        }

                                        .fav {
                                            text-decoration: none !important;
                                            color: #000 !important;
                                            margin-right: 10px;
                                        }
                                    </style>
                                    <div id="info{{$pro->id}}" class="uk-modal-container" uk-modal
                                         style="z-index: 99999">
                                        <div class="uk-modal-dialog uk-modal-body">
                                            <button class="uk-modal-close-outside"
                                                    style="background: red!important;color: white!important;"
                                                    type="button" uk-close></button>
                                            <div class="uk-grid">
                                                <div class="uk-width-1-3@m uk-width-1-2@s">
                                                    <img
                                                            src="{{$pro->pic!=null ? url('/'.$pro->pic):url('/'.$product->pic) }}"
                                                            alt="{{$pro->name}}"
                                                            style="width: 100%;border-radius: 2px;box-shadow: 0 0 2px 2px #6d6d6d">
                                                </div>
                                                <div class="uk-width-2-3@m uk-width-1-2@s info_mm">
                                                    <div uk-grid>
                                                        <div class="uk-width-1-2@s">
                                                            <h5>{{$pro->name}}</h5>
                                                        </div>
                                                        <div class="uk-width-1-2@s">
                                                            <?php
                                                            $rates1 = App\Prate::where('product_id', $pro->id)->get();

                                                            $sum1 = 0;

                                                            $count1 = count($rates1);

                                                            foreach ($rates1 as $rate1) {

                                                                $sum1 += $rate1->rate;

                                                            }


                                                            if ($count1 != 0) {

                                                                $rate1 = ($sum1) / ($count1);

                                                            } else {

                                                                $rate1 = 0;

                                                            }
                                                            ?>
                                                            <span style="float: left;margin-top: 15px!important;"
                                                                  class="text-muted align-middle">&nbsp;&nbsp;<span
                                                                        style="margin-top: 5px;margin-right: 10px;color:#761c19;font-family: IRANsans;font-size: 11px!important;">امتیاز : {{ round($rate1,1) . " ( ". $count1 ." رای ) " }}</span>
                        </span>
                                                            <div style="float: left;margin-top: 15px!important;"
                                                                 class="rating-stars">
                                                                <i class="icon-star @if(round($rate1,1)>=4.5) filled @endif "
                                                                   id="rates_5{{$key}}" data-id="{{$pro->id}}"></i>
                                                                <i class="icon-star @if(round($rate1,1)>=3.5) filled @elseif(round($rate1,1)<4.6) @endif"
                                                                   id="rates_4{{$key}}" data-id="{{$pro->id}}"></i>
                                                                <i class="icon-star @if(round($rate1,1)>=2.5) filled @elseif(round($rate1,1)<3.6) @endif"
                                                                   id="rates_3{{$key}}" data-id="{{$pro->id}}"></i>
                                                                <i class="icon-star @if(round($rate1,1)>=1.5) filled @elseif(round($rate1,1)<2.6) @endif"
                                                                   id="rates_2{{$key}}" data-id="{{$pro->id}}"></i>
                                                                <i class="icon-star @if(round($rate1,1)>0)filled @elseif(round($rate1,1)<1.6)  @endif"
                                                                   id="rates_1{{$key}}" data-id="{{$pro->id}}"></i>
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="dis">
                                                        {!! $pro->text !!}
                                                    </div>
                                                    <div uk-grid>
                                                        <div class="uk-width-1-2@s">
                                                            @if($pro->count>0)
                                                                <p class="" style="font-size: 18px;margin-top: 10px">
                                                                    قیمت :
                                                                    @if($pro->discount_price!=null)
                                                                        <del class="numberPrice"
                                                                             style="margin-left: 10px;color: red;font-size: 16px!important;">{{$pro->price}}</del>
                                                                        <span class="numberPrice"
                                                                              style="font-size: 18px!important;">{{$pro->discount_price}}</span>
                                                                        <span style="font-size: 18px!important;"> تومان </span>
                                                                    @else
                                                                        <span class="numberPrice"
                                                                              style="font-size: 18px!important;">{{$pro->price}}</span>
                                                                        <span style="font-size: 18px!important;"> تومان </span>
                                                                    @endif

                                                                </p>
                                                            @else
                                                                <p style="padding-bottom: 25px"></p>
                                                            @endif
                                                        </div>
                                                        <div class="uk-width-1-2@s">
                                                            <a href="{{route('add-to-compare',$pro->id)}}"
                                                               title="افزودن به لیست مقایسه"
                                                               class="text-uppercase compar">
                                                                <i uk-icon="expand"
                                                                   style="background: unset!important;color: #00967f!important;"></i>
                                                                افزودن به مقایسه
                                                            </a>
                                                            <a href="{{route('add-to-favorite',$pro->id)}}"
                                                               title="افزودن به لیست علاقه مندی ها"
                                                               class="text-uppercase fav">
                                                                <i uk-icon="heart"
                                                                   style="background: unset!important;color: #00967f!important;"></i>
                                                                افزودن به علاقه مندی
                                                            </a>
                                                            @if($pro->count>0)
                                                                <a href="{{route('add-to-basket-model',$pro->id)}}"
                                                                   class="text-uppercase text-center styled-link22"
                                                                   style="font-size: 12px!important;">
                                                                    <i uk-icon="cart"
                                                                       style="background: unset!important"></i>افزودن به
                                                                    سبد خرید
                                                                </a>
                                                            @elseif($pro->count==0)
                                                                <a
                                                                        class="text-uppercase text-center styled-link20"
                                                                        style="font-size: 12px!important;">
                                                                    <i uk-icon="ban"
                                                                       style="background: unset!important"></i>ناموجود
                                                                </a>
                                                            @elseif($pro->count<0)
                                                                <a
                                                                        class="text-uppercase text-center styled-link20"
                                                                        style="font-size: 12px!important;">
                                                                    <i uk-icon="refresh"
                                                                       style="background: unset!important"></i>بزودی
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">توضیحات تکمیلی</a>
                </li>
                @if ($product->comparjoin->count())
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">ویژگی های محصول</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">مقاله محصول</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">ویدیوی محصول</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content pb-3">
                <div id="home" class="container tab-pane active"><br>
                    {!! $product->description !!}
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <table class="table table-striped">
                        <tbody>
                            @foreach ($product->comparjoin as $item)
                                <tr>
                                    <th scope="row" class="text-right">{{$item->compare->name}}</th>
                                    <td class="text-right">{{$item->value}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                    <h6 class="mt-1 text-center">
                        @if ($product->article)
                            برای بارگیری مقاله
                            <a href="{{url($product->article)}}" download class="h6">اینجا کلیک</a>
                            کنید
                        @else
                            <h6 class="text-danger text-center">مقاله ای موجود نیست</h6>
                        @endif
                    </h6>
                </div>
                <div id="menu3" class="container tab-pane fade"><br>
                    @if ($product->video)
                        <h6 class="mt-1 mb-4 text-right">نمایش ویدیوی محصول</h6>
                        <video controls class="m-auto rounded">
                            <source src="{{url($product->video)}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video> 
                    @else
                        <h6 class="text-danger text-center">ویدیو ای موجود نیست</h6>
                    @endif
                </div>
            </div>
        </div>

    </section>
@endsection
@section('scripts')

    <script>
        @foreach($model as $key=>$p)
        $('#rates_5{{$key}}').each(function () {
            $(this).click(function () {

                var value_star = 5;
                var p_id = $(this).attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{route('product.like')}}",
                    method: "POST",
                    data: {
                        p_id: p_id,
                        value_star: value_star
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.success == true) {
                            $('#show_p').slideDown(200).html('رای شما با موفقیت ثبت شده');
                            var timer = setTimeout(function () {
                                $('#show_p').slideUp(200);
                            }, 3000);

                        } else if (data.success2 == true) {
                            $('#show_p').slideDown(200).html('رای شما با موفقیت ویرایش شد');
                            var timer = setTimeout(function () {
                                $('#show_p').slideUp(200);
                            }, 3000);

                        } else if (data.success1 == true) {
                            $('#show_d').slideDown(200).html('برای رای دادن به محصول باید وارد سایت شوید');
                            var timer = setTimeout(function () {
                                $('#show_d').slideUp(200);
                            }, 3000);

                        }
                    }

                });
            })
        })
        $('#rates_4{{$key}}').each(function () {
            $(this).click(function () {

                var value_star = 4;
                var p_id = $(this).attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{route('product.like')}}",
                    method: "POST",
                    data: {
                        p_id: p_id,
                        value_star: value_star
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.success == true) {
                            $('#show_p').slideDown(200).html('رای شما با موفقیت ثبت شده');
                            var timer = setTimeout(function () {
                                $('#show_p').slideUp(200);
                            }, 3000);

                        } else if (data.success2 == true) {
                            $('#show_p').slideDown(200).html('رای شما با موفقیت ویرایش شد');
                            var timer = setTimeout(function () {
                                $('#show_p').slideUp(200);
                            }, 3000);

                        } else if (data.success1 == true) {
                            $('#show_d').slideDown(200).html('برای رای دادن به محصول باید وارد سایت شوید');
                            var timer = setTimeout(function () {
                                $('#show_d').slideUp(200);
                            }, 3000);

                        }
                    }

                });
            })
        })
        $('#rates_3{{$key}}').each(function () {
            $(this).click(function () {

                var value_star = 3;
                var p_id = $(this).attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{route('product.like')}}",
                    method: "POST",
                    data: {
                        p_id: p_id,
                        value_star: value_star
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.success == true) {
                            $('#show_p').slideDown(200).html('رای شما با موفقیت ثبت شده');
                            var timer = setTimeout(function () {
                                $('#show_p').slideUp(200);
                            }, 3000);

                        } else if (data.success2 == true) {
                            $('#show_p').slideDown(200).html('رای شما با موفقیت ویرایش شد');
                            var timer = setTimeout(function () {
                                $('#show_p').slideUp(200);
                            }, 3000);

                        } else if (data.success1 == true) {
                            $('#show_d').slideDown(200).html('برای رای دادن به محصول باید وارد سایت شوید');
                            var timer = setTimeout(function () {
                                $('#show_d').slideUp(200);
                            }, 3000);

                        }
                    }

                });
            })
        })
        $('#rates_2{{$key}}').each(function () {
            $(this).click(function () {

                var value_star = 2;
                var p_id = $(this).attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{route('product.like')}}",
                    method: "POST",
                    data: {
                        p_id: p_id,
                        value_star: value_star
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.success == true) {
                            $('#show_p').slideDown(200).html('رای شما با موفقیت ثبت شده');
                            var timer = setTimeout(function () {
                                $('#show_p').slideUp(200);
                            }, 3000);

                        } else if (data.success2 == true) {
                            $('#show_p').slideDown(200).html('رای شما با موفقیت ویرایش شد');
                            var timer = setTimeout(function () {
                                $('#show_p').slideUp(200);
                            }, 3000);

                        } else if (data.success1 == true) {
                            $('#show_d').slideDown(200).html('برای رای دادن به محصول باید وارد سایت شوید');
                            var timer = setTimeout(function () {
                                $('#show_d').slideUp(200);
                            }, 3000);

                        }
                    }

                });
            })
        })
        $('#rates_1{{$key}}').each(function () {
            $(this).click(function () {

                var value_star = 1;
                var p_id = $(this).attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{route('product.like')}}",
                    method: "POST",
                    data: {
                        p_id: p_id,
                        value_star: value_star
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.success == true) {
                            $('#show_p').slideDown(200).html('رای شما با موفقیت ثبت شده');
                            var timer = setTimeout(function () {
                                $('#show_p').slideUp(200);
                            }, 3000);

                        } else if (data.success2 == true) {
                            $('#show_p').slideDown(200).html('رای شما با موفقیت ویرایش شد');
                            var timer = setTimeout(function () {
                                $('#show_p').slideUp(200);
                            }, 3000);

                        } else if (data.success1 == true) {
                            $('#show_d').slideDown(200).html('برای رای دادن به محصول باید وارد سایت شوید');
                            var timer = setTimeout(function () {
                                $('#show_d').slideUp(200);
                            }, 3000);

                        }
                    }

                });
            })
        })
        @endforeach





        // Main/Product image slider for product page
        $('#detail .main-img-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
            fade: true,
            autoplay: true,
            autoplaySpeed: 4000,
            speed: 300,
            lazyLoad: 'ondemand',
            asNavFor: '.thumb-nav',
            prevArrow: '<div class="slick-prev"><i class="i-prev"></i><span class="sr-only sr-only-focusable"><</span></div>',
            nextArrow: '<div class="slick-next"><i class="i-next"></i><span class="sr-only sr-only-focusable">></span></div>'
        });

        // Thumbnail/alternates slider for product page
        $('.thumb-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            centerPadding: '0px',
            asNavFor: '.main-img-slider',
            dots: false,
            centerMode: false,
            draggable: true,
            speed: 200,
            focusOnSelect: true,
            prevArrow: '<div class="slick-prev"><i class="i-prev"></i><span class="sr-only sr-only-focusable"><</span></div>',
            nextArrow: '<div class="slick-next"><i class="i-next"></i><span class="sr-only sr-only-focusable">></span></div>'
        });


        //keeps thumbnails active when changing main image, via mouse/touch drag/swipe
        $('.main-img-slider').on('afterChange', function (event, slick, currentSlide, nextSlide) {
            //remove all active class
            $('.thumb-nav .slick-slide').removeClass('slick-current');
            //set active class for current slide
            $('.thumb-nav .slick-slide:not(.slick-cloned)').eq(currentSlide).addClass('slick-current');
        });
        //# sourceURL=pen.js
    </script>

@endsection
