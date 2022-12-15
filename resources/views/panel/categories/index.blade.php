@component('layouts.back')
    @slot('title') مدیریت {{ $title }} @endslot
    @slot('body')
        <div class="card">
            <div class="card-header archive-card-header">
                <div class="archive-circle-wrap">
                    <div class="archive-circle">
                        <a href="/" target="_blank">

                            <img src="{{ panel_logo() }}" style="margin-top: 10px;">
                        </a>
                    </div>
                    <h2>لیست {{ $title }}</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="dd">
                    <ol class="dd-list">
                        @foreach($categories as $category)
                            <li class="dd-item" data-id="{{ $category->id }}">
                                <div class="dd-handle">{{ $category->name }}({{$category->id}})</div>
                                <div class="btn-inline">
                                    <a href="{{ route('category-edit', $category->id) }}" class="btn float-left mr-1"><i class="fa fa-edit ml-1"></i>ویرایش</a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['category-destroy', $category->id] ]) !!}
                                    {{--{!! Form::button('<i class="fa fa-ban ml-1"></i>حذف', ['type' => 'submit', 'class' => 'btn btn-danger float-left', 'onclick' => 'return confirm("آیا مطمئن هستید؟")']) !!}--}}
                                    {!! Form::close() !!}
                                </div>
                                @include('panel.categories.each', $category)
                            </li>
                        @endforeach
                        {{$categories->links()}}
                    </ol>
                </div>
                <div class="paginate p-3">
                    <a href="{{ route('category-create') }}" class="btn btn-rounded btn-primary float-left"><i class="fa fa-circle-o ml-1"></i>افزودن</a>
                </div>
            </div>
        </div>
    @endslot
    @push('scripts')
        <script type="text/javascript" src="{{ asset('source/assets/js/easing.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('source/assets/js/nestable.min.js') }}"></script>
        <script type="text/javascript">
            $('.dd').nestable();
            $('.dd').on('change', function () {
                $.post('{{ route('category-sort') }}', {
                    sort: JSON.stringify($('.dd').nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function () {
                    $.jGrowl('ذخیره شد', {life: 3000, position: 'bottom-right', theme: 'bg-success'});
                });
            });
        </script>
    @endpush
@endcomponent