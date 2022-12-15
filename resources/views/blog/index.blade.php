@extends('layouts.front')
@section('content')
        <style>
            .col-md-3 {
                float: left;
            }
            .col-md-3:hover{
                box-shadow: 0 0 2px 2px #6d6d6d;
            }
        </style>

        <div class="breadcrumb-area" style="margin-top: 50px!important;">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a style="color: black !important;" href="{{route('home')}}"><i class="fa fa-home"></i> خانه</a>
                    </li>
                </ol>
            </div>
        </div>

        <section class="new-section">
            <div class="row">
                <div class="container">
                <div class="col-md-12">
                    <div class="titie-section wow fadeInDown">
                        <h1>لیست مقالات @if(isset($category)){{$category->name}} @endif</h1>
                    </div>
                </div>
                @foreach($articles as $i => $k)
                    <div class="col-md-3 col-sm-6 " style="height: 250px" data-wow-delay="0.{{$i}}s">
                        <div class="product-item box-article">
                            <a href="{{route('article',$k->id)}}">

                                @if(isset($k->photo))
                                    <img style="width: 100%;height: 100px" src="{{url($k->photo->path)}}">
                                @else
                                    <img style="width: 100%;height: 100px" src="http://via.placeholder.com/300">
                                @endif
                                    <h6 style="padding: 0px">

                                        {{mb_substr($k->title, 0, 50)}}

                                    </h6>
                                    <p style="font-size: 9px !important;margin-left: 11px"><i
                                                class="fa fa-user"></i> : {{$k->author}}
                                    </p>

                                    <p style="color: black;font-size: 12px">
                                        {!! mb_substr($k->short_text, 0, 100) !!}
                                    </p>
                            </a>
                        </div>
                    </div>

                @endforeach
                </div>
            </div>
        </section>
@endsection
@section('script')
        <script>
            $(document).ready(function () {
                $('.numberPrice').text(function (index, value) {
                    return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
        </script>
@endsection