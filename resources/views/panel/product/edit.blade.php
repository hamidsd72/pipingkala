@component('layouts.back')

    @slot('title') ویرایش {{ $title }} @endslot

    @slot('body')

        <style>

            .col-md-2 a {

                float: left;

            }

        </style>

        <div class="card">

            <div class="card-header archive-card-header">

                <div class="archive-circle-wrap">

                    <div class="archive-circle">
                        <a href="/" target="_blank">

                            <img src="{{ panel_logo() }}" style="margin-top: 10px;">
                        </a>
                    </div>

                    <h2>ویرایش {{ $title }}</h2>

                </div>

            </div>

            <div class="card-body">

                <div class="post">

                    {{ Form::model($item,array('route' => array('product-update',$item->id), 'method' => 'PATCH', 'files' => true)) }}

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group form-group-select">

                                {{ Form::label('id', 'ID') }}

                                <input type="text" value="{{$item->id}}" class="form-control" readonly>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group form-group-select">

                                {{ Form::label('brand_id', 'برند') }}

                                {{ Form::select('brand_id', array_pluck($brands, 'brand', 'id'), $item->brand_id, array('class' => 'form-control')) }}

                            </div>

                        </div>
                        <div class="col-md-12" hidden>

                            <div class="form-group form-group-select">

                                {{ Form::label('seller_id', 'فروشنده') }}

                                {{ Form::select('seller_id', array_pluck($sellers, 'name', 'id'), $item->seller_id, array('class' => 'form-control')) }}

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group form-group-select">

                                {{ Form::label('category_id', 'دسته بندی') }}
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $cats)
                                        <?php
                                        $cat1=App\Category::where('parent_id',$cats->id)->get();
                                        ?>
                                        @if(count($cat1)<1)
                                            <option {{$cats->id==$item->category_id ? 'selected' : ''}} value="{{$cats->id}}">{{$cats->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                {{--{{ Form::select('category_id', array_pluck($categories, 'name', 'id'), $item->category_id, array('class' => 'form-control')) }}--}}

                            </div>

                        </div>

                        <div class="col-md-12" hidden>

                            <div class="form-group">

                                {{ Form::label('barcode', 'بارکد محصول') }}

                                {{ Form::text('barcode', null, array('class' => 'form-control')) }}

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                {{ Form::label('title', '* نام فارسی') }}

                                {{ Form::text('title', null, array('class' => 'form-control')) }}

                            </div>

                        </div>

                        <div class="col-md-6" hidden>

                            <div class="form-group">

                                {{ Form::label('title_en', 'نام لاتین') }}

                                {{ Form::text('title_en', null, array('class' => 'form-control')) }}

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                {{ Form::label('slug', 'نامک') }}

                                {{ Form::text('slug', null, array('class' => 'form-control')) }}

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                {{ Form::label('country', 'کشور سازنده') }}

                                {{ Form::text('country', null, array('class' => 'form-control')) }}

                            </div>

                        </div>

                        <div class="col-md-12" style="margin-top: 10px;">

                            {{ Form::label('flag', 'پرچم کشور سازنده') }}

                            {{ Form::file('flag', array('accept' => 'image/*')) }}

                        </div>

                        <div class="col-md-12" hidden>
                            <div class="form-group">
                                {{ Form::label('tags', '* &#1606;&#1575;&#1605;&#1705;') }}
                                {{ Form::text('tags', '', array('class' => 'form-control','placeholder'=>'تگ1،تگ2،تگ3')) }}
                            </div>
                        </div>

                        <div class="col-md-6" hidden>

                            <div class="form-group">

                                {{ Form::label('size', 'سایز') }}

                                {{ Form::text('size', null, array('class' => 'form-control')) }}

                            </div>

                        </div>

                        <div class="col-md-6" hidden>

                            <div class="form-group">

                                {{ Form::label('weight', 'واحد') }}

                                {{ Form::text('weight', null, array('class' => 'form-control')) }}

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('unit', 'واحد فروش') }}
                                {{ Form::text('unit', null, array('class' => 'form-control','placeholder'=>'متر،شاخه،عدد،...')) }}
                            </div>
                        </div>
                        <div class="col-md-6" hidden>

                            <div class="form-group">

                                {{ Form::label('number', 'تعداد در هر بسته') }}

                                {{ Form::number('number', null, array('class' => 'form-control')) }}

                            </div>

                        </div>

                        <div class="col-md-6" hidden>

                            <div class="form-group">

                                {{ Form::label('value', 'مقدار در هر بسته') }}

                                {{ Form::number('value', null, array('class' => 'form-control')) }}

                            </div>

                        </div>

                        <div class="col-md-12">

                            {{ Form::label('description', 'توضیحات تکمیلی') }}

                            <div class="form-group form-group-post">

                                {{ Form::textarea('description', null, array('class' => 'form-control textarea')) }}

                            </div>

                        </div>

                        <div class="col-md-12">

                            {{ Form::label('text', 'شرح کوتاه') }}

                            <div class="form-group form-group-post">

                                {{ Form::textarea('text', null, array('class' => 'form-control textarea')) }}

                            </div>

                        </div>

                        {{--<div class="col-md-12">--}}

                        {{--{{ Form::label('phisical_text', 'توضیحات فنی') }}--}}

                        {{--<div class="form-group form-group-post">--}}

                        {{--{{ Form::textarea('phisical_text', null, array('class' => 'form-control textarea')) }}--}}

                        {{--</div>--}}

                        {{--</div>--}}

                        {{--<div class="col-md-12">--}}

                        {{--<div class="form-group">--}}

                        {{--{{ Form::label('other_job', 'چنانچه در سایر مشاغل مورد استفاده قرار میگیرد، توضیح دهید') }}--}}

                        {{--{{ Form::text('other_job', null, array('class' => 'form-control')) }}--}}

                        {{--</div>--}}

                        {{--</div>--}}

                        <div class="col-md-6" hidden>

                            <div class="form-group">

                                {{ Form::label('vip', 'پیشنهاد ویژه') }}

                                {{ Form::select('vip', array('0' => 'خیر' , '1' => 'بله'), null, array('class' => 'form-control')) }}

                            </div>

                        </div>

                        <div class="col-md-6" hidden>

                            <div class="form-group">

                                {{ Form::label('best', 'پرکاربردترین های ماه') }}

                                {{ Form::select('best', array('0' => 'خیر' , '1' => 'بله'), '', array('class' => 'form-control')) }}

                            </div>

                        </div>

                        {{--<div class="col-md-6">--}}

                        {{--<div class="form-group">--}}

                        {{--{{ Form::label('incredible', 'پیشنهاد شگفت انگیز') }}--}}

                        {{--{{ Form::select('incredible', array('0' => 'خیر' , '1' => 'بله'), null, array('class' => 'form-control')) }}--}}

                        {{--</div>--}}

                        {{--</div>--}}

                        {{--<div class="col-md-12">--}}

                        {{--<div class="form-group">--}}

                        {{--{{ Form::label('vip_info', 'توضیحات فروش ویژه در صورت وجود') }}--}}

                        {{--{{ Form::text('vip_info', null, array('class' => 'form-control' , 'placeholder' => 'به عنوان مثال: فروش اقساطی با چک 3 ماهه')) }}--}}

                        {{--</div>--}}

                        {{--</div>--}}

                        <div class="col-md-12" style="margin-top: 10px;">

                            {{ Form::label('article', 'آپلود مقاله در صورت وجود') }}

                            {{ Form::file('article', array('accept' => '*/*')) }}

                        </div>

                        <div class="col-md-12" style="margin-top: 10px;">

                            {{ Form::label('video', 'آپلود ویدئو در صورت وجود') }}

                            {{ Form::file('video', array('accept' => '*/*')) }}

                        </div>

                        <div class="col-md-12" style="border: 1px solid #00000036;" hidden>

                            {{ Form::label('types', 'انواع') }}

                            <a class="types1" title="افزودن نوع" style="float: left;"><i class="fa fa-plus"
                                                                                         style="font-size:32px;color:green; cursor: pointer;"></i></a>

                            <div class="form-group types-d">

                                @foreach($prices as $price)

                                    <div class="row" style="border-bottom: 1px solid; margin-bottom: 15px;">

                                        <input type="hidden" name="iden[]" value="{{$price->id}}">
                                        <div class="col-md-4">

                                            {{ Form::label('type_type', 'نوع') }}
                                            <select name="type[]" id="type[]" class="form-control typeeee">
                                                <option value="">نوع محصول را انتخاب کنید</option>
                                                @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->type}}</option>
                                                    @endforeach
                                            </select>
{{--                                            {{ Form::select('type[]', array_pluck($types, 'type', 'id'), $price->type, array('class' => 'form-control typeeee')) }}--}}

                                        </div>

                                        <div class="col-md-8">

                                            {{ Form::label('type_desc', 'مقدار نوع') }}

                                            <select name="type_desc[]" class="form-control valueeee">

                                                @foreach($values as $value)

                                                    <option value="{{$value}}"
                                                            @if($price->description == $value) selected @endif>{{$value}}</option>

                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-md-6">
                                        {{ Form::label('brand_id', 'برند') }}

                                        {{ Form::select('brand_id', array_pluck($brands, 'brand', 'id'), $item->brand_id, array('class' => 'form-control')) }}

                                        </div>
                                        <div class="col-md-6">

                                            {{ Form::label('price', 'قیمت افزایشی') }}

                                            {{ Form::number('price[]', $price->price, array('class' => 'form-control')) }}

                                        </div>

                                        <div class="col-md-4" style="display: none">

                                            {{ Form::label('value_in_packet', 'مقدار در بسته') }}

                                            {{ Form::text('value_in_packet[]', $price->value_in_packet, array('class' => 'form-control')) }}

                                        </div>

                                        <div class="col-md-4">

                                            {{--<a href="{{route('product-type-del',$price->id)}}" class="btn btn-danger"--}}
                                               {{--onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>--}}

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                        <div class="col-md-12" style="border: 1px solid #00000036;" hidden="">

                            <a class="attr1" title="افزودن ویژگی" style="float: left;"><i class="fa fa-plus"
                                                                                          style="font-size:32px;color:green; cursor: pointer;"></i></a>

                            {{ Form::label('attributes', 'ویژگی های محصول ( فیلتر )') }}

                            <div class="form-group attr-f">

                                <div class="row">

                                    <div class="col-md-2">

                                        <label style="float: left;">حذف</label>

                                    </div>

                                    <div class="col-md-5">

                                        {{ Form::label('attr_name', 'نام ویژگی') }}

                                    </div>

                                    <div class="col-md-5">

                                        {{ Form::label('attr_val', 'مقدار ویژگی') }}

                                    </div>

                                </div>

                                @foreach($attributejoins as $attributejoin)

                                    <div class="row">

                                        <div class="col-md-2">

                                            <a href="{{route('product-attr-del',$attributejoin->id)}}" title="حذف"><i
                                                        class="fa fa-close" style="font-size:40px; color: red;"></i></a>

                                        </div>

                                        <div class="col-md-5">

                                            {{ Form::select('attr[]', array_pluck($attributes, 'name', 'id'), $attributejoin->attribute_id, array('class' => 'form-control')) }}

                                        </div>

                                        <div class="col-md-5">

                                            {{ Form::text('val[]', $attributejoin->value, array('class' => 'form-control')) }}

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                        <div class="col-md-12" style="border: 1px solid #00000036;">

                            <a class="attr11" title="افزودن ویژگی" style="float: left;"><i class="fa fa-plus"
                                                                                           style="font-size:32px;color:green; cursor: pointer;"></i></a>

                            {{ Form::label('attributes', 'ویژگی های محصول ( مقایسه )') }}

                            <div class="form-group attr-m">

                                <div class="row">

                                    <div class="col-md-2">

                                        <label style="float: left;">حذف</label>

                                    </div>

                                    <div class="col-md-5">

                                        {{ Form::label('cmp_name', 'نام ویژگی') }}

                                    </div>

                                    <div class="col-md-5">

                                        {{ Form::label('cmp_val', 'مقدار ویژگی') }}

                                    </div>

                                </div>

                                @foreach($comparejoins as $comparejoin)

                                    <div class="row">

                                        <div class="col-md-2">

                                            <a href="{{route('product-attr-del',$comparejoin->id)}}" title="حذف"><i
                                                        class="fa fa-close" style="font-size:40px; color: red;"></i></a>

                                        </div>

                                        <div class="col-md-5">

                                            {{ Form::select('attr1[]', array_pluck($comarisons, 'name', 'id'), $comparejoin->comparison_id, array('class' => 'form-control')) }}

                                        </div>

                                        <div class="col-md-5">

                                            {{ Form::text('val1[]', $comparejoin->value, array('class' => 'form-control')) }}

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                        <div class="form-group gallery" style="border: 1px solid #00000036; margin-top: 10px;">

                            <div class="col-md-12" style="margin-top: 10px;">

                                {{ Form::label('pic', 'تصویر شاخص') }}

                                {{ Form::file('pic', array('accept' => 'image/*')) }}

                            </div>

                            <a class="gal" title="افزودن گالری" style="float: left;"><i class="fa fa-plus"
                                                                                        style="font-size:32px;color:green; cursor: pointer;"></i></a>

                            <div class="col-md-6" style="margin-top: 10px;">

                                {{ Form::label('photo[]', 'گالری') }}

                                {{ Form::file('photo[]', array('accept' => 'image/*')) }}

                            </div>

                        </div>

                        <div class="col-md-12" hidden>

                            <div class="form-group">

                                {{ Form::label('likes', 'آی دی محصولات مرتبط') }}

                                {{ Form::text('likes', null, array('class' => 'form-control' , 'placeholder' => 'لطفا با کاما (،) از هم جدا کنید')) }}

                            </div>

                        </div>

                        <div class="col-md-12" hidden>

                            <div class="form-group">

                                {{ Form::label('articles', 'آی دی مقالات مرتبط') }}

                                {{ Form::text('articles', null, array('class' => 'form-control' , 'placeholder' => 'لطفا با کاما (،) از هم جدا کنید')) }}

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                {{ Form::label('labels', 'برچسب های محصول') }}

                                {{ Form::text('labels', null, array('class' => 'form-control' , 'placeholder' => 'لطفا با کاما (،) از هم جدا کنید')) }}

                            </div>

                        </div>

                    </div>

                    <br/>

                    <a href="{{ URL::previous() }}" class="btn btn-rounded btn-secondary float-right"><i
                                class="fa fa-chevron-circle-right ml-1"></i>بازگشت</a>

                    {{ Form::button('<i class="fa fa-circle-o mtp-1 ml-1"></i>ویرایش', array('type' => 'submit', 'class' => 'btn btn-rounded btn-primary float-left')) }}

                    {{ Form::close() }}

                </div>

            </div>

        </div>

    @endslot

    @push('scripts')

        <script src="{{ url('source/assets/editor/laravel-ckeditor/ckeditor.js') }}"></script>
        <script src="{{ url('source/assets/editor/laravel-ckeditor/adapters/jquery.js') }}"></script>

        <script type="text/javascript">

            var textareaOptions = {

                filebrowserImageBrowseUrl: '{{ url('filemanager?type=Images') }}',

                filebrowserImageUploadUrl: '{{ url('filemanager/upload?type=Images&_token=') }}',

                filebrowserBrowseUrl: '{{ url('filemanager?type=Files') }}',

                filebrowserUploadUrl: '{{ url('filemanager/upload?type=Files&_token=') }}',

                language: 'fa'

            };

            $('.textarea').ckeditor(textareaOptions);

            slug('#title', '#slug');

        </script>

        <script>

            $(".types1").click(function () {

                $(".types-d").append('<div class="row" style="border-bottom: 1px solid; margin-bottom: 15px;">' +

                    '<div class="col-md-4">' +

                    '{{ Form::label('type_type', '&#1606;&#1608;&#1593;') }}' +

                    '<select name="type[]" id="type[]" class="form-control typeeee">'+
                    '<option value="">نوع محصول را انتخاب کنید</option>'+
                '@foreach($types as $type)'+
                '<option value="{{$type->id}}">{{$type->type}}</option>'+
                        '@endforeach'+
                    '</select>'+

                    '</div>' +

                    '<div class="col-md-8">\n' +

                    '{{ Form::label('type_desc', 'مقدار نوع') }}' +

                    '<select name="type_desc[]" class="form-control valueeee"></select>' +

                    '</div>' +

                    '<div class="col-md-4">' +

                    '{{ Form::label('price', 'قیمت افزایشی') }}' +

                    '{{ Form::number('price[]', '', array('class' => 'form-control')) }}' +

                    '</div>' +

                    '<div class="col-md-4" style="display : none">' +

                    '{{ Form::label('value_in_packet', 'مقدار در بسته') }}' +

                    '{{ Form::text('value_in_packet[]', '', array('class' => 'form-control')) }}' +

                    '</div>' +


                    '</div>');
                $('.typeeee').change(function () {
                    var id = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{route('typeAjax1')}}',
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function (data) {
                            $('.valueeee').empty();

                            $.each(data, function (key, val) {

                                var option = "<option value="+ val +">" + val + "</option>";
                                $('.valueeee').append(option);
                            })
                        }
                    });
                });
            });

            $(".attr1").click(function () {

                $(".attr-f").append('<div class="row">' +

                    '<div class="col-md-6">' +

                    '{{ Form::select('attr[]', array_pluck($attributes, 'name', 'id'), '', array('class' => 'form-control')) }}' +

                    '</div>' +

                    '<div class="col-md-6">' +

                    '<input type="text" name="val[]" class="form-control">' +

                    '</div>' +

                    '</div>');

            });


            $(".attr11").click(function () {

                $(".attr-m").append('<div class="row">' +

                    '<div class="col-md-6">' +

                    '{{ Form::select('attr1[]', array_pluck($comarisons, 'name', 'id'), '', array('class' => 'form-control')) }}' +

                    '</div>' +

                    '<div class="col-md-6">' +

                    '<input type="text" name="val1[]" class="form-control">' +

                    '</div>' +

                    '</div>');

            });

            $(".gal").click(function () {

                $(".gallery").append('<div class="col-md-6" style="margin-top: 10px;">' +

                    '{{ Form::label('photo[]', 'گالری') }}' +

                    '{{ Form::file('photo[]', array('accept' => 'image/*')) }}' +

                    '</div>');

            });

        </script>

        <script>


            $('.typeeee').change(function () {

                var id = $(this).val();

                $(this).val(id);


                var attr = $(this);


                $.ajax({

                    type: 'GET',

                    url: 'typeAjax/' + id,

                    success: function (data) {


                        $(attr).parent('.col-md-4').parent().find('.valueeee').empty();

                        $.each(data, function (key, val) {

                            $(attr).parent('.col-md-4').parent().find('.valueeee').append(
                                "<option value='" + val + "'>" + val + "</option>"
                            );

                        });

                    }

                });

            });


        </script>

    @endpush

@endcomponent