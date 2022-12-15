@component('layouts.back')    @slot('title') مدیریت {{ $title }} @endslot    @slot('body')
    <style>            input.form-control {
            width: 18%;
        }        </style>
    <div class="card">
        <div class="card-header archive-card-header">
            <div class="archive-circle-wrap">
                <div class="archive-circle">
                    <a href="/" target="_blank">

                        <img src="{{ panel_logo() }}" style="margin-top: 10px;">
                    </a>
                </div>
                <h2>لیست {{ $title }}</h2></div>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <form action="{{route('product-search')}}" method="post" enctype="multipart/form-data">
                    <div class="row"><input type="text" name="id" class="form-control" placeholder="ID"> <input
                                type="text" name="product" class="form-control" placeholder="نام محصول"> <input
                                type="text" name="barcode" class="form-control" hidden placeholder="بارکد"> <input  type="text"
                                                                                                            name="brand"
                                                                                                            class="form-control"
                                                                                                            placeholder="برند">
                        <input type="text" name="category" class="form-control" placeholder="دسته بندی">
                        <button type="submit" class="btn btn-primary">جستجو</button> {{ csrf_field() }}
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="archive-table">
                    <tr>
                        <td><h6>ID</h6></td>
                        <td><h6>نام محصول</h6></td><!--                            <td><h6>موجودی</h6></td>-->
                        <td><h6>تعداد بازدید</h6></td><!--                            <td><h6>موجودی</h6></td>-->
                        <td><h6>برند</h6></td>
                        <td><h6>دسته بندی محصول</h6></td>
                        <td><h6>تصویر</h6></td>
                        <td><h6>عملیات</h6></td>
                    </tr> @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }} </td>
                            <td><a href="{{route('product-info',$product->slug)}}"
                                   target="_blank"> {{ $product->title }} </a>
                            </td><!--                                <td>{{ $product->inventory }}</td>-->
                            <td>{{$product->seen ? $product->seen : '0'}}</td>
                            <td>@if($product->brand){{ $product->brand->brand }}@endif</td>
                            <td>@if($product->category){{ $product->category->name }}@endif</td>
                            <td>                                    @if($product->pic)
                                    <img src="{{url($product->pic)}}"
                                         width="100px">                                    @endif
                            </td>
                            <td width="140">
                                <div class="btn-inline">
                                    <a href="{{route('p-product-gallery',$product->id)}}" class="btn btn-sm btn-info float-left mr-1">
                                        <i class="fa fa-image ml-1"></i>گالری
                                    </a>
                                    <a href="{{route('product-info',$product->slug)}}" target="_blank" class="btn btn-sm btn-info float-left mr-1">
                                        <i class="fa fa-eye ml-1"></i>پیشنمایش</a>
                                    <a href="{{route('product-edit',$product->id)}}"
                                       class="btn btn-sm btn-info float-left mr-1"><i class="fa fa-edit ml-1"></i>ویرایش</a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['product-destroy', $product->id] ]) !!}                                        {!! Form::button('<i class="fa fa-ban ml-1"></i>حذف', ['type' => 'submit', 'class' => 'btn btn-danger float-left', 'onclick' => 'return confirm("آیا مطمئن هستید؟")']) !!}                                        {!! Form::close() !!}
                                    <a href="{{route('product-model-list',$product->id)}}"  class="btn btn-sm btn-info float-left mr-1">
                                        <i class="fas fa-plus-square ml-1"></i>افزودن مدل</a>
                                </div>
                            </td>
                        </tr>                        @endforeach                    </table>
            </div>
            <div class="paginate p-3">                    {{ $products->links() }} <a href="{{route('product-create')}}"
                                                                                      class="btn btn-rounded btn-primary float-left"><i
                            class="fa fa-circle-o ml-1"></i>افزودن</a></div>
        </div>
    </div>
@endslot
@endcomponent