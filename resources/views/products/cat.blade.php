@extends('layouts.front')
@section('content')
    <style>
        .title_h3{
            color: #030877;
            padding-bottom: 15px;
        }
        .stl{
            width: 100%;
            text-align: right;
            padding: 2px 15px;
        }
        .stl>p,h1,h2,h3,h4,h5,h6,span,strong{
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



        a {

            text-decoration: none;

        }



        .sst_l{
            background: rgb(240,248,255,0.3);
            box-shadow: 0 0 3px 1px;
            padding: 10px 10px;
            margin-bottom: 25px;
            border-radius: 5px;
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
                            $cat1=App\Category::find($category->parent_id);
                            if($cat1)
                            {
                                $cat2=App\Category::find($cat1->parent_id);
                            }
                            ?>
                                @if($cat1)
                                    @if($cat2)
                                        <li class="separator">&nbsp;</li>
                                        <li> <a href="{{route('products',$cat2->slug)}}">{{$cat2->name}}</a></li>
                                    @endif
                                    <li class="separator">&nbsp;</li>
                                    <li> <a href="{{route('products',$cat1->slug)}}">{{$cat1->name}}</a></li>
                                @endif
                        @endif

                        <li class="separator">&nbsp;</li>
                        <li>{{$category->name}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sec-banner bg0 p-t-80 p-b-50" style="padding: 10px 20px">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12" style="text-align: right">
                        <h5 class="title_h3">{{$category->name}}</h5>
                        <div class="stl">
                            {!! $category->text !!}
                        </div>
                    </div>
                    <div class="uk-grid w-100" style="padding-left: unset!important;margin-left: unset!important;" uk-grid>
                        <div class="uk-width-1-1 uk-text-right" style="border-bottom: 1px solid #d6d6d6">
                            <p>بر اساس نوع</p>
                        </div>

                        @if(count($products)>0)

                            @foreach($products as $pro)

                                <div class="col-lg-3 col-sm-6 col-xs-12 "
                                     style="padding-left:5px!important;padding-right:5px!important;">
                                    <div class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover"
                                         style="width: 100%; overflow: hidden; border-radius: 5px;height: auto">
                                        {{--@if($pro->price_vip!=null or $pro->price_vip!=0 and $pro->price_vip<$pro->price_user)--}}
                                        {{--<img class="offer" src="{{asset('source/assets/offer1.png')}}"--}}
                                        {{--style="width: 80px!important;">--}}
                                        {{--<span class="offer_span">%{{round(((intval($pro->price_user)-intval($pro->price_vip))/intval($pro->price_user))*100,1)}}</span>--}}
                                        {{--@endif--}}
                                        <a href="{{route('product-info',$pro->slug)}}">
                                            <div class="img_div"><img src="{{$pro->pic!=null ? url('/'.$pro->pic):asset('source/assets/logo.png') }}" alt="{{$pro->title}}" style="width: 100%;max-height: 290px"></div>
                                            <div class="px-2 py-2">
                                                <p class="">
                                                    {{$pro->title}}
                                                </p>
                                                <p class="" style="margin-bottom: 50px">
                                                    {{--@if($pro->price_vip!=null)--}}
                                                    {{--<del class="numberPrice"--}}
                                                    {{--style="margin-left: 10px">{{$pro->price_user}}</del>--}}
                                                    {{--<span class="numberPrice">{{$pro->price_vip}}</span>--}}
                                                    {{--<span> تومان </span>--}}
                                                    {{--@else--}}
                                                    {{--<span class="numberPrice">{{$pro->price_user}}</span>--}}
                                                    {{--<span> تومان </span>--}}
                                                    {{--@endif--}}
                                                </p>

                                            </div>
                                        </a>
                                        {{-- <a href="{{route('product-info',$pro->slug)}}"
                                           class="text-uppercase text-center styled-link">
                                            <i uk-icon="cart" style="background: unset!important"></i>جزئیات
                                        </a> --}}
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <a href="{{route('product-info',$pro->slug)}}"
                                                       class="bg-info text-white p-2 px-4 rounded">
                                                        <i uk-icon="cart" style="background: unset!important"></i>جزئیات
                                                    </a>
                                                </div>
                                                <div class="col text-center">
                                                    <a href="{{route('add-to-basket',$pro->id)}}"
                                                        class="bg-success text-white p-2 px-4 rounded">
                                                         <i uk-icon="plus" style="background: unset!important"></i>سبد خرید
                                                     </a>
                                                </div>
                                            </div>
                                        </div>
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

                            @endforeach
                        @else
                            <p style="width: 100%;text-align: center">محصولی جهت نمایش موجود نمی باشد</p>
                        @endif

                        <div class="uk-width-1-1 uk-text-right" style="border-bottom: 1px solid #d6d6d6">
                            <p>بر اساس برند</p>
                        </div>

                        @if(count($brand125)>0)

                            @foreach($brand125 as $pro)

                                <div class="uk-width-1-4@m uk-width-1-2@s"
                                     style="padding-left:5px!important;padding-right:5px!important;">
                                    <div class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover"
                                         style="width: 100%; overflow: hidden; border-radius: 5px;height: auto">
                                        {{--@if($pro->price_vip!=null or $pro->price_vip!=0 and $pro->price_vip<$pro->price_user)--}}
                                        {{--<img class="offer" src="{{asset('source/assets/offer1.png')}}"--}}
                                        {{--style="width: 80px!important;">--}}
                                        {{--<span class="offer_span">%{{round(((intval($pro->price_user)-intval($pro->price_vip))/intval($pro->price_user))*100,1)}}</span>--}}
                                        {{--@endif--}}
                                        <a href="{{route('product-info-brand',[$pro->id,$category->id])}}">
                                            <div class="img_div"><img src="{{$pro->photo ? url('/'.$pro->photo->path):asset('source/assets/logo.png') }}" alt="{{$pro->title}}" style="width: 100%;max-height: 290px"></div>
                                            <div class="px-2 py-2">
                                                <p class="">
                                                    {{$pro->brand}}
                                                </p>
                                                <p class="" style="margin-bottom: 50px">
                                                    {{--@if($pro->price_vip!=null)--}}
                                                    {{--<del class="numberPrice"--}}
                                                    {{--style="margin-left: 10px">{{$pro->price_user}}</del>--}}
                                                    {{--<span class="numberPrice">{{$pro->price_vip}}</span>--}}
                                                    {{--<span> تومان </span>--}}
                                                    {{--@else--}}
                                                    {{--<span class="numberPrice">{{$pro->price_user}}</span>--}}
                                                    {{--<span> تومان </span>--}}
                                                    {{--@endif--}}
                                                </p>

                                            </div>
                                        </a>
                                        <a href="{{route('product-info-brand',[$pro->id,$category->id])}}"
                                           class="text-uppercase text-center styled-link">
                                            <i uk-icon="cart" style="background: unset!important"></i>جزئیات
                                        </a>
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

                            @endforeach
                        @else
                            <p style="width: 100%;text-align: center">محصولی جهت نمایش موجود نمی باشد</p>
                        @endif
                    </div>



                    <div class="col-md-12" style="text-align: right;margin-top: 10px">
                        {{--<h3 class="title_h3">{{$category->name}}</h3>--}}
                        <div class="stl">
                            {!! $category->text1 !!}
                        </div>
                    </div>

                </div>

            </div>

        </div>



    </section>

@endsection

@section('script')



@endsection





