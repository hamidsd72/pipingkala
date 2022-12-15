@component('layouts.back')
    @slot('title') &#1575;&#1601;&#1586;&#1608;&#1583;&#1606; {{ $title }} @endslot
    @slot('body')
        <div class="card">
            <div class="card-header archive-card-header">
                <div class="archive-circle-wrap">
                    <div class="archive-circle">
                        <a href="/" target="_blank">

                            <img src="{{ panel_logo() }}" style="margin-top: 10px;">
                        </a>
                    </div>
                    <h2>&#1575;&#1601;&#1586;&#1608;&#1583;&#1606; {{ $title }}</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="post">
                    {{ Form::open(array('route' => 'product-store', 'method' => 'PUT', 'files' => true)) }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-select">
                                {{ Form::label('brand_id', '* &#1576;&#1585;&#1606;&#1583;') }}
                                {{ Form::select('brand_id', array_pluck($brands, 'brand', 'id'), '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-12" hidden>
                            <div class="form-group form-group-select">
                                {{ Form::label('seller_id', 'فروشنده') }}
                                {{ Form::select('seller_id', array_pluck($sellers, 'name', 'id'), '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-select">
                                {{ Form::label('category_id', '* &#1583;&#1587;&#1578;&#1607; &#1576;&#1606;&#1583;&#1740;') }}
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $cats)
                                        <?php
                                        $cat1=App\Category::where('parent_id',$cats->id)->get();
                                        ?>
                                        @if(count($cat1)<1)
                                            <option value="{{$cats->id}}">{{$cats->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                {{--{{ Form::select('category_id', array_pluck($categories, 'name', 'id'), '', array('class' => 'form-control')) }}--}}
                            </div>
                        </div>
                        <div class="col-md-12" hidden>
                            <div class="form-group">
                                {{ Form::label('barcode', 'بارکد محصول') }}
                                {{ Form::text('barcode', '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('title', '* نام ') }}
                                {{ Form::text('title', '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-6" hidden>
                            <div class="form-group">
                                {{ Form::label('title_en', 'نام لاتین') }}
                                {{ Form::text('title_en', '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('slug', '* &#1606;&#1575;&#1605;&#1705;') }}
                                {{ Form::text('slug', '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('country', '&#1705;&#1588;&#1608;&#1585; &#1587;&#1575;&#1586;&#1606;&#1583;&#1607;') }}
                                {{ Form::text('country', '', array('class' => 'form-control')) }}
                            </div>
                        </div>


                        <div class="col-md-12" hidden>
                            <div class="form-group">
                                {{ Form::label('tags', '* &#1606;&#1575;&#1605;&#1705;') }}
                                {{ Form::text('tags', '', array('class' => 'form-control','placeholder'=>'تگ1،تگ2،تگ3')) }}
                            </div>
                        </div>


                        <div class="col-md-12" style="margin-top: 10px;"hidden>
                            {{ Form::label('flag', 'پرچم کشور سازنده') }}
                            {{ Form::file('flag', array('accept' => 'image/*')) }}
                        </div>

                        <div class="col-md-6"hidden>
                            <div class="form-group">
                                {{ Form::label('size', 'سایز') }}
                                {{ Form::text('size', '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-6" hidden>
                            <div class="form-group">
                                {{ Form::label('weight', 'واحد فروش') }}
                                {{ Form::text('weight', '', array('class' => 'form-control','placeholder'=>'متر،شاخه،عدد،...')) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('unit', 'واحد فروش') }}
                                {{ Form::text('unit', '', array('class' => 'form-control','placeholder'=>'متر،شاخه،عدد،...')) }}
                            </div>
                        </div>
                        <div class="col-md-6"hidden>
                            <div class="form-group">
                                {{ Form::label('number', 'تعداد در هر بسته') }}
                                {{ Form::number('number', '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-6"hidden>
                            <div class="form-group">
                                {{ Form::label('value', 'مقدار در هر بسته') }}
                                {{ Form::number('value', '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('description', '* &#1578;&#1608;&#1590;&#1740;&#1581;&#1575;&#1578; &#1578;&#1705;&#1605;&#1740;&#1604;&#1740;') }}
                            <div class="form-group form-group-post">
                                {{ Form::textarea('description', '', array('class' => 'form-control textarea')) }}
                            </div>
                        </div>
                        <div class="col-md-12">

                            {{ Form::label('text', 'شرح کوتاه ') }}

                            <div class="form-group form-group-post">

                                {{ Form::textarea('text', '', array('class' => 'form-control textarea')) }}

                            </div>

                        </div>
                        {{--<div class="col-md-12">--}}
                        {{--{{ Form::label('phisical_text', '&#1578;&#1608;&#1590;&#1740;&#1581;&#1575;&#1578; &#1601;&#1606;&#1740;') }}--}}
                        {{--<div class="form-group form-group-post">--}}
                        {{--{{ Form::textarea('phisical_text', '', array('class' => 'form-control textarea')) }}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12">--}}
                        {{--<div class="form-group">--}}
                        {{--{{ Form::label('other_job', '&#1670;&#1606;&#1575;&#1606;&#1670;&#1607; &#1583;&#1585; &#1587;&#1575;&#1740;&#1585; &#1605;&#1588;&#1575;&#1594;&#1604; &#1605;&#1608;&#1585;&#1583; &#1575;&#1587;&#1578;&#1601;&#1575;&#1583;&#1607; &#1602;&#1585;&#1575;&#1585; &#1605;&#1740;&#1711;&#1740;&#1585;&#1583;&#1548; &#1578;&#1608;&#1590;&#1740;&#1581; &#1583;&#1607;&#1740;&#1583;') }}--}}
                        {{--{{ Form::text('other_job', '', array('class' => 'form-control')) }}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-6" hidden>
                            <div class="form-group">
                                {{ Form::label('vip', '&#1662;&#1740;&#1588;&#1606;&#1607;&#1575;&#1583; &#1608;&#1740;&#1688;&#1607;') }}
                                {{ Form::select('vip', array('0' => '&#1582;&#1740;&#1585;' , '1' => '&#1576;&#1604;&#1607;'), '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-6" hidden>
                            <div class="form-group">
                                {{ Form::label('best', '&#1662;&#1585;&#1705;&#1575;&#1585;&#1576;&#1585;&#1583;&#1578;&#1585;&#1740;&#1606; &#1607;&#1575;&#1740; &#1605;&#1575;&#1607;') }}
                                {{ Form::select('best', array('0' => '&#1582;&#1740;&#1585;' , '1' => '&#1576;&#1604;&#1607;'), '', array('class' => 'form-control')) }}
                            </div>
                        </div>
                        {{--<div class="col-md-6">--}}
                        {{--<div class="form-group">--}}
                        {{--{{ Form::label('incredible', '&#1662;&#1740;&#1588;&#1606;&#1607;&#1575;&#1583; &#1588;&#1711;&#1601;&#1578; &#1575;&#1606;&#1711;&#1740;&#1586;') }}--}}
                        {{--{{ Form::select('incredible', array('0' => '&#1582;&#1740;&#1585;' , '1' => '&#1576;&#1604;&#1607;'), '', array('class' => 'form-control')) }}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12">--}}
                        {{--<div class="form-group">--}}
                        {{--{{ Form::label('vip_info', '&#1578;&#1608;&#1590;&#1740;&#1581;&#1575;&#1578; &#1601;&#1585;&#1608;&#1588; &#1608;&#1740;&#1688;&#1607; &#1583;&#1585; &#1589;&#1608;&#1585;&#1578; &#1608;&#1580;&#1608;&#1583;') }}--}}
                        {{--{{ Form::text('vip_info', '', array('class' => 'form-control' , 'placeholder' => '&#1576;&#1607; &#1593;&#1606;&#1608;&#1575;&#1606; &#1605;&#1579;&#1575;&#1604;: &#1601;&#1585;&#1608;&#1588; &#1575;&#1602;&#1587;&#1575;&#1591;&#1740; &#1576;&#1575; &#1670;&#1705; 3 &#1605;&#1575;&#1607;&#1607;')) }}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-12" style="margin-top: 10px;">
                            {{ Form::label('article', '&#1570;&#1662;&#1604;&#1608;&#1583; &#1605;&#1602;&#1575;&#1604;&#1607; &#1583;&#1585; &#1589;&#1608;&#1585;&#1578; &#1608;&#1580;&#1608;&#1583;') }}
                            {{ Form::file('article', array('accept' => '*/*')) }}
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;">
                            {{ Form::label('video', '&#1570;&#1662;&#1604;&#1608;&#1583; &#1608;&#1740;&#1583;&#1574;&#1608; &#1583;&#1585; &#1589;&#1608;&#1585;&#1578; &#1608;&#1580;&#1608;&#1583;') }}
                            {{ Form::file('video', array('accept' => '*/*')) }}
                        </div>
                        <div class="col-md-12" style="border: 1px solid #00000036;" hidden>
                            {{ Form::label('types', '&#1575;&#1606;&#1608;&#1575;&#1593;') }}
                            <a class="types1"
                               title="&#1575;&#1601;&#1586;&#1608;&#1583;&#1606; &#1608;&#1740;&#1688;&#1711;&#1740;"
                               style="float: left;"><i class="fa fa-plus"
                                                       style="font-size:32px;color:green; cursor: pointer;"></i></a>
                            <div class="form-group types-d">
                                <div class="row" style="border-bottom: 1px solid; margin-bottom: 15px;">
                                    <div class="col-md-4">
                                        {{ Form::label('type_type', '&#1606;&#1608;&#1593;') }}
                                        {{--                                        {{ Form::text('type[]', '', array('class' => 'form-control')) }}--}}
                                        <select name="type[]" id="type[]" class="form-control typeeee">
                                            <option value="">نوع محصول را انتخاب کنید</option>
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        {{ Form::label('type_desc', 'مقدار نوع') }}
                                        <select name="type_desc" class="form-control valueeee">
                                            {{--@foreach($values as $value)--}}
                                            {{--<option value="{{$value}}">{{$value}}</option>--}}
                                            {{--@endforeach--}}
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::label('price', 'قیمت افزایشی') }}
                                        {{ Form::number('price[]', '', array('class' => 'form-control')) }}
                                    </div>
                                    <div class="col-md-4" style="display: none">
                                        {{ Form::label('value_in_packet', 'مقدار در بسته') }}
                                        {{ Form::text('value_in_packet[]', '', array('class' => 'form-control')) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="border: 1px solid #00000036;" hidden>
                            {{ Form::label('attributes', '&#1608;&#1740;&#1688;&#1711;&#1740; &#1607;&#1575;&#1740; &#1605;&#1581;&#1589;&#1608;&#1604; ( &#1601;&#1740;&#1604;&#1578;&#1585; )') }}
                            <a class="attr1"
                               title="&#1575;&#1601;&#1586;&#1608;&#1583;&#1606; &#1608;&#1740;&#1688;&#1711;&#1740;"
                               style="float: left;"><i class="fa fa-plus"
                                                       style="font-size:32px;color:green; cursor: pointer;"></i></a>
                            <div class="form-group attr-f">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::label('attr_name', '&#1606;&#1575;&#1605; &#1608;&#1740;&#1688;&#1711;&#1740;') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::label('attr_val', '&#1605;&#1602;&#1583;&#1575;&#1585; &#1608;&#1740;&#1688;&#1711;&#1740;') }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::select('attr1[]', array_pluck($attributes, 'name', 'id'), '', array('class' => 'form-control select-combo')) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::select('val1[]',[] , '', array('class' => 'form-control upData')) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="border: 1px solid #00000036; margin-top: 10px;" >
                            <a class="attr11"
                               title="&#1575;&#1601;&#1586;&#1608;&#1583;&#1606; &#1608;&#1740;&#1688;&#1711;&#1740;"
                               style="float: left;"><i class="fa fa-plus"
                                                       style="font-size:32px;color:green; cursor: pointer;"></i></a>
                            {{ Form::label('attributes', '&#1608;&#1740;&#1688;&#1711;&#1740; &#1607;&#1575;&#1740; &#1605;&#1581;&#1589;&#1608;&#1604; ( &#1605;&#1602;&#1575;&#1740;&#1587;&#1607; )') }}
                            <div class="form-group attr-m">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::label('cmp_name', '&#1606;&#1575;&#1605; &#1608;&#1740;&#1688;&#1711;&#1740;') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::label('cmp_val', '&#1605;&#1602;&#1583;&#1575;&#1585; &#1608;&#1740;&#1688;&#1711;&#1740;') }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::select('attr11[]', array_pluck($compars, 'name', 'id'), '', array('class' => 'form-control')) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::text('val11[]', '', array('class' => 'form-control')) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group gallery" style="border: 1px solid #00000036; margin-top: 10px;">
                            <div class="col-md-12" style="margin-top: 10px;">
                                {{ Form::label('pic', '&#1578;&#1589;&#1608;&#1740;&#1585; &#1588;&#1575;&#1582;&#1589;') }}
                                {{ Form::file('pic', array('accept' => 'image/*')) }}
                            </div>
                            <a class="gal"
                               title="&#1575;&#1601;&#1586;&#1608;&#1583;&#1606; &#1711;&#1575;&#1604;&#1585;&#1740;"
                               style="float: left;"><i class="fa fa-plus"
                                                       style="font-size:32px;color:green; cursor: pointer;"></i></a>
                            <div class="col-md-6" style="margin-top: 10px;">
                                {{ Form::label('photo[]', '&#1711;&#1575;&#1604;&#1585;&#1740;') }}
                                {{ Form::file('photo[]', array('accept' => 'image/*')) }}
                            </div>
                        </div>
                        <div class="col-md-12" hidden>
                            <div class="form-group">
                                {{ Form::label('likes', 'آی دی محصولات مرتبط') }}
                                {{ Form::text('likes', '', array('class' => 'form-control' , 'placeholder' => 'لطفا با کاما (،) از هم جدا کنید')) }}
                            </div>
                        </div>
                        <div class="col-md-12" hidden>
                            <div class="form-group">
                                {{ Form::label('articles', 'آی دی مقالات مرتبط') }}
                                {{ Form::text('articles', '', array('class' => 'form-control' , 'placeholder' => 'لطفا با کاما (،) از هم جدا کنید')) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('labels', 'برچسب های محصول') }}
                                {{ Form::text('labels', '', array('class' => 'form-control' , 'placeholder' => 'لطفا با کاما (،) از هم جدا کنید')) }}
                            </div>
                        </div>
                    </div>
                    <br/>
                    <a href="{{ URL::previous() }}" class="btn btn-rounded btn-secondary float-right"><i
                                class="fa fa-chevron-circle-right ml-1"></i>&#1576;&#1575;&#1586;&#1711;&#1588;&#1578;</a>
                    {{ Form::button('<i class="fa fa-circle-o mtp-1 ml-1"></i>&#1575;&#1601;&#1586;&#1608;&#1583;&#1606;', array('type' => 'submit', 'class' => 'btn btn-rounded btn-primary float-left')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endslot
    @push('scripts')
        <script src="{{ url('source/assets/editor/laravel-ckeditor/ckeditor.js') }}"></script>
        <script src="{{ url('source/assets/editor/laravel-ckeditor/adapters/jquery.js') }}"></script>
        <script>
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


            $('.select-combo').on('change', function () {
                var id = $(this).val();
                $('.typeeee').val(id);
                $.ajax({
                    type: 'GET',
                    url: 'status/' + id,
                    success: function (data) {
                        console.log(data);
                        $('.upData').empty();
                        $.each(data, function (key, val) {
                            console.log(val);
                            $('.upData').append(
                                "<option value='" + val + "'>" + val + "</option>"
                            );
                        });
                    }
                });
            });


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
                    '<div class="col-md-4" style="display:none">' +
                    '{{ Form::label('value_in_packet', 'مقدار در بسته') }}' +
                    '{{ Form::text('value_in_packet[]', '', array('class' => 'form-control')) }}' +
                    '</div>' +
                    '</div>');


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

            });

            $(".attr1").click(function () {
                $(".attr-f").append('<div class="row">' +
                    '<div class="col-md-6">' +
                    '{{ Form::select('attr1[]', array_pluck($attributes, 'name', 'id'), '', array('class' => 'form-control select-combo')) }}' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '{{ Form::select('val1[]',[] , [] , array('class' => 'form-control upData')) }}' +
                    '</div>' +
                    '</div>');


                $('.select-combo').on('change', function () {
                    var id = $(this).val();
                    $('.typeeee').val(id);
                    $.ajax({
                        type: 'GET',
                        url: 'status/' + id,
                        success: function (data) {
                            $(this).parents('.row').children('.upData').empty();
                            $.each(data, function (key, val) {
                                console.log(val);
                                $(this).parents('.row').children('.upData').append(
                                    "<option value='" + val + "'>" + val + "</option>"
                                );
                            });
                        }
                    });
                });

            });

            $(".attr11").click(function () {
                $(".attr-m").append('<div class="row">' +
                    '<div class="col-md-6">' +
                    '{{ Form::select('attr11[]', array_pluck($compars, 'name', 'id'), '', array('class' => 'form-control')) }}' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<input type="text" name="val11[]" class="form-control">' +
                    '</div>' +
                    '</div>');
            });
            $(".gal").click(function () {
                $(".gallery").append('<div class="col-md-6" style="margin-top: 10px;">' +
                    '{{ Form::label('photo[]', '&#1711;&#1575;&#1604;&#1585;&#1740;') }}' +
                    '{{ Form::file('photo[]', array('accept' => 'image/*')) }}' +
                    '</div>');
            });
        </script>
    @endpush
@endcomponent