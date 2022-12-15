@component('layouts.front')


@section('content')



    <!-- breadcrumb end -->

    <!-- about-us-area-start -->

    <div class="about-us-area mt-5 mb-5">

        <div class="container" style="color: #333;">

            <div class="row">

                @if(isset($footer->photo))

                    <div class="col-lg-6">


                        <img src="{{url($footer->photo->path)}}" style="width: 100%">


                    </div>

                @endif

                <style>
                    .about-us-page span {
                        font-family: 'IRANYekan' !important;
                    }
                </style>
                <div class="col-lg-6">

                    <div class="about-us-page">


                            {!! $footer->text !!}


                    </div>

                </div>

            </div>
            @if($footer->id==9)
                <div class="vac">
                    <div class="col-md-6 text-center" style="margin-bottom: 45px;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3239.705299687551!2d51.335052515201106!3d35.7088690360633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8dfdfd25e59207%3A0xc548bcd529788049!2sDr.+Tavakolian+Pharmacy!5e0!3m2!1sen!2s!4v1545125859881"
                                frameborder="0" style="border:0;width: 100%;height: 400px;" allowfullscreen></iframe>
                    </div>
                    {!! Form::open(['route' => 'user-contact-store' ,'class'=>'text-center']) !!}

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="name">نام و نام خانوادگی</label>

                            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'نام و نام خانوادگی خود را وارد نمایید']) !!}

                        </div>

                        <div class="form-group col-md-6">

                            <label for="subject">ایمیل</label>

                            {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'ایمیل']) !!}

                        </div>

                        <div class="form-group col-md-12">

                            <label for="descriptions">توضیح نظر</label>

                            {!! Form::textarea('descriptions', null, ['class'=>'form-control', 'placeholder'=>'لطفا مطلب خود را وارد نمایید', 'row'=>3]) !!}

                        </div>

                        <div class="form-group">

                            <button type="submit" class="btn btn-success">ثبت نظر</button>

                        </div>


                    </div>

                    {!! Form::close() !!}

                </div>
            @endif

        </div>

    </div>

@endsection

@push('scripts')

@endpush

@endcomponent