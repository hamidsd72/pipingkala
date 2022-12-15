@if($category->children->count() > 0)
    <ol class="dd-list">
        @foreach($category->children as $category)
            <li class="dd-item" data-id="{{ $category->id }}">
                <div class="dd-handle">{{ $category->name }}({{$category->id}})</div>
                <div class="btn-inline">
                    <a href="{{ route('category-edit', $category->id) }}" class="btn float-left mr-1"><i class="fa fa-edit ml-1"></i>ویرایش</a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['category-destroy', $category->id] ]) !!}
                    {!! Form::button('<i class="fa fa-ban ml-1"></i>حذف', ['type' => 'submit', 'class' => 'btn btn-danger float-left', 'onclick' => 'return confirm("آیا مطمئن هستید؟")']) !!}
                    {!! Form::close() !!}
                </div>
                @include('panel.categories.each', $category)
            </li>
        @endforeach
    </ol>
@endif